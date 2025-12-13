<?php

namespace core\systems\scene;

use core\SwimCore;
use core\systems\entity\EntitySystem;
use core\systems\party\PartiesSystem;
use core\systems\player\PlayerSystem;
use core\systems\player\SwimPlayer;
use core\systems\scene\managers\BlocksManager;
use core\systems\scene\managers\JoinRequestManager;
use core\systems\scene\managers\TeamManager;
use core\systems\scene\misc\Team;
use core\systems\scene\replay\SceneRecorder;
use core\systems\SystemManager;
use core\utils\BehaviorEventEnum;
use core\utils\ServerSounds;
use pocketmine\entity\Entity;
use pocketmine\entity\object\ItemEntity;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\Event;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\player\PlayerBucketEmptyEvent;
use pocketmine\event\player\PlayerBucketFillEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\protocol\BossEventPacket;
use pocketmine\network\mcpe\protocol\types\BossBarColor;
use pocketmine\player\Player;
use pocketmine\world\World;
use ReflectionException;

abstract class Scene
{

  protected SwimCore $core;
  protected SystemManager $systemManager;
  protected PlayerSystem $playerSystem;
  protected PartiesSystem $partiesSystem;
  protected SceneSystem $sceneSystem;
  protected EntitySystem $entitySystem;
  protected JoinRequestManager $joinRequestManager;

  /**
   * @var BehaviorEventEnum[] Array of events
   */
  private array $canceledEvents = [];

  /**
   * @var SwimPlayer[] Array of SwimPlayer objects indexed by int ID keys
   */
  protected array $players = []; // all swim players unsorted

  protected TeamManager $teamManager;

  protected ?BlocksManager $blocksManager = null; // nullable as not every scene supplies a world for a blocks manager to be made, this is scuffed

  protected string $sceneName;
  private int $sceneCreationTimestamp; // the unix timestamp of when the scene is created, used for calculating tick age
  protected bool $isDuel; // if this is a duel or not
  protected bool $ranked; // for ranked and scrim modes

  private int $playerCount = 0;

  protected World $world;

  protected bool $canCraft = false;

  protected SceneRecorder $recorder;

  public function __construct(SwimCore $core, string $name)
  {
    $this->core = $core;
    $this->sceneName = $name;
    $this->sceneCreationTimestamp = time();
    $this->joinRequestManager = new JoinRequestManager($this);

    // add in the systems a scene might need to touch
    $this->systemManager = $this->core->getSystemManager();
    $this->playerSystem = $this->systemManager->getPlayerSystem();
    $this->partiesSystem = $this->systemManager->getPartySystem();
    $this->sceneSystem = $this->systemManager->getSceneSystem();
    $this->entitySystem = $this->systemManager->getEntitySystem();
    $this->isDuel = false; // duel class will set this to true in its constructor
    $this->ranked = false; // duel class will set this to true if needed

    // make team manager
    $this->teamManager = new TeamManager($this);

    $this->recorder = new SceneRecorder();

    if (isset($this->world)) {
      $this->blocksManager = new BlocksManager($this, $core, $this->world);
    } else {
      echo("WORLD IS NULL, NO BLOCKS MANAGER MADE ON CONSTRUCT: $this->sceneName \n");
    }
  }

  public function getJoinRequestManager(): JoinRequestManager
  {
    return $this->joinRequestManager;
  }

  public function getSceneRecorder(): SceneRecorder
  {
    return $this->recorder;
  }

  /**
   * @breif Override this and have it return true if you want the scene to be automatically loaded and exist right away in the scene system.
   *        This is done for things like the hub and FFA scenes.
   * @return bool
   */
  public static function AutoLoad(): bool
  {
    return false;
  }

  /**
   * @return TeamManager
   */
  public function getTeamManager(): TeamManager
  {
    return $this->teamManager;
  }

  public function getPlayerTeam(SwimPlayer $swimPlayer): ?Team
  {
    return $this->teamManager->getTeamByID($swimPlayer->getSceneHelper()->getTeamNumber());
  }

  public final function isDuel(): bool
  {
    return $this->isDuel;
  }

  public final function isRanked(): bool
  {
    return $this->ranked;
  }

  public function setRanked(bool $value): void
  {
    $this->ranked = $value;
  }

  public final function setWorld(World $world): void
  {
    $this->world = $world;
    if (!isset($this->blocksManager)) {
      $this->blocksManager = new BlocksManager($this, $this->core, $this->world);
    }
  }

  public final function getWorld(): World
  {
    return $this->world;
  }

  // gets the amount of ticks this scene has been active
  public final function getSceneTickAge(): int
  {
    return (time() - $this->sceneCreationTimestamp) * 20; // I haven't tested if this is right, and I don't use this function often
  }

  // should be an int array of event enums
  public final function registerCanceledEvents(array $canceledEvents): void
  {
    $this->canceledEvents = $canceledEvents;
  }

  // I don't know if this will ever be needed
  public final function getCanceledEvents(): array
  {
    return $this->canceledEvents;
  }

  // checks if the event in this scene is scheduled to be cancelled, and if it is then it cancels it
  private function cancelCheck(BehaviorEventEnum $eventEnum, Event $event): void
  {
    if (!empty($this->canceledEvents)) {
      if (in_array($eventEnum, $this->canceledEvents, true)) {
        /*
        if (method_exists($event, 'cancel')) {
          $event->cancel();
        }
        */
        $event->cancel(); // reflection is slow, we know this works, assuming the developer doesn't register non-cancellable events as cancelled
      }
    }
  }

  // use this for performance instead of $this->playerSystem->getSwimPlayer($player);
  // this is now redundant
  public final function getSwimPlayerInScene(Player $player): ?SwimPlayer
  {
    $id = $player->getId();
    foreach ($this->players as $swimPlayer) {
      if ($swimPlayer->getId() === $id) {
        return $swimPlayer;
      }
    }
    // last resort
    return $this->playerSystem->getSwimPlayer($player);
  }

  // called once on creation
  abstract public function init(): void;

  // called every tick
  public function updateTick(): void
  {
  }

  // called every second
  public function updateSecond(): void
  {
    $this->blocksManager?->updateSecond();
  }

  // called once on scene close

  /**
   * @throws ReflectionException
   */
  public function exit(): void
  {
    $this->blocksManager?->cleanMap();

    // We want to cache a position to use to check for nearby item entities to kill.
    // This is a TOTAL HACK of a solution for using to clean up nearby item entities probably in the scene. (see [1]).
    // It would be better to have a midpoint or some map position provided to us from a derived class like Scene or PvP.
    $pos = null;

    // [0]
    // We will make sure all entities are totally destroyed (duel does this in end() but that might not always be called)
    foreach ($this->entitySystem->entities as $actorEntity) {
      $s = $actorEntity?->getParentScene();
      if ($s === $this || $s === null) {
        if (SwimCore::$DEBUG) {
          echo("Scene::exit() | Cleaning up actor entity: {$actorEntity->getId()}\n");
        }
        $pos = $actorEntity?->getPosition();
        $this->entitySystem->deregisterEntity($actorEntity);
      }
    }

    // [1]
    // While the derived PVP scene will call dropped item manager to clean stuff up,
    // that won't always work since not every scene uses that manager for item entity storage.
    // We will do a hack fix to clean up all dropped items within our cached position.
    if (isset($this->world) && isset($pos)) {
      foreach ($this->world->getEntities() as $itemEntity) {
        if ($itemEntity instanceof ItemEntity) {
          if ($itemEntity->getPosition()->distance($pos) < 100) {
            if (SwimCore::$DEBUG) {
              echo("Scene::exit() | Cleaning up item entity: {$itemEntity->getId()}\n");
            }
            $itemEntity->kill();
            $itemEntity->flagForDespawn();
          }
        }
      }
    } else if (SwimCore::$DEBUG) {
      // This can happen pretty easily actually, not good.
      // It's not the end of the world if this happens because ideally those chunks will unload and de-spawn all item entities.
      echo("Scene::exit() | No world or actor pos found, so could not clean up world dropped items in {$this->sceneName}\n");
    }

    // [2]
    // We will then force unload all chunks possible (do we want to do this? I won't do this yet, pocketmine should do this)
  }

  // handling for when a player needs to restart in a scene individually (rekit, warp back to a spawn point, etc)
  // this function is also called by our scene framework when you try to put a player in a scene they are already in
  public function restart(SwimPlayer $swimPlayer): void
  {
    // no op default
  }

  public final function getBlockManager(): ?BlocksManager
  {
    return $this->blocksManager ?? null;
  }

  public final function getSceneName(): string
  {
    return $this->sceneName;
  }

  public final function getPlayers(): array
  {
    return $this->players;
  }

  public final function getPlayerCount(): int
  {
    return $this->playerCount;
  }

  // Probably should use scene helper component instead
  public final function isInScene(SwimPlayer $player): bool
  {
    return in_array($player, $this->players, true);
  }

  public final function arePlayersInSameTeam(SwimPlayer $playerOne, SwimPlayer $playerTwo): bool
  {
    // not on a team if both team numbers -1
    if ($playerOne->getSceneHelper()->getTeamNumber() == -1 || $playerTwo->getSceneHelper()->getTeamNumber() == -1) {
      return false;
    }

    return $playerOne->getSceneHelper()->getTeamNumber() == $playerTwo->getSceneHelper()->getTeamNumber();
  }

  // warning, make sure team exists if you want to add a player to a team

  public final function addPlayer(SwimPlayer $player, ?Team $team = null): void
  {
    $this->playerCount++;

    // First add them to a team if a default one for them to join right away was passed
    if ($this->teamManager->teamValidAndInScene($team)) {
      $team->addPlayer($player);
      if (SwimCore::$DEBUG) {
        echo("Scene::addPlayer() Added {$player->getName()} to {$team->getTeamName()} Team\n");
      }
    } else if ($team !== null) {
      // this is bad so we just always echo it
      echo("Scene::addPlayer() {$player->getName()} tried to be added to a team not in the scene: {$team->getTeamName()}\n");
    } else {
      // Common that we aren't given a team to join right away
      if (SwimCore::$DEBUG) {
        echo("Scene::addPlayer() {$player->getName()} not given a default team to join for {$this->sceneName}\n");
      }
    }

    $this->players[] = $player; // push back into players array too
    $this->playerAdded($player);
  }

  // Calls the virtual function the deriving scene class will optionally implement for handling specifics when a player leaves the scene,
  // and then removes them from their team and the players array.
  public final function removePlayer(SwimPlayer $player): void
  {
    $this->playerCount--;
    // Called before a player is removed. this is for the processing steps
    $this->playerRemoved($player);

    // Remove the player from the team they are in
    $this->getPlayerTeam($player)?->removePlayer($player);

    // Remove the player from the players array
    $key = array_search($player, $this->players, true);
    if ($key !== false) {
      unset($this->players[$key]);
    }
  }

  public final function sceneAnnouncement(string $msg): void
  {
    foreach ($this->players as $player) {
      if ($player->isOnline()) $player->sendMessage($msg);
    }
  }

  public function sceneBossBar(string $title, float $healthPercent, bool $darkenScreen = false, int $color = BossBarColor::PURPLE, int $overlay = 0): void
  {
    foreach ($this->players as $player) {
      if ($player->isOnline()) {
        $player->removeBossBar(); // refresh
        $packet = BossEventPacket::show($player->getId(), $title, $healthPercent, $darkenScreen, $color, $overlay);
        $player->getNetworkSession()->sendDataPacket($packet);
      }
    }
  }

  public function removeBossBarForAll(): void
  {
    foreach ($this->players as $player) {
      if ($player->isOnline()) {
        $packet = BossEventPacket::hide($player->getId());
        $player->getNetworkSession()->sendDataPacket($packet);
      }
    }
  }

  public function sceneJukeBoxMessage(string $message): void
  {
    foreach ($this->players as $player) {
      if ($player->isOnline()) $player->sendJukeboxPopup($message);
    }
  }

  public function sceneTitle(string $title, string $subtitle = "", int $fadeIn = -1, int $stay = -1, int $fadeOut = -1): void
  {
    foreach ($this->players as $player) {
      if ($player->isOnline()) $player->sendTitle($title, $subtitle, $fadeIn, $stay, $fadeOut);
    }
  }

  public function sceneSound(string $soundName, float $volume = 2, float $pitch = 1): void
  {
    foreach ($this->players as $player) {
      if ($player->isOnline()) ServerSounds::playSoundToPlayer($player, $soundName, $volume, $pitch);
    }
  }

  // what happens when a player is added
  public function playerAdded(SwimPlayer $player): void
  {
    // no op default
  }

  // what happens when a player is removed
  public function playerRemoved(SwimPlayer $player): void
  {
    // no op default
  }

  // functions to work as event call backs from the player listener

  public function sceneEntityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_DAMAGE_BY_CHILD_ENTITY_EVENT, $event);
  }

  public function sceneEntityDamageByEntityEvent(EntityDamageByEntityEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_DAMAGE_BY_ENTITY_EVENT, $event);
  }

  public function sceneEntityDamageEvent(EntityDamageEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_DAMAGE_EVENT, $event);
  }

  public function sceneItemDropEvent(PlayerDropItemEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PLAYER_DROP_ITEM_EVENT, $event);
  }

  public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PLAYER_ITEM_USE_EVENT, $event);
  }

  public function sceneInventoryUseEvent(InventoryTransactionEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::INVENTORY_TRANSACTION_EVENT, $event);
  }

  public function sceneEntityTeleportEvent(EntityTeleportEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_TELEPORT_EVENT, $event);
  }

  public function scenePlayerConsumeEvent(PlayerItemConsumeEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PLAYER_ITEM_CONSUME_EVENT, $event);
  }

  public function scenePlayerPickupItem(EntityItemPickupEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_ITEM_PICKUP_EVENT, $event);
  }

  public function sceneProjectileLaunchEvent(ProjectileLaunchEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PROJECTILE_LAUNCH_EVENT, $event);
  }

  public function sceneEntityRegainHealthEvent(EntityRegainHealthEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_REGAIN_HEALTH_EVENT, $event);
  }

  public function sceneProjectileHitEvent(ProjectileHitEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PROJECTILE_HIT_EVENT, $event);
  }

  public function sceneProjectileHitEntityEvent(ProjectileHitEntityEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PROJECTILE_HIT_ENTITY_EVENT, $event);
  }

  // not called back normally for performance reasons, only called back for chest opening at the moment
  public function scenePlayerInteractEvent(PlayerInteractEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PLAYER_INTERACT_EVENT, $event);
  }

  public function sceneBlockBreakEvent(BlockBreakEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->blocksManager?->handleBlockBreak($event);
  }

  public function sceneBlockPlaceEvent(BlockPlaceEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->blocksManager?->handleBlockPlace($event);
  }

  public function scenePlayerSpawnChildEvent(EntitySpawnEvent $event, SwimPlayer $swimPlayer, Entity $spawnedEntity): void
  {
    $this->cancelCheck(BehaviorEventEnum::ENTITY_SPAWN_EVENT, $event);
  }

  public function scenePlayerToggleFlightEvent(PlayerToggleFlightEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PLAYER_TOGGLE_FLIGHT_EVENT, $event);
  }

  public function scenePlayerJumpEvent(PlayerJumpEvent $event, SwimPlayer $swimPlayer): void
  {
    $this->cancelCheck(BehaviorEventEnum::PLAYER_JUMP_EVENT, $event);
  }

  // this event can not be cancelled and should not be cancelled, so we don't allow it being registered and checked to be cancelled
  public function sceneDataPacketReceiveEvent(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void
  {
    // optional override (like the rest, just not cancel checked)
    // this is where recording happens for all player movements and actions
    if ($this->recorder->isRecording()) {
      $this->recorder->onReceive($event, $swimPlayer);
    }
  }

  public function sceneBucketEmptyEvent(PlayerBucketEmptyEvent $event, SwimPlayer $sp): void
  {
    $this->cancelCheck(BehaviorEventEnum::BUCKET_EMPTY_EVENT, $event);
  }

  public function sceneBucketFillEvent(PlayerBucketFillEvent $event, SwimPlayer $sp): void
  {
    $this->cancelCheck(BehaviorEventEnum::BUCKET_FILL_EVENT, $event);
  }

  public function isFFA(): bool
  {
    return false;
  }

  public function allowCrafting(): bool
  {
    return $this->canCraft;
  }

  public function eventMessage(string $message, ...$args): void
  {
    // super generic message event function to be overridden by a derived class
  }

}