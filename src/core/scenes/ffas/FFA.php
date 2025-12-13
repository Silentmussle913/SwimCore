<?php

namespace core\scenes\ffas;

use core\commands\HubCmd;
use core\scenes\PvP;
use core\systems\player\SwimPlayer;
use core\systems\scene\FFAInfo;
use core\utils\CoolAnimations;
use core\utils\InventoryUtil;
use core\utils\TimeHelper;
use jackmd\scorefactory\ScoreFactory;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\block\utils\DyeColor;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Dye;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\GameMode;
use pocketmine\scheduler\ClosureTask;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;

/**
 * You MUST implement a constructor for FFA derived classes, as that is where the world is set
 */
abstract class FFA extends PvP
{

  public ?FFAInfo $info = null;

  abstract public static function getIcon(): string;

  protected int $x;
  protected int $y;
  protected int $z;
  protected int $spawnOffset;

  public bool $interruptAllowed = true;
  protected bool $respawnInArena = false; // by default warps back to hub, if true then warps back to arena

  // all FFA scenes autoload and are persistent
  public static function AutoLoad(): bool
  {
    return true;
  }

  public function isFFA(): bool
  {
    return true;
  }

  public function init(): void
  {
    $this->teamManager->makeTeam('players', TextFormat::RESET);
    $this->teamManager->makeTeam('spectators', TextFormat::RESET);
  }

  protected function teleportToArena(SwimPlayer $player): void
  {
    $offSetX = mt_rand(-1 * $this->spawnOffset, $this->spawnOffset);
    $offSetZ = mt_rand(-1 * $this->spawnOffset, $this->spawnOffset);
    $pos = new Position($this->x + $offSetX, $this->y, $this->z + $offSetZ, $this->world);
    $player->teleport($pos);
  }

  public function cleanUpItemEntities(int $seconds): void
  {
    // Kill all dropped item entities in the world that have been on the ground longer than N seconds
    foreach ($this->world->getEntities() as $entity) {
      if ($entity::getNetworkTypeId() === EntityIds::ITEM) {
        if ($entity->ticksLived > TimeHelper::secondsToTicks($seconds)) {
          $entity->kill();
          $entity->flagForDespawn();
        }
      }
    }
  }

  // pvp mechanics
  public function sceneEntityDamageByEntityEvent(EntityDamageByEntityEvent $event, SwimPlayer $swimPlayer): void
  {
    $attacker = $event->getDamager();
    if ($attacker instanceof SwimPlayer) {

      // can't attack teammates
      if ($this->arePlayersInSameTeam($swimPlayer, $attacker)) {
        $event->cancel();
        return;
      }

      // combat logger is used for this to prevent 3rd partying
      $blocked = $attacker->getCombatLogger()?->handleAttack($swimPlayer); // called anyway for the sake of logging
      if (!$this->interruptAllowed) {
        if (!$blocked) {
          $event->cancel();
          return;
        }
      }

      // KB logic
      $event->setVerticalKnockBackLimit($this->vertKB);
      $event->setKnockBack($this->kb);
      $event->setAttackCooldown($this->hitCoolDown);

      // callback scripting event
      $this->playerHit($attacker, $swimPlayer, $event);

      // Death logic to set spec and send message and warp to hub after a few seconds (also checks if wasn't cancelled by player hit)
      if ($event->getFinalDamage() >= $swimPlayer->getHealth() && !$event->isCancelled()) {
        $event->cancel(); // cancel event so we don't kill them

        // callback scripting events
        $this->playerKilled($attacker, $swimPlayer, $event);
        $this->defaultDeathHandle($attacker, $swimPlayer);
      }
    }
  }

  public function sceneEntityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event, SwimPlayer $swimPlayer): void
  {
    $player = $event->getEntity();
    if ($player instanceof SwimPlayer) {
      $attacker = $event->getChild()->getOwningEntity();
      if ($attacker instanceof SwimPlayer) {
        // combat logger is used for this to prevent 3rd partying
        $canAttack = $attacker->getCombatLogger()?->handleAttack($swimPlayer); // called anyway for the sake of logging
        if (!$this->interruptAllowed) {
          if (!$canAttack) {
            $event->cancel();
            return;
          }
        }
      }
    }

    parent::sceneEntityDamageByChildEntityEvent($event, $swimPlayer);
  }

  /*
   * Explode controls if an explosion animation effects happens or not
   * UseTeamColorForKillStreak controls if it uses the attackers team color or rank color for if they have a kill streak message to be sent in the scene
   */
  protected function defaultDeathHandle(?SwimPlayer $attacker, SwimPlayer $victim, bool $explode = true, bool $useTeamColorForKillStreak = false): void
  {
    // cancel cool downs for the attacker since we just re-kitted them
    if ($attacker && $attacker->isOnline()) {
      $attacker->getCoolDowns()?->clearAll();
      $kills = $attacker->getAttributes()?->emplaceIncrementIntegerAttribute("kill streak") ?? 0; // update kill streak
      if ($kills >= 3) {
        if ($useTeamColorForKillStreak) {
          $color = $this->getPlayerTeam($attacker)?->getTeamColor() ?? "";
        } else {
          $color = ($attacker->getCosmetics()?->getNameColor() ?? "");
        }
        $name = $color . ($attacker->getNicks()?->getNick() ?? $attacker->getName());
        $this->sceneAnnouncement($name . TextFormat::GREEN . " is on a " . $kills . " Kill Streak!");
      }
    }

    // reset the victim inventory and set them to spec
    InventoryUtil::fullPlayerReset($victim);
    $victim->setGamemode(GameMode::SPECTATOR);
    $victim->getAttributes()->setAttribute("kill streak", 0); // reset kill streak

    // kill effect
    // CoolAnimations::lightningBolt($victim->getPosition(), $victim->getWorld());
    CoolAnimations::bloodDeathAnimation($victim->getPosition(), $victim->getWorld());
    if ($explode) {
      CoolAnimations::explodeAnimation($victim->getPosition(), $victim->getWorld());
    }

    if (!$this->respawnInArena) {
      // warp back to hub after a few seconds
      $this->core->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($victim) {
        // must use safety checks when scheduling a task that uses a player reference, also check if session data still valid
        if ($victim) {
          if ($victim->isConnected()) {
            $victim?->getSceneHelper()?->setNewScene('Hub');
          }
        }
      }), 70);
    } else {
      $this->restart($victim);
    }

    $victim->getCombatLogger()?->setLastHitBy(null); // clear the attacker to remove the spawn tag
  }

  protected function regularSpectatorKit(SwimPlayer $swimPlayer): void
  {
    // Fresh spectator with respawn and leave control items
    InventoryUtil::fullPlayerReset($swimPlayer);
    $swimPlayer->setGamemode(GameMode::SPECTATOR);
    // 1 second wait time to get items
    $this->core->getScheduler()->scheduleDelayedTask(new ClosureTask(function () use ($swimPlayer) {
      // Must be online and a spectator in the scene to be given these items
      if (!$swimPlayer->isConnected()) {
        return;
      }
      if (!$swimPlayer->isSpectator()) {
        return;
      }
      if (!$this->isInScene($swimPlayer)) {
        return;
      }
      $inv = $swimPlayer->getInventory();
      $inv->addItem(VanillaItems::DYE()->setColor(DyeColor::LIME)
        ->setCustomName(TextFormat::RESET . TextFormat::GREEN . "Respawn"));
      $inv->addItem(VanillaItems::DYE()->setColor(DyeColor::RED)
        ->setCustomName(TextFormat::RESET . TextFormat::RED . "Leave to Hub"));
    }), TimeHelper::secondsToTicks(1));
  }

  /**
   * @throws ScoreFactoryException
   */
  protected function regularSpectatorControls(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void
  {
    if ($swimPlayer->isSpectator()) {
      $item = $event->getItem();
      $id = $item->getTypeId();
      if ($id != ItemTypeIds::DYE) {
        return;
      }
      if (!($item instanceof Dye)) {
        return;
      }
      if ($item->getColor() == DyeColor::LIME) {
        $this->playerAdded($swimPlayer); // Call the code that happens when a player is added to the scene for the first time, often respawn logic.
      } else if ($item->getColor() == DyeColor::RED) {
        HubCmd::goHub($swimPlayer, false);
      }
    }
  }

  protected function ffaNameTag(SwimPlayer $player): void
  {
    if ($player->getNicks()->isNicked()) {
      $player->setNameTag(TextFormat::GRAY . $player->getNicks()->getNick());
    } else {
      $player->getCosmetics()->tagNameTag();
      // $color = Rank::getRankColor($player->getRank()->getRankLevel());
      // $player->setNameTag($color . $player->getName());
    }
  }

  protected function ffaScoreTag(SwimPlayer $player): void
  {
    $cps = $player->getClickHandler()->getCPS();
    $ping = $player->getNslHandler()->getPing();
    $player->setScoreTag(TextFormat::AQUA . $cps . TextFormat::WHITE . " CPS" .
      TextFormat::GRAY . " | " . TextFormat::AQUA . $ping . TextFormat::WHITE . " MS");
  }

  /**
   * @throws ScoreFactoryException
   */
  protected function ffaScoreboard(SwimPlayer $player): void
  {
    if ($player->isScoreboardEnabled()) {
      try {
        $player->refreshScoreboard("§bswimgg.§3club");
        ScoreFactory::sendObjective($player);

        // variables needed
        $lines = 0;
        $onlineCount = $this->getPlayerCount();
        $ping = $player->getNslHandler()->getPing();
        $kills = strval($player->getAttributes()->getAttribute("kill streak") ?? 0);

        // define lines
        ScoreFactory::setScoreLine($player, ++$lines, " §bPlayers: §3" . $onlineCount);
        ScoreFactory::setScoreLine($player, ++$lines, " §bPing: §3" . $ping);
        ScoreFactory::setScoreLine($player, ++$lines, " §bKill Streak: §3" . $kills);
        ScoreFactory::setScoreLine($player, ++$lines, " §bswimgg.§3club");

        /*
        if (!$this->interruptAllowed) {
          $coolDown = $player->getCombatLogger()->getCombatCoolDown();
          ScoreFactory::setScoreLine($p, 5, " §bCombat: §3" . $coolDown);
        }
        */

        // send lines
        ScoreFactory::sendLines($player);
      } catch (ScoreFactoryException $e) {
        Server::getInstance()->getLogger()->info($e->getMessage());
      }
    }
  }

  protected function killMessage(SwimPlayer $attacker, SwimPlayer $victim): void
  {
    $attacker->getCosmetics()?->killMessageLogic($victim);

    $attackerName = $attacker->getNicks()->getNick();
    $attackerHP = round($attacker->getHealth() / 2, 1);
    $attackerHealthString = " " . TextFormat::GRAY . "(" . TextFormat::RED . $attackerHP . " Hearts" . TextFormat::GRAY . ")";

    $victimName = $victim->getNicks()->getNick();

    $msg = TextFormat::GREEN . $attackerName . $attackerHealthString . TextFormat::YELLOW . " Killed " . TextFormat::RED . $victimName;

    $this->sceneAnnouncement($msg);
  }

}
