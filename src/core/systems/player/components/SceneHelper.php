<?php

namespace core\systems\player\components;

use core\SwimCore;
use core\systems\event\ServerGameEvent;
use core\systems\party\Party;
use core\systems\player\Component;
use core\systems\player\SwimPlayer;
use core\systems\scene\misc\Team;
use core\systems\scene\Scene;
use core\systems\scene\SceneSystem;
use core\utils\raklib\SwimTypeConverter;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\PlayerSkinPacket;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class SceneHelper extends Component
{

  private ?Scene $scene = null;
  private ?Party $party = null;
  private int $teamNumber;
  private ?ServerGameEvent $event;
  private SceneSystem $sceneSystem;
  private Server $server;

  // Key: playerId => lastTick
  private array $mySkinSentTo = [];

  // Key: playerId => lastTick
  private array $skinReceivedFrom = [];

  private int $lastSkinSyncTick = -999999;
  private int $skinSyncNonce = 0;

  private static int $SYNC_DEBOUNCE_TICKS = 20;
  private static float $WORLD_PROXIMITY_DISTANCE = 100.0;
  private static float $SCENE_MAX_DISTANCE = 100.0;

  private bool $justUseVanilla = false;

  public function __construct(SwimCore $core, SwimPlayer $swimPlayer)
  {
    parent::__construct($core, $swimPlayer);
    $this->server = $core->getServer();
    $this->teamNumber = -1;
    $this->sceneSystem = $this->core->getSystemManager()->getSceneSystem();
  }

  public function getScene(): ?Scene
  {
    return $this->scene;
  }

  public function setEvent(?ServerGameEvent $event): void
  {
    $this->event = $event;
  }

  public function getEvent(): ?ServerGameEvent
  {
    return $this->event ?? null;
  }

  public function getParty(): ?Party
  {
    return $this->party;
  }

  public function setParty(?Party $party): void
  {
    $this->party = $party;
  }

  public function isInParty(): bool
  {
    return isset($this->party);
  }

  /**
   * SceneSystem should call this when the player is moved between scenes.
   */
  public function setScene(Scene $scene): void
  {
    $oldScene = $this->scene;

    if ($oldScene !== null && $oldScene !== $scene) {
      // Tell everyone in the old scene to forget tracking for us.
      foreach ($oldScene->getPlayers() as $p) {
        if ($p instanceof SwimPlayer && $p !== $this->swimPlayer) {
          $p->getSceneHelper()?->forgetPlayer($this->swimPlayer);
        }
      }

      // Also forget all of them locally.
      // DO NOT request skin sync here. When teleport is called that will happen naturally.
      $this->resetSkinTracking();
    }

    $this->scene = $scene;
  }

  public function setTeamNumber(int $teamNumber): void
  {
    $this->teamNumber = $teamNumber;
  }

  public function getTeamNumber(): int
  {
    return $this->teamNumber;
  }

  /**
   * @brief Sets the scene the player is in
   * @return bool if worked
   * @throws ScoreFactoryException
   */
  public function setNewScene(string $sceneName, ?Team $team = null): bool
  {
    $scene = $this->sceneSystem->getScene($sceneName);
    if ($scene) {
      $this->sceneSystem->setScene($this->swimPlayer, $scene, $team);
      return true;
    } else {
      $this->swimPlayer->sendMessage(TextFormat::RED . "Failed to join scene: " . $sceneName);
      return false;
    }
  }

  /**
   * Called by SwimPlayer after a successful teleport.
   * Teleport is the ONLY trigger for skin syncing.
   */
  public function notifyTeleported(Vector3 $pos): void
  {
    $this->requestSkinSync(true, true, 20);
  }

  /**
   * Removes all tracking entries involving $player.
   * This is used when someone leaves our scene (or otherwise becomes "not worth tracking").
   */
  public function forgetPlayer(SwimPlayer $player): void
  {
    $id = $player->getId();

    if (isset($this->mySkinSentTo[$id])) {
      unset($this->mySkinSentTo[$id]);
    }

    if (isset($this->skinReceivedFrom[$id])) {
      unset($this->skinReceivedFrom[$id]);
    }
  }

  /**
   * Main entrypoint:
   * - only considers eligible players (visibility + scene/world proximity rules)
   * - never spams: global debounce + per-player tracking + pruning when ineligible
   * - sends OUR skin in a batch to eligible players that don't have it
   * - requests THEIR skins via their SceneHelpers using direct send (no ping-pong)
   */
  public function requestSkinSync(bool $sendMySkin = true, bool $receiveTheirSkins = true, int $delayTicks = 0): void
  {
    if (!$this->swimPlayer->isConnected()) {
      return;
    }

    $this->skinSyncNonce++;
    $nonce = $this->skinSyncNonce;

    if ($delayTicks <= 0) {
      $this->runSkinSync($sendMySkin, $receiveTheirSkins, $nonce);
      return;
    }

    $this->core->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($sendMySkin, $receiveTheirSkins, $nonce): void {
      $this->runSkinSync($sendMySkin, $receiveTheirSkins, $nonce);
    }), $delayTicks);
  }

  private function runSkinSync(bool $sendMySkin, bool $receiveTheirSkins, int $nonce): void
  {
    if ($nonce !== $this->skinSyncNonce) {
      return;
    }

    if ($this->scene === null || !$this->swimPlayer->isConnected()) {
      return;
    }

    if ($this->swimPlayer->isSpectator() || $this->swimPlayer->isInvisible()) {
      return;
    }

    $tick = $this->server->getTick();
    if (($tick - $this->lastSkinSyncTick) <= self::$SYNC_DEBOUNCE_TICKS) {
      return;
    }
    $this->lastSkinSyncTick = $tick;

    // Full eligibility set for pruning correctness (don’t use skip filters here).
    $eligibleForPrune = $this->collectEligiblePlayers(false, false);
    $this->pruneSkinTracking($eligibleForPrune);

    // Smarter eligibility set for actual work (skips already satisfied players).
    $eligible = $this->collectEligiblePlayers($sendMySkin, $receiveTheirSkins);

    if ($sendMySkin) {
      $targets = [];

      foreach ($eligible as $other) {
        $id = $other->getId();
        if (!isset($this->mySkinSentTo[$id])) {
          $targets[] = $other;
        }
      }

      $this->sendMySkinToPlayers($targets);
    }

    if ($receiveTheirSkins) {
      $targets = [];

      foreach ($eligible as $other) {
        $id = $other->getId();
        if (!isset($this->skinReceivedFrom[$id])) {
          $targets[] = $other;
        }
      }

      $this->requestOtherPlayersSendSkinsToMe($targets);
    }
  }

  private function isEligiblePair(SwimPlayer $a, SwimPlayer $b): bool
  {
    if (!$a->isConnected() || !$b->isConnected()) {
      return false;
    }

    if ($a->isSpectator() || $a->isInvisible()) {
      return false;
    }

    if ($b->isSpectator() || $b->isInvisible()) {
      return false;
    }

    $aPos = $a->getPosition();
    $bPos = $b->getPosition();

    if ($aPos->getWorld() !== $bPos->getWorld()) {
      return false;
    }

    $distSq = $aPos->distanceSquared($bPos);

    $aScene = $a->getSceneHelper()?->getScene();
    $bScene = $b->getSceneHelper()?->getScene();

    $sameScene = false;
    if ($aScene !== null && $bScene !== null) {
      if ($aScene === $bScene) {
        $sameScene = true;
      }
    }

    if ($sameScene) {
      $maxSq = self::$SCENE_MAX_DISTANCE * self::$SCENE_MAX_DISTANCE;
      if ($distSq <= $maxSq) {
        return true;
      }
    }

    $maxSq = self::$WORLD_PROXIMITY_DISTANCE * self::$WORLD_PROXIMITY_DISTANCE;
    if ($distSq <= $maxSq) {
      return true;
    }

    return false;
  }

  /**
   * @param bool $skipSent if true, skip players we already marked as having OUR skin
   * @param bool $skipReceived if true, skip players we already marked as having sent THEIR skin to us
   */
  private function collectEligiblePlayers(bool $skipSent, bool $skipReceived): array
  {
    $me = $this->swimPlayer;

    $result = [];

    $shouldSkip = function (SwimPlayer $p) use ($skipSent, $skipReceived): bool {
      $id = $p->getId();

      if ($skipSent) {
        if (isset($this->mySkinSentTo[$id])) {
          return true;
        }
      }

      if ($skipReceived) {
        if (isset($this->skinReceivedFrom[$id])) {
          return true;
        }
      }

      return false;
    };

    // Scene candidates
    foreach ($this->scene->getPlayers() as $p) {
      if (!($p instanceof SwimPlayer)) {
        continue;
      }

      if ($p === $me) {
        continue;
      }

      if ($shouldSkip($p)) {
        continue;
      }

      if (!$this->isEligiblePair($me, $p)) {
        continue;
      }

      $result[$p->getId()] = $p;
    }

    // World proximity candidates
    foreach ($me->getWorld()->getPlayers() as $p) {
      if (!($p instanceof SwimPlayer)) {
        continue;
      }

      if ($p === $me) {
        continue;
      }

      if ($shouldSkip($p)) {
        continue;
      }

      if (!$this->isEligiblePair($me, $p)) {
        continue;
      }

      $result[$p->getId()] = $p;
    }

    return array_values($result);
  }

  private function pruneSkinTracking(array $eligible): void
  {
    $eligibleIds = [];
    foreach ($eligible as $p) {
      $eligibleIds[$p->getId()] = true;
    }

    foreach ($this->mySkinSentTo as $id => $_tick) {
      if (!isset($eligibleIds[$id])) {
        unset($this->mySkinSentTo[$id]);
      }
    }

    foreach ($this->skinReceivedFrom as $id => $_tick) {
      if (!isset($eligibleIds[$id])) {
        unset($this->skinReceivedFrom[$id]);
      }
    }
  }

  /**
   * Sends THIS player's skin to an array of targets, then marks them as having our skin.
   * Also marks the receiver's SceneHelper so both sides agree.
   * @param SwimPlayer[] $targets
   */
  private function sendMySkinToPlayers(array $targets): void
  {
    if (empty($targets)) {
      return;
    }

    if ($this->scene === null || !$this->swimPlayer->isConnected()) {
      return;
    }

    $tick = $this->server->getTick();

    $finalTargets = [];
    foreach ($targets as $target) {
      if ($target === $this->swimPlayer) {
        continue;
      }

      if (!$this->isEligiblePair($this->swimPlayer, $target)) {
        continue;
      }

      $id = $target->getId();
      if (isset($this->mySkinSentTo[$id])) {
        continue;
      }

      $this->mySkinSentTo[$id] = $tick;
      $finalTargets[] = $target;
    }

    if (empty($finalTargets)) {
      return;
    }

    if (SwimCore::$isNetherGames && !$this->justUseVanilla) {
      if (SwimCore::$DEBUG) {
        foreach ($finalTargets as $t) {
          echo("sendMySkinToPlayers (NG): {$this->swimPlayer->getName()} sending skin to {$t->getName()}\n");
        }
      }

      SwimTypeConverter::broadcastByTypeConverter($finalTargets, function (TypeConverter $typeConverter): array {
        $adapter = $typeConverter->getSkinAdapter();
        return [
          PlayerSkinPacket::create(
            $this->swimPlayer->getUniqueId(),
            "",
            "",
            $adapter->toSkinData($this->swimPlayer->getSkin())
          )
        ];
      });
    } else {
      if (SwimCore::$DEBUG) {
        foreach ($finalTargets as $t) {
          echo("sendMySkinToPlayers: {$this->swimPlayer->getName()} sending skin to {$t->getName()}\n");
        }
      }

      $this->swimPlayer->sendSkin($finalTargets);
    }

    foreach ($finalTargets as $t) {
      $t->getSceneHelper()?->markSkinReceivedFrom($this->swimPlayer);
    }
  }

  /**
   * Requests other players to send THEIR skins to ME using THEIR SceneHelpers.
   * This does not call requestSkinSync() on them, only a direct send path.
   *
   * This is potentially a VERY hot path but if things are working as expected,
   * does not have to happen often in terms of lots of skin sending at once.
   *
   * The main cause of lag is skin packet sending in bulk to a client at once.
   * We will just have to see if stuff is still causing freezes here.
   *
   * @param SwimPlayer[] $targets
   */
  private function requestOtherPlayersSendSkinsToMe(array $targets): void
  {
    if (empty($targets)) {
      return;
    }

    if ($this->scene === null || !$this->swimPlayer->isConnected()) {
      return;
    }

    $tick = $this->server->getTick();

    foreach ($targets as $other) {
      if ($other === $this->swimPlayer) {
        continue;
      }

      if (!$this->isEligiblePair($this->swimPlayer, $other)) {
        continue;
      }

      $id = $other->getId();
      if (isset($this->skinReceivedFrom[$id])) {
        continue;
      }

      $this->skinReceivedFrom[$id] = $tick;

      $otherHelper = $other->getSceneHelper();
      if ($otherHelper === null) {
        continue;
      }

      $otherHelper->sendMySkinToSpecificPlayer($this->swimPlayer);
    }
  }

  /**
   * Sends THIS player's skin to exactly one target.
   * Used by other helpers when they need our skin, without triggering full sync.
   */
  public function sendMySkinToSpecificPlayer(SwimPlayer $target): void
  {
    if ($this->scene === null) {
      return;
    }

    if ($target === $this->swimPlayer) {
      return;
    }

    if (!$this->isEligiblePair($this->swimPlayer, $target)) {
      return;
    }

    $id = $target->getId();
    if (isset($this->mySkinSentTo[$id])) {
      return;
    }

    $this->mySkinSentTo[$id] = $this->server->getTick();

    if (SwimCore::$isNetherGames && !$this->justUseVanilla) {
      if (SwimCore::$DEBUG) {
        echo("sendMySkinToSpecificPlayer (NG): {$this->swimPlayer->getName()} sending skin to {$target->getName()}\n");
      }

      SwimTypeConverter::broadcastByTypeConverter([$target], function (TypeConverter $typeConverter): array {
        $adapter = $typeConverter->getSkinAdapter();
        return [
          PlayerSkinPacket::create(
            $this->swimPlayer->getUniqueId(),
            "",
            "",
            $adapter->toSkinData($this->swimPlayer->getSkin())
          )
        ];
      });
    } else {
      if (SwimCore::$DEBUG) {
        echo("sendMySkinToSpecificPlayer: {$this->swimPlayer->getName()} sending skin to {$target->getName()}\n");
      }

      $this->swimPlayer->sendSkin([$target]);
    }

    $target->getSceneHelper()?->markSkinReceivedFrom($this->swimPlayer);
  }

  public function markSkinReceivedFrom(SwimPlayer $player): void
  {
    if (!$this->swimPlayer->isConnected() || !$player->isConnected()) {
      return;
    }

    $this->skinReceivedFrom[$player->getId()] = $this->server->getTick();
  }

  private function resetSkinTracking(): void
  {
    $this->mySkinSentTo = [];
    $this->skinReceivedFrom = [];
  }

}
