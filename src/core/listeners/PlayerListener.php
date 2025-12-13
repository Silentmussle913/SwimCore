<?php

namespace core\listeners;

use core\database\queries\ConnectionHandler;
use core\SwimCore;
use core\systems\entity\entities\EasierPickUpItemEntity;
use core\systems\player\PlayerSystem;
use core\systems\player\SwimPlayer;
use core\systems\scene\Scene;
use core\systems\SystemManager;
use core\utils\BehaviorEventEnum;
use core\utils\cordhook\CordHook;
use core\utils\InventoryUtil;
use core\utils\PositionHelper;
use core\utils\security\ParseIP;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\block\BlockTypeIds;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\block\SignChangeEvent;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\entity\EntityTeleportEvent;
use pocketmine\event\entity\ItemSpawnEvent;
use pocketmine\event\entity\ProjectileHitEntityEvent;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\event\inventory\CraftItemEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerBucketEmptyEvent;
use pocketmine\event\player\PlayerBucketFillEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerJumpEvent;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\event\player\PlayerToggleFlightEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;

class PlayerListener implements Listener
{

  private SwimCore $core;
  private PlayerSystem $playerSystem;
  private SystemManager $systemManager;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->systemManager = $this->core->getSystemManager();
    $this->playerSystem = $this->systemManager->getPlayerSystem();
  }

  public function onPlayerConstructed(PlayerCreationEvent $event): void
  {
    $event->setPlayerClass(SwimPlayer::class);
  }

  // join handling

  /**
   * @throws ScoreFactoryException
   */
  public function onJoin(PlayerJoinEvent $event): void
  {
    if ($this->core->getRegionInfo()->autoTransfer !== "") {
      [$ip, $port] = ParseIP::sepIpFromPort($this->core->getRegionInfo()->autoTransfer);
      $event->getPlayer()->transfer($ip, $port);
      $event->setJoinMessage("");
      return;
    }
    /** @var SwimPlayer $player */
    $player = $event->getPlayer();
    // I have hunger disabled on the server because it causes unwanted bugs. Will have my own custom hunger system when needed.
    $player->getHungerManager()->setEnabled(false);
    // don't say anything in chat
    $event->setJoinMessage("");
    // set up player session
    $this->playerSystem->registerPlayer($player);
    $player->init($this->core);
    $player->getSceneHelper()?->setNewScene("Loading"); // add them to the loading scene
    // handle the player joining by logging connection and checking for punishments, if all checks are passed the data and session will be started and loaded
    ConnectionHandler::handlePlayerJoin($player);
  }

  // leave handling
  public function onQuit(PlayerQuitEvent $event): void
  {
    if ($this->core->getRegionInfo()->autoTransfer !== "") {
      $event->setQuitMessage("");
      return;
    }
    /* @var SwimPlayer $player */
    $player = $event->getPlayer();
    $com = $player->getCosmetics();
    $color = TextFormat::GRAY;
    if (isset($com)) {
      $color = $com->getNameColor();
    }
    $event->setQuitMessage("§c[-] $color" . $player->getDisplayName());

    // telemetry messaging
    $server = $player->getServer();
    $onlineCount = count($server->getOnlinePlayers()) - 1;
    $msg = $player->getName() . " Logged off (" . $onlineCount . "/" . $server->getMaxPlayers() . ")";
    CordHook::sendEmbed($msg, "Microsoft Telemetry", "Made by Swim Services", 0xFFD700); // yellow

    // send them back to spawn on leaving
    InventoryUtil::fullPlayerReset($player);
    $hub = $this->core->getHubWorld();
    $safeSpawn = $hub->getSafeSpawn();
    $player->teleport(new Position($safeSpawn->getX() + 0.5, $safeSpawn->getY(), $safeSpawn->getZ() + 0.5, $hub));

    // despawn player entity just in case
    $player->flagForDespawn();

    // have player leave each system
    $this->systemManager->handlePlayerLeave($player);
    $player->exit();
  }

  // chat handling (would we want to make this a scriptable event later on?)
  public function onChat(PlayerChatEvent $event): void
  {
    /* @var SwimPlayer $player */
    $player = $event->getPlayer();
    $player->getChatHandler()->handleChat($event->getMessage());
    $event->cancel();
  }

  // scoped scene event callbacks

  // we have to parse all damage events in this single function because of how pm does polymorphism for damage events
  // for example, EntityDamageByEntityEvent or EntityDamageByChildEntityEvent triggers an EntityDamageEvent
  public function damageCallback(EntityDamageEvent $event): void
  {
    // prevent switch hits
    if ($event->getModifier(EntityDamageEvent::MODIFIER_PREVIOUS_DAMAGE_COOLDOWN) < 0) {
      $event->cancel();
      return;
    }

    // disable suffocation
    if ($event->getCause() == EntityDamageEvent::CAUSE_SUFFOCATION || $event->getCause() == EntityDamageEvent::CAUSE_SUICIDE) {
      $event->cancel();
      return;
    }

    // this is really special case and weird
    if ($event->getCause() == EntityDamageEvent::CAUSE_ENTITY_EXPLOSION || $event->getCause() == EntityDamageEvent::CAUSE_BLOCK_EXPLOSION) {
      $player = $event->getEntity();
      if ($player instanceof SwimPlayer) {
        $player->resetTicksSinceMotionArtificiallySet(); // fix for throwing tnt and velocity check
        $player->event($event, BehaviorEventEnum::ENTITY_DAMAGE_EVENT);
        if ($event->isCancelled()) return;
        $player->getSceneHelper()?->getScene()?->sceneEntityDamageEvent($event, $player);
      }
      return;
    }

    // check if hit by a child entity like a projectile
    if ($event instanceof EntityDamageByChildEntityEvent) {
      $player = $event->getEntity();
      if ($player instanceof SwimPlayer) {
        $player->event($event, BehaviorEventEnum::ENTITY_DAMAGE_BY_CHILD_ENTITY_EVENT);
        if ($event->isCancelled()) return;
        $player->getSceneHelper()?->getScene()?->sceneEntityDamageByChildEntityEvent($event, $player);
      }
    } else if ($event instanceof EntityDamageByEntityEvent) { // check if normal melee damage
      $player = $event->getEntity();
      if ($player instanceof SwimPlayer) {

        $damager = $event->getDamager();
        if ($damager instanceof SwimPlayer) {
          // anti cheat reach check (if ac data component isn't available for calling the method then flagged is false)
          $flagged = $damager->getAntiCheatData()?->getReach()?->directReachCheck($player) ?? false;
          if ($flagged) {
            // we flagged for reach and should cancel the event and return
            $event->cancel();
            return;
          }

          // HUGE PROBLEM : Scene's have custom damage handles for no critical hits. If we put this after the code below,
          // then we can't do the logic we need for health checking in attackedPlayer() for on killing,
          // as sceneEntityDamageByEntityEvent() could change the targets HP and mess with the intended logic.
          // TLDR: The problem with putting this before is this doesn't have the scene's potential custom damage handling.
          // Fixed for now with CustomDamage::calculateFinalDamageWithoutCrits(), this is probably good enough to call that function in behavior components.
          $damager->getEventBehaviorComponentManager()?->attackedPlayer($event, $player);
        }

        // then do the actual real events
        $player->event($event, BehaviorEventEnum::ENTITY_DAMAGE_BY_ENTITY_EVENT);
        if ($event->isCancelled()) return;
        $player->getSceneHelper()?->getScene()?->sceneEntityDamageByEntityEvent($event, $player);
      }
    } else { // check if just generic damage like fall damage for example
      $player = $event->getEntity();
      if ($player instanceof SwimPlayer) {
        $player->event($event, BehaviorEventEnum::ENTITY_DAMAGE_EVENT);
        if ($event->isCancelled()) return;
        $player->getSceneHelper()?->getScene()?->sceneEntityDamageEvent($event, $player);
      }
    }
  }

  public function onItemSpawn(ItemSpawnEvent $event): void
  {
    $itemEntity = $event->getEntity();
    if (!($itemEntity instanceof EasierPickUpItemEntity)) {
      if (SwimCore::$DEBUG) echo("Making new easy item for {$itemEntity->getItem()->getName()} \n");
      $easy = new EasierPickUpItemEntity($itemEntity->getLocation(), $itemEntity->getItem(), $itemEntity->saveNBT());
      $easy->spawnToAll();
      $itemEntity->flagForDespawn();
    }

    /* old dropped item manager code we don't use due to the optimization it screws up with item stacks
    $pos = $itemEntity->getPosition();
    $nearest = PositionHelper::getNearestPlayer($pos); // nearest player's scene (this is only going to work well for scenes that are seperated far away)
    if ($nearest) {
      $scene = $nearest->getSceneHelper()?->getScene() ?? null;
      if ($scene instanceof PvP) { // only pvp scenes have an item manager, this could be seen as a design flaw, but almost all our scenes derive from pvp anyway
        $scene->getDroppedItemManager()->addDroppedItem($itemEntity);
      }
    }
    */
  }

  /* disabled because this removes a major optimization with item stacks in the world by mutating data
  public function onDespawn(EntityDespawnEvent $event): void
  {
    $entity = $event->getEntity();
    if ($entity instanceof ItemEntity) {
      $pos = $entity->getPosition();
      $nearest = PositionHelper::getNearestPlayer($pos);
      if ($nearest) {
        $scene = $nearest->getSceneHelper()?->getScene() ?? null;
        if ($scene instanceof PvP) {
          $scene->getDroppedItemManager()->removeDroppedItem($entity);
        }
      }
    }
  }
  */

  public function itemDropCallback(PlayerDropItemEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::PLAYER_DROP_ITEM_EVENT);
    if ($event->isCancelled()) return;
    $sp->getSceneHelper()?->getScene()->sceneItemDropEvent($event, $sp);
  }

  /**
   * @priority HIGHEST
   * @handleCancelled
   */
  public function itemUseCallback(PlayerItemUseEvent $event): void
  {
    $event->uncancel(); // this should never be cancelled before this listener is hit, this side steps around the spectator item use event always being cancelled
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::PLAYER_ITEM_USE_EVENT);
    if ($event->isCancelled()) return;
    $sp->getSceneHelper()?->getScene()->sceneItemUseEvent($event, $sp);
  }

  // this could be expensive
  public function inventoryUseCallback(InventoryTransactionEvent $event): void
  {
    /* @var SwimPlayer $player */
    $player = $event->getTransaction()->getSource();
    $player->event($event, BehaviorEventEnum::INVENTORY_TRANSACTION_EVENT);
    if ($event->isCancelled()) return;
    $player->getSceneHelper()?->getScene()->sceneInventoryUseEvent($event, $player);
  }

  public function onCraft(CraftItemEvent $event): void
  {
    $player = $event->getPlayer();
    if ($player instanceof SwimPlayer) {
      if (!$player->getSceneHelper()?->getScene()?->allowCrafting() ?? false) {
        $event->cancel();
        if (SwimCore::$DEBUG) echo("Cancelling crafting\n");
      }
    }
  }

  public function chestOpenEvent(PlayerInteractEvent $event): void
  {
    $id = $event->getBlock()->getTypeId();

    // hard code disable opening furnaces
    if ($id == BlockTypeIds::FURNACE) {
      $event->cancel();
      return;
    }

    if ($id == BlockTypeIds::CHEST || $id == BlockTypeIds::ENDER_CHEST || $id == BlockTypeIds::TRAPPED_CHEST) {
      /* @var SwimPlayer $player */
      $player = $event->getPlayer();
      $player->event($event, BehaviorEventEnum::PLAYER_INTERACT_EVENT);
      if ($event->isCancelled()) return;
      $player->getSceneHelper()?->getScene()->scenePlayerInteractEvent($event, $player);
    }
  }

  // No sign editing outside creative mode!
  public function signEdit(SignChangeEvent $event): void
  {
    if (!$event->getPlayer()->isCreative()) {
      $event->cancel();
    }
  }

  public function entityTeleportCallback(EntityTeleportEvent $event): void
  {
    $player = $event->getEntity();
    if (!($player instanceof SwimPlayer)) return;
    $player->event($event, BehaviorEventEnum::ENTITY_TELEPORT_EVENT);
    if ($event->isCancelled()) return;
    $player->getSceneHelper()?->getScene()->sceneEntityTeleportEvent($event, $player);
  }

  public function playerConsumeCallback(PlayerItemConsumeEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::PLAYER_ITEM_CONSUME_EVENT);
    if ($event->isCancelled()) return;
    $sp->getSceneHelper()?->getScene()->scenePlayerConsumeEvent($event, $sp);
  }

  public function playerPickupItem(EntityItemPickupEvent $event): void
  {
    $player = $event->getEntity();
    if (!($player instanceof SwimPlayer)) return;
    $player->event($event, BehaviorEventEnum::ENTITY_ITEM_PICKUP_EVENT);
    if ($event->isCancelled()) return;
    $player->getSceneHelper()?->getScene()->scenePlayerPickupItem($event, $player);
  }

  public function projectileLaunchCallback(ProjectileLaunchEvent $event): void
  {
    $player = $event->getEntity()->getOwningEntity();
    if (!($player instanceof SwimPlayer)) return;
    $player->event($event, BehaviorEventEnum::PROJECTILE_LAUNCH_EVENT);
    if ($event->isCancelled()) return;
    $player->getSceneHelper()?->getScene()->sceneProjectileLaunchEvent($event, $player);
  }

  // this is intended for when a player's thrown projectile hits (be careful with this)
  public function projectileHitCallback(ProjectileHitEvent $event): void
  {
    $player = $event->getEntity()->getOwningEntity();
    if (!($player instanceof SwimPlayer)) return;
    $player->event($event, BehaviorEventEnum::PROJECTILE_HIT_EVENT);
    $player->getSceneHelper()?->getScene()->sceneProjectileHitEvent($event, $player);
  }

  public function entityRegainHealthCallback(EntityRegainHealthEvent $event): void
  {
    $player = $event->getEntity();
    if (!($player instanceof SwimPlayer)) return;
    $player->event($event, BehaviorEventEnum::ENTITY_REGAIN_HEALTH_EVENT);
    if ($event->isCancelled()) return;
    $player->getSceneHelper()?->getScene()->sceneEntityRegainHealthEvent($event, $player);
  }

  // this is intended for when the thrower hits an entity
  public function projectileHitEntityCallback(ProjectileHitEntityEvent $event): void
  {
    $entityHit = $event->getEntityHit();
    if ($entityHit instanceof SwimPlayer) {
      $player = $event->getEntity();
      if (!($player instanceof SwimPlayer)) return;
      $player->event($event, BehaviorEventEnum::PROJECTILE_HIT_ENTITY_EVENT);
      $player->getSceneHelper()?->getScene()->sceneProjectileHitEntityEvent($event, $player);
    }
  }

  /* turned off for performance reasons, we only do this for chest interaction if you scroll up
  public function playerInteractCallback(PlayerInteractEvent $event): void
  {

  }
  */

  public function entitySpawnCallback(EntitySpawnEvent $event): void
  {
    $entity = $event->getEntity();
    $owner = $entity->getOwningEntity();
    if ($owner instanceof SwimPlayer) {
      $owner->event($event, BehaviorEventEnum::ENTITY_SPAWN_EVENT);
      $owner->getSceneHelper()?->getScene()->scenePlayerSpawnChildEvent($event, $owner, $entity);
    }
  }

  public function blockPlaceCallback(BlockPlaceEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();

    // Should the event behavior manager have priority over the scene they are in?
    $sp->event($event, BehaviorEventEnum::BLOCK_PLACE_EVENT);

    if ($event->isCancelled()) {
      return;
    }

    $sp->getSceneHelper()?->getScene()->sceneBlockPlaceEvent($event, $sp);

    // Fixes ghost web bugs due to being able to place webs really quickly.
    if ($sp->isConnected()) {
      foreach ($event->getTransaction()->getBlocks() as [$x, $y, $z, $block]) {
        if ($block->getTypeId() == BlockTypeIds::COBWEB) {
          $inventory = $sp->getInventory();
          $slot = $inventory->getHeldItemIndex(); // archive the slot webs were placed from
          // If you have less than 40 ping the delay is only 2 ticks, otherwise 5 ticks for higher ping players
          // $delay = $sp->getNetworkSession()?->getPing() <= 40 ? 2 : 5;
          $delay = 2; // some higher ping players were complaining about their hot bar hotkeys de-syncing, so we are going to try out 2 for everyone.

          // Delay so the transaction + inventory changes settle first
          $this->core->getScheduler()->scheduleDelayedTask(
            new ClosureTask(function () use ($sp, $inventory, $slot): void {
              if (!$sp->isConnected()) {
                return;
              }

              if (!$inventory->slotExists($slot)) {
                return;
              }

              $session = $sp->getNetworkSession();
              $invManager = $session->getInvManager();

              // Ensure InventoryManager is tracking this slot, or syncSlot() will throw an exception
              if ($invManager->getItemStackInfo($inventory, $slot) === null) {
                return;
              }

              $typeConverter = $session->getTypeConverter();
              $itemStack = $typeConverter->coreItemStackToNet($inventory->getItem($slot));
              $invManager->syncSlot($inventory, $slot, $itemStack);

              if (SwimCore::$DEBUG) {
                echo("Syncing hot bar web hack for {$sp->getName()} at inventory slot {$slot}\n");
              }
            }),
            $delay // ticks
          );

          // Done since we got a web
          return;
        }
      }
    }
  }

  public function blockBreakCallback(BlockBreakEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::BLOCK_BREAK_EVENT);
    if ($event->isCancelled()) return;
    $sp->getSceneHelper()?->getScene()->sceneBlockBreakEvent($event, $sp);
    // desperate fix
    if (!$sp->getSceneHelper()) {
      $event->cancel();
    } else if (!$sp->getSceneHelper()->getScene()) {
      $event->cancel();
    }
  }

  public function bucketEmpty(PlayerBucketEmptyEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::BUCKET_EMPTY_EVENT);
    if ($event->isCancelled()) return;

    $scene = $sp->getSceneHelper()?->getScene();
    if ($scene) {
      $scene->sceneBucketEmptyEvent($event, $sp);
      if (!$event->isCancelled()) {
        $scene->getBlockManager()?->handleBucketDump($event);
      }
    }
  }

  public function bucketFill(PlayerBucketFillEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::BUCKET_FILL_EVENT);
    if ($event->isCancelled()) return;
    $sp->getSceneHelper()?->getScene()->sceneBucketFillEvent($event, $sp);
  }

  public function blockSpread(BlockSpreadEvent $event): void
  {
    $this->handleNaturalEvent($event);
  }

  public function blockForm(BlockFormEvent $event): void
  {
    $this->handleNaturalEvent($event);
  }

  private function handleNaturalEvent(BlockSpreadEvent|BlockFormEvent $event): void
  {
    $scene = $this->getSceneFromBlockEvent($event); // attempt to get the scene the block event happened in
    if ($scene) {
      $scene->getBlockManager()?->handleNaturalBlockEvent($event);
    } else {
      $event->cancel();
    }
  }

  private function getSceneFromBlockEvent(BlockSpreadEvent|BlockFormEvent $event): ?Scene
  {
    $pos = $event->getBlock()->getPosition();
    $nearest = PositionHelper::getNearestPlayer($pos); // nearest player's scene (this is only going to work well for scenes that are seperated far away)
    return $nearest?->getSceneHelper()?->getScene();
  }

  public function startFlying(PlayerToggleFlightEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::PLAYER_TOGGLE_FLIGHT_EVENT);
    if ($event->isCancelled()) return;
    $sp->getSceneHelper()?->getScene()->scenePlayerToggleFlightEvent($event, $sp);
  }

  public function jumped(PlayerJumpEvent $event): void
  {
    /* @var SwimPlayer $sp */
    $sp = $event->getPlayer();
    $sp->event($event, BehaviorEventEnum::PLAYER_JUMP_EVENT);
    $sp->getSceneHelper()?->getScene()->scenePlayerJumpEvent($event, $sp);
  }

  public function dataPacketReceiveEvent(DataPacketReceiveEvent $event): void
  {
    $player = $event->getOrigin()?->getPlayer();
    if (!isset($player)) return;

    /** @var SwimPlayer $player */
    if ($player->isOnline()) {
      // $player->event($event, BehaviorEventEnums::DATA_PACKET_RECEIVE_EVENT);
      $player->getSceneHelper()?->getScene()?->sceneDataPacketReceiveEvent($event, $player);
    }
  }

}
