<?php

namespace core\listeners;

use core\SwimCore;
use core\systems\player\PlayerSystem;
use core\systems\player\SwimPlayer;
use core\systems\SystemManager;
use core\utils\acktypes\EntityPositionAck;
use core\utils\acktypes\EntityRemovalAck;
use core\utils\acktypes\KnockbackAck;
use core\utils\raklib\StubLogger;
use core\utils\raklib\SwimNetworkSession;
use Exception;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\inventory\EnchantInventory;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\animation\ArmSwingAnimation;
use pocketmine\entity\Location;
use pocketmine\entity\object\FallingBlock;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockBurnEvent;
use pocketmine\event\block\BlockGrowEvent;
use pocketmine\event\block\BlockMeltEvent;
use pocketmine\event\block\LeavesDecayEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\entity\EntityTrampleFarmlandEvent;
use pocketmine\event\Event;
use pocketmine\event\inventory\InventoryCloseEvent;
use pocketmine\event\inventory\InventoryOpenEvent;
use pocketmine\event\inventory\InventoryTransactionEvent;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerExhaustEvent;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\event\world\WorldLoadEvent;
use pocketmine\inventory\PlayerCursorInventory;
use pocketmine\inventory\PlayerInventory;
use pocketmine\inventory\PlayerOffHandInventory;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\ConsumableItem;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\VanillaItems;
use pocketmine\network\mcpe\protocol\ActorEventPacket;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\AddPlayerPacket;
use pocketmine\network\mcpe\protocol\BlockEventPacket;
use pocketmine\network\mcpe\protocol\CommandRequestPacket;
use pocketmine\network\mcpe\protocol\CraftingDataPacket;
use pocketmine\network\mcpe\protocol\CreativeContentPacket;
use pocketmine\network\mcpe\protocol\DataPacket;
use pocketmine\network\mcpe\protocol\InteractPacket;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\MoveActorAbsolutePacket;
use pocketmine\network\mcpe\protocol\MoveActorDeltaPacket;
use pocketmine\network\mcpe\protocol\NetworkStackLatencyPacket;
use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\network\mcpe\protocol\RemoveActorPacket;
use pocketmine\network\mcpe\protocol\RequestChunkRadiusPacket;
use pocketmine\network\mcpe\protocol\ResourcePacksInfoPacket;
use pocketmine\network\mcpe\protocol\ResourcePackStackPacket;
use pocketmine\network\mcpe\protocol\ServerboundDiagnosticsPacket;
use pocketmine\network\mcpe\protocol\ServerboundPacket;
use pocketmine\network\mcpe\protocol\ServerSettingsRequestPacket;
use pocketmine\network\mcpe\protocol\SetActorDataPacket;
use pocketmine\network\mcpe\protocol\SetActorMotionPacket;
use pocketmine\network\mcpe\protocol\SetPlayerGameTypePacket;
use pocketmine\network\mcpe\protocol\SetTimePacket;
use pocketmine\network\mcpe\protocol\StartGamePacket;
use pocketmine\network\mcpe\protocol\TextPacket;
use pocketmine\network\mcpe\protocol\types\ActorEvent;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use pocketmine\network\mcpe\protocol\types\command\CommandOriginData;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\network\mcpe\protocol\types\entity\StringMetadataProperty;
use pocketmine\network\mcpe\protocol\types\Experiments;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemTransactionData;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\network\mcpe\protocol\types\recipe\ShapedRecipe;
use pocketmine\network\mcpe\protocol\types\recipe\ShapelessRecipe;
use pocketmine\network\mcpe\protocol\types\resourcepacks\ResourcePackStackEntry;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\player\XboxLivePlayerInfo;
use pocketmine\scheduler\ClosureTask;
use pocketmine\world\format\io\BaseWorldProvider;
use pocketmine\world\World;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;

// this listener is just a bunch of tweaks to make global vanilla events better

class WorldListener implements Listener
{

  private SwimCore $core;
  private PlayerSystem $playerSystem;
  private SystemManager $systemManager;

  private array $eduItemIds = []; // education item crap to filter out from the client
  private array $armorSounds = [];

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->systemManager = $this->core->getSystemManager();
    $this->playerSystem = $this->systemManager->getPlayerSystem();
    $this->cacheArmorSounds();
  }

  // not every scene might want this lapis behavior!

  public function openTable(InventoryOpenEvent $e): void
  {
    $inventory = $e->getInventory();
    if ($inventory instanceof EnchantInventory) {
      // add nbt if u want
      $inventory->setItem(1, VanillaItems::LAPIS_LAZULI()->setCount(64)->setCustomName("Lapis"));
    }
  }

  public function closeTable(InventoryCloseEvent $event): void
  {
    $inventory = $event->getInventory();
    $player = $event->getPlayer();
    if ($inventory instanceof EnchantInventory) {
      $inventory->clear(1);
    }
  }

  public function onDropItem(PlayerDropItemEvent $event): void
  {
    $player = $event->getPlayer();
    $item = $event->getItem();
    if ($item->hasCustomName()) {
      if ($item->getTypeId() === VanillaItems::LAPIS_LAZULI()->getTypeId()) {
        $player->getInventory()->remove($item);
        $event->cancel();
      }
    }
  }

  // this is only for making it so the player can not move lapis out of the enchantment table
  // again not every scene might want this behavior!
  public function onEnchantInv(InventoryTransactionEvent $event): void
  {
    foreach ($event->getTransaction()->getInventories() as $inventory) {
      if ($inventory instanceof EnchantInventory) {
        foreach ($event->getTransaction()->getActions() as $action) {
          if ($action instanceof SlotChangeAction) {
            if ($action->getTargetItem()->getTypeId() === VanillaItems::LAPIS_LAZULI()->getTypeId()) {
              $event->cancel();
            }
          }
        }
      }
    }
  }

  /* not active anymore
  public function onGameModeChange(PlayerGameModeChangeEvent $event): void
  {
    /* @var SwimPlayer $player */
  /*
    $player = $event->getPlayer();
    if ($player->getGamemode() == GameMode::SPECTATOR) {
      if (SwimCore::$DEBUG) {
        echo("Scuffed spectator gamemode change skin fix on {$player->getName()}\n");
      }
      $player->sendSkin($player->getPlayersWeShouldSendOurSkinTo());
    }
  }
  */


  /**
   * Desperate steve glitch skin fix due to the client aggressively unloading skins from players far away.
   * This gets called A LOT, so skin refresh has to be implemented smartly
   * @deprecated not needed anymore, literally brought more errors than it solved in terms of performance for the one verison this was a bug on.
   * public function onChunkLoad(PlayerPostChunkSendEvent $event): void
   * {
   * $player = $event->getPlayer();
   * $player->getSceneHelper()?->skinRefresh();
   * }
   */

  public function cacheArmorSounds(): void
  {
    $refl = new ReflectionClass(LevelSoundEvent::class);
    foreach ($refl->getConstants() as $name => $value) {
      if (str_starts_with($name, "ARMOR_EQUIP")) {
        $this->armorSounds[] = $value;
      }
    }
  }

  /**
   * @throws ReflectionException
   */
  public function onWorldLoad(WorldLoadEvent $event): void
  {
    self::disableWorldLogging($event->getWorld());
  }

  /**
   * @throws ReflectionException
   */
  public static function disableWorldLogging(World $world): void
  {
    $provider = $world->getProvider();
    (new ReflectionClass(BaseWorldProvider::class))->getProperty("logger")->setValue($provider, new StubLogger());
    echo("Disabling world logging on world | Display: {$world->getDisplayName()} | Folder: {$world->getFolderName()}\n");
  }

  // void can't kill unless we are really low
  public function onEntityVoid(EntityDamageEvent $event): void
  {
    if ($event->getCause() == EntityDamageEvent::CAUSE_VOID) {
      $entity = $event->getEntity();
      if ($entity->getPosition()->getY() > -200) {
        $event->cancel();
      }
    }
  }

  public function onLeavesDecay(LeavesDecayEvent $event): void
  {
    $event->cancel();
  }

  public function onGrow(BlockGrowEvent $event): void
  {
    $event->cancel();
  }

  public function onBurn(BlockBurnEvent $event): void
  {
    $event->cancel();
  }

  public function onMelt(BlockMeltEvent $event): void
  {
    $event->cancel();
  }

  // cancels trying to use beds and cancels door opens in the hub
  public function hubBlockInteract(PlayerInteractEvent $event): void
  {
    // No sleeping!
    if ($event->getAction() == PlayerInteractEvent::RIGHT_CLICK_BLOCK && $event->getBlock()->getTypeId() == BlockTypeIds::BED) {
      $event->cancel();
      return;
    }

    $player = $event->getPlayer();
    if (!$player->isCreative() && $player->getWorld()->getFolderName() === "hub") {
      $blockName = strtolower($event->getBlock()->getName());
      if (str_contains($blockName, "door") || str_contains($blockName, "gate")) {
        $event->cancel();
      }
    }
  }

  /** Disable offhand functionality and fix items not stacking to other compatible slots
   * when shift clicking on an item with a custom name and type id that matches.
   * @priority HIGHEST
   */
  public function fixTransaction(InventoryTransactionEvent $event): void
  {
    $doLog = SwimCore::$DEBUG;
    $transaction = $event->getTransaction();
    $player = $transaction->getSource();

    if ($doLog) {
      echo("[InvFix] === New transaction from player ===\n");
    }

    $inventories = $transaction->getInventories();

    // 1. Disable offhand completely
    foreach ($inventories as $inventory) {
      if ($inventory instanceof PlayerOffHandInventory) {
        if ($doLog) {
          echo("[InvFix] Found PlayerOffHandInventory in transaction, cancelling.\n");
        }
        $event->cancel();
        return;
      }
    }

    // Only apply the stacking hack when the transaction actually involves:
    // - the player's inventory, AND
    // - some other "real" inventory (chest, custom container, etc.),
    // NOT just the cursor.
    $playerInventory = $player->getInventory();

    $hasRealOtherInventory = false;

    foreach ($inventories as $inventory) {
      if (
        !$inventory instanceof PlayerInventory &&
        !$inventory instanceof PlayerOffHandInventory &&
        !$inventory instanceof PlayerCursorInventory
      ) {
        $hasRealOtherInventory = true;
        if ($doLog) {
          echo("[InvFix] Detected real other inventory of type " . get_class($inventory) . " in transaction.\n");
        }
      } elseif ($inventory instanceof PlayerCursorInventory) {
        if ($doLog) {
          echo("[InvFix] Detected PlayerCursorInventory in transaction (cursor). Ignoring as 'real other inventory'.\n");
        }
      }
    }

    if (!$hasRealOtherInventory) {
      if ($doLog) {
        echo("[InvFix] No real other inventory involved (only player inventory + cursor/etc). Letting vanilla behavior handle it.\n");
      }
      return;
    }

    if ($doLog) {
      echo("[InvFix] Real other inventory present. Checking actions for custom named stackable moves into player inventory...\n");
    }

    foreach ($transaction->getActions() as $action) {
      if (!$action instanceof SlotChangeAction) {
        if ($doLog) {
          echo("[InvFix] Skipping non-slot action.\n");
        }
        continue;
      }

      $inventory = $action->getInventory();

      // We only care about items that end up in the player's main inventory
      if (!$inventory instanceof PlayerInventory) {
        if ($doLog) {
          echo("[InvFix] SlotChangeAction target inventory is not PlayerInventory (" . get_class($inventory) . "). Skipping.\n");
        }
        continue;
      }

      $slot = $action->getSlot();
      $sourceItem = $action->getSourceItem();
      $targetItem = $action->getTargetItem();

      if ($doLog) {
        echo("[InvFix] Considering PlayerInventory SlotChangeAction at slot {$slot}.\n");
        echo("[InvFix]   Source: typeId=" . $sourceItem->getTypeId() . " customName='"
          . $sourceItem->getCustomName() . "' count=" . $sourceItem->getCount() . "\n");
        echo("[InvFix]   Target: typeId=" . $targetItem->getTypeId() . " customName='"
          . $targetItem->getCustomName() . "' count=" . $targetItem->getCount() . "\n");
      }

      // Two patterns we care about:
      // 1) Empty slot -> item  (AIR -> stack)  => normal "put into empty slot"
      // 2) Existing stack -> bigger stack     => "stacking into existing slot"
      $isEmptyToItem = $sourceItem->isNull() && !$targetItem->isNull();

      $isStackIncrease =
        !$sourceItem->isNull() &&
        !$targetItem->isNull() &&
        $sourceItem->getTypeId() === $targetItem->getTypeId() &&
        $sourceItem->getCustomName() === $targetItem->getCustomName() &&
        $targetItem->getCount() > $sourceItem->getCount();

      if (!$isEmptyToItem && !$isStackIncrease) {
        if ($doLog) {
          echo("[InvFix]   Skipping: not an empty->item or stack-increase pattern.\n");
        }
        continue;
      }

      // Only bother with stackable items
      $maxStackSize = min($targetItem->getMaxStackSize(), $playerInventory->getMaxStackSize());
      if ($maxStackSize <= 1) {
        if ($doLog) {
          echo("[InvFix]   Skipping: item is not stackable (maxStackSize={$maxStackSize}).\n");
        }
        continue;
      }

      // Only hack for custom named items
      if ($targetItem->getCustomName() === '') {
        if ($doLog) {
          echo("[InvFix]   Skipping: target item has no custom name, using vanilla behavior.\n");
        }
        continue;
      }

      // How many items is this action trying to add to the player inventory?
      // - For empty->item, it's the entire target count.
      // - For stack-increase, it's the delta between target and source counts.
      if ($isEmptyToItem) {
        $movedCount = $targetItem->getCount();
      } else { // $isStackIncrease
        $movedCount = $targetItem->getCount() - $sourceItem->getCount();
      }

      if ($movedCount <= 0) {
        if ($doLog) {
          echo("[InvFix]   Skipping: movedCount={$movedCount} (nothing to route).\n");
        }
        continue;
      }

      if ($doLog) {
        echo("[InvFix]   Candidate for stacking hack: typeId=" . $targetItem->getTypeId()
          . " customName='" . $targetItem->getCustomName()
          . "', movedCount={$movedCount}.\n");
        if ($isEmptyToItem) {
          echo("[InvFix]   Pattern: EMPTY -> ITEM (new stack in slot {$slot}).\n");
        } else {
          echo("[InvFix]   Pattern: STACK INCREASE in slot {$slot}.\n");
        }
      }

      // Track which slots we need to sync after our manual changes.
      $playerSlotsToSync = []; // [slot => true]
      $otherSlotsToSync = [];  // [[Inventory, slot], ...]

      // If this was a stack-increase action, revert this slot back to the original
      // state before we start re-routing items, so we don't double-count.
      if ($isStackIncrease) {
        $playerInventory->setItem($slot, $sourceItem);
        $playerSlotsToSync[$slot] = true;
        if ($doLog) {
          echo("[InvFix]   Reverting slot {$slot} to original stack before custom routing.\n");
        }
      }

      $remaining = $movedCount;
      $merged = 0;

      // First pass: fill existing stacks of the same type id + custom name that have space
      for ($i = 0, $size = $playerInventory->getSize(); $i < $size && $remaining > 0; $i++) {
        // We don't specially skip $slot here: if this was an EMPTY->ITEM case,
        // the slot was empty, and our logic will treat it like any other slot.
        // If it was STACK INCREASE, we just reverted it to the old stack
        // and can also consider it as a candidate stacking slot.
        $existing = $playerInventory->getItem($i);
        if ($existing->isNull()) {
          continue;
        }

        if ($existing->getTypeId() !== $targetItem->getTypeId()) {
          continue;
        }

        if ($existing->getCustomName() !== $targetItem->getCustomName()) {
          continue;
        }

        if ($existing->getCount() >= $maxStackSize) {
          if ($doLog) {
            echo("[InvFix]   Slot {$i}: matching stack full (typeId=" . $existing->getTypeId() . ", customName='"
              . $existing->getCustomName() . "').\n");
          }
          continue;
        }

        $space = $maxStackSize - $existing->getCount();
        if ($space <= 0) {
          continue;
        }

        $move = min($remaining, $space);

        if ($doLog) {
          echo("[InvFix]   Stacking into slot {$i}:"
            . " typeId=" . $existing->getTypeId()
            . " customName='" . $existing->getCustomName() . "'"
            . " currentCount=" . $existing->getCount()
            . " move={$move}"
            . " maxStackSize={$maxStackSize}"
            . "\n"
          );
        }

        $existing->setCount($existing->getCount() + $move);
        $playerInventory->setItem($i, $existing);

        $remaining -= $move;
        $merged += $move;

        $playerSlotsToSync[$i] = true;

        if ($doLog) {
          echo("[InvFix]   After stack: slot {$i} count=" . $existing->getCount() . ", remaining={$remaining}.\n");
        }
      }

      // Second pass (only for EMPTY->ITEM): if we still have remaining and there
      // are empty slots, place leftovers into the original target slot.
      if ($isEmptyToItem && $remaining > 0) {
        // Make sure the original slot is treated as the "fallback" destination.
        $leftover = clone $targetItem;
        $leftover->setCount($remaining);
        $playerInventory->setItem($slot, $leftover);
        $playerSlotsToSync[$slot] = true;

        if ($doLog) {
          echo("[InvFix]   Placed leftover stack in original target slot {$slot}:"
            . " typeId=" . $leftover->getTypeId()
            . " customName='" . $leftover->getCustomName() . "'"
            . " count=" . $leftover->getCount()
            . "\n"
          );
        }

        $merged += $remaining;
        $remaining = 0;
      }

      if ($merged > 0) {
        if ($doLog) {
          echo("[InvFix]   Merged {$merged} items into existing stacks for typeId=" . $targetItem->getTypeId()
            . " customName='" . $targetItem->getCustomName() . "'.\n");
        }

        // We successfully re-routed at least some items, so we own the entire transaction now.
        // Cancel the original transaction so PocketMine doesn't also try to apply it.
        $event->cancel();
        if ($doLog) {
          echo("[InvFix]   Cancelled original transaction; applying manual adjustments.\n");
        }

        // The clicked slot in the *source* inventory will have been updated by other
        // SlotChangeActions in the original transaction, but we cancelled that.
        // We should clear/adjust it manually to emulate a full "move" from that inventory.
        foreach ($transaction->getActions() as $other) {
          if (!$other instanceof SlotChangeAction) {
            continue;
          }

          // Skip player inventory; we only want to clear the "from" side in other inventories.
          if ($other->getInventory() === $inventory) {
            continue;
          }

          // Also skip cursor inventory – we explicitly don't want to hack cursor moves.
          if ($other->getInventory() instanceof PlayerCursorInventory) {
            if ($doLog) {
              echo("[InvFix]   Skipping clear for PlayerCursorInventory slot " . $other->getSlot() . " (cursor).\n");
            }
            continue;
          }

          $otherSource = $other->getSourceItem();
          $otherTarget = $other->getTargetItem();

          // Typical pattern for moving from another inventory:
          // sourceSlot: item -> AIR (target is null item) or decreased count.
          if (!$otherSource->isNull()) {
            $fromInv = $other->getInventory();
            $fromSlot = $other->getSlot();

            if ($doLog) {
              echo("[InvFix]   Applying source inventory change at slot {$fromSlot}:"
                . " typeId=" . $otherSource->getTypeId()
                . " customName='" . $otherSource->getCustomName() . "'"
                . " -> target typeId=" . $otherTarget->getTypeId()
                . " customName='" . $otherTarget->getCustomName() . "'"
                . " count=" . $otherTarget->getCount()
                . "\n"
              );
            }

            // We trust the chest-side target item (reduced stack / AIR) as-is.
            $fromInv->setItem($fromSlot, $otherTarget);
            $otherSlotsToSync[] = [$fromInv, $fromSlot];
          }
        }

        // Force sync of all affected slots after a short delay so the client state matches the server.
        if ($player->isConnected()) {
          $delay = 1;

          if ($doLog) {
            echo("[InvFix]   Scheduling delayed sync for modified slots.\n");
          }

          $this->core->getScheduler()->scheduleDelayedTask(
            new ClosureTask(function () use ($player, $playerInventory, $playerSlotsToSync, $otherSlotsToSync, $doLog): void {
              if (!$player->isConnected()) {
                return;
              }

              $session = $player->getNetworkSession();
              $invManager = $session->getInvManager();
              $typeConverter = $session->getTypeConverter();

              // Sync player inventory slots we touched
              foreach (array_keys($playerSlotsToSync) as $slot) {
                if (!$playerInventory->slotExists($slot)) {
                  continue;
                }

                if ($invManager->getItemStackInfo($playerInventory, $slot) === null) {
                  continue;
                }

                $item = $playerInventory->getItem($slot);
                $itemStack = $typeConverter->coreItemStackToNet($item);
                $invManager->syncSlot($playerInventory, $slot, $itemStack);

                if ($doLog) {
                  echo("[InvFix]   [Sync] Player inv slot {$slot}: typeId=" . $item->getTypeId()
                    . " customName='" . $item->getCustomName() . "' count=" . $item->getCount() . "\n");
                }
              }

              // Sync source/container inventory slots we changed
              foreach ($otherSlotsToSync as [$inv, $slot]) {
                if (!$inv->slotExists($slot)) {
                  continue;
                }

                if ($invManager->getItemStackInfo($inv, $slot) === null) {
                  continue;
                }

                $item = $inv->getItem($slot);
                $itemStack = $typeConverter->coreItemStackToNet($item);
                $invManager->syncSlot($inv, $slot, $itemStack);

                if ($doLog) {
                  echo("[InvFix]   [Sync] Other inv slot {$slot}: typeId=" . $item->getTypeId()
                    . " customName='" . $item->getCustomName() . "' count=" . $item->getCount() . "\n");
                }
              }
            }),
            $delay
          );
        }

        if ($doLog) {
          echo("[InvFix] === Finished custom stacking handling for this transaction ===\n");
        }
        // We handled this transaction completely; no need to check more actions.
        return;
      }

      if ($doLog) {
        echo("[InvFix]   No compatible stack found for typeId=" . $targetItem->getTypeId()
          . " customName='" . $targetItem->getCustomName() . "'. Letting vanilla behavior handle it.\n");
      }
      // If merged == 0, we let PocketMine handle this normally.
    }

    if ($doLog) {
      echo("[InvFix] Reached end of fixTransaction without intervening. Vanilla behavior used.\n");
    }
  }

  // disable sending the chemistry pack to players on joining so particles look fine
  public function onDataPacketSendEvent(DataPacketSendEvent $event): void
  {
    $protocol = ProtocolInfo::CURRENT_PROTOCOL;
    if (isset($event->getTargets()[0]) && SwimCore::$isNetherGames) {
      $protocol = $event->getTargets()[0]->getProtocolId();
    }

    $packets = $event->getPackets();
    foreach ($packets as $packet) {
      if ($packet instanceof ResourcePackStackPacket) {
        $stack = $packet->resourcePackStack;
        foreach ($stack as $key => $pack) {
          if ($pack->getPackId() === "0fba4063-dba1-4281-9b89-ff9390653530") {
            unset($packet->resourcePackStack[$key]);
            break;
          }
        }
        // experiment resource pack
        if ($protocol == 671) {
          $packet->experiments = new Experiments(["updateAnnouncedLive2023" => true], true);
          $stack[] = new ResourcePackStackEntry("d8989e4d-5217-4d57-a6f6-1787c620be97", "0.0.1", "");
        }
        break;
      }
    }
  }

  // prevent player drops (be mindful of this event's existence if we are ever programming a game where we want entity drops to go somewhere like a chest)
  public function onPlayerDeath(PlayerDeathEvent $event): void
  {
    $event->setDrops([]);
    $event->setXpDropAmount(0);
  }

  // prevent switch hits
  /* we already do this in player listener
  public function onEntityDamagedByEntity(EntityDamageByEntityEvent $event)
  {
    if ($event->getModifier(EntityDamageEvent::MODIFIER_PREVIOUS_DAMAGE_COOLDOWN) < 0) {
      $event->cancel();
    }
  }
  */

  /* this was screwing stuff up and not showing break progress on anything at all
  public function onBlockInteract(PlayerInteractEvent $event)
  {
    $player = $event->getPlayer();
    if (!$player->isCreative()) {
      $block = $event->getBlock();
      $id = $block->getTypeId();
      if ($id == BlockTypeIds::CHEST || $id == BlockTypeIds::ENDER_CHEST) return; // if it's a chest we can interact with it so exit out early

      // cancel log stripping
      $heldItem = $player->getInventory()->getItemInHand();
      if (str_contains(strtolower($heldItem->getName()), "axe")) {
        $event->cancel();
      }

      // cancel sign editing
      if (str_contains(strtolower($event->getBlock()->getName()), "sign")) {
        $event->cancel();
      }
    }
  }
  */

  public function onBlockFall(EntitySpawnEvent $event): void
  {
    $fallingBlockEntity = $event->getEntity();
    if ($fallingBlockEntity instanceof FallingBlock) {
      $block = $fallingBlockEntity->getBlock();
      $world = $fallingBlockEntity->getWorld();
      $world->setBlock($block->getPosition(), $block, false);
      $fallingBlockEntity->kill();
    }
  }

  // never have exhaust
  public function onExhaust(PlayerExhaustEvent $event): void
  {
    $event->cancel();
  }

  // cancel swimming animation (don't think this works)
  /*
  public function onSwim(PlayerToggleSwimEvent $event)
  {
    $event->cancel();
  }
  */

  // cancel weird drops
  public function onBlockBreak(BlockBreakEvent $event): void
  {
    $id = $event->getBlock()->getTypeId();
    if ($id == BlockTypeIds::TALL_GRASS
      || $id == BlockTypeIds::DOUBLE_TALLGRASS
      || $id == BlockTypeIds::SUNFLOWER
      || $id == BlockTypeIds::COBWEB
      || $id == BlockTypeIds::LARGE_FERN
      || $id == BlockTypeIds::CAMPFIRE
    ) {
      $event->setDrops([]);
    }
  }

  // does a swing animation fix than an ID based switch statement for doing specific things related to packet receiving
  // The most crucial thing by far is calling the recv() method on nsl receive
  public function onDataPacketReceive(DataPacketReceiveEvent $event): void
  {
    $packet = $event->getPacket();
    $player = $event->getOrigin()->getPlayer();
    if ($player) {
      /** @var SwimPlayer $player */
      $this->swingAnimationFix($event, $packet, $player);
      $this->handleReceive($packet, $player, $event);
    }
  }

  private function swingAnimationFix(DataPacketReceiveEvent $event, ServerboundPacket $packet, Player $player): void
  {
    if ($packet->pid() == LevelSoundEventPacket::NETWORK_ID) {
      /** @var LevelSoundEventPacket $packet */
      if ($packet->sound == LevelSoundEvent::ATTACK_NODAMAGE) {
        $player->broadcastAnimation(new ArmSwingAnimation($player), $player->getViewers());
        $event->cancel(); // cancel to remove sound I guess
      }
    }
  }

  /**
   * this code is a god awful mess, but does what is needed for the time being, a lot of commented out code due to porting this from Divinity
   */
  private function handleReceive(ServerboundPacket $packet, SwimPlayer $player, DataPacketReceiveEvent $event): void
  {
    switch ($packet->pid()) {
      case InventoryTransactionPacket::NETWORK_ID:
        /** @var InventoryTransactionPacket $packet */
        if ($packet->trData instanceof UseItemTransactionData && $packet->trData->getActionType() === UseItemTransactionData::ACTION_BREAK_BLOCK
          && ($player->getGamemode() === GameMode::SURVIVAL || $player->getGamemode() === GameMode::ADVENTURE)) {
          $event->cancel();
        }
        /*
        if ($packet->trData instanceof UseItemTransactionData && $packet->trData->getActionType() === UseItemTransactionData::ACTION_CLICK_BLOCK
          && $player->getSettings()->seasonalEffects && $player->getSceneClass()?->getSnowy()) {
          $event->cancel();
        }
        */
        break;

      case ActorEventPacket::NETWORK_ID:
        /** @var ActorEventPacket $packet */
        if ($packet->eventId != ActorEvent::EATING_ITEM) return;

        if (!$player->getInventory()->getItemInHand() instanceof ConsumableItem) {
          $event->cancel();
          if ($player->getInventory()->getItemInHand()->getTypeId() == VanillaBlocks::AIR()->asItem()->getTypeId())
            return;

          if ($packet->actorRuntimeId != $player->getId())
            print ("ID mismatch\n");
        }
        break;

      case NetworkStackLatencyPacket::NETWORK_ID:
        /** @var NetworkStackLatencyPacket $packet */
        $player->getAckHandler()?->recv($packet); // this is CRUCIAL
        return;

      case RequestChunkRadiusPacket::NETWORK_ID:
        /*
        if (isset($packet->maxRadius) && $this->divinityCore->acOn) {
          $this->core->getAcUtils()->checkGophertunnel($player, $packet);
        }
        */
        break;
      case ServerboundDiagnosticsPacket::NETWORK_ID:
        /** @var ServerboundDiagnosticsPacket $packet */
        // $player->setFps((int) $packet->getAvgFps()); // we don't have a use for this yet
        break;
      case CommandRequestPacket::NETWORK_ID:
        /** @var CommandRequestPacket $packet */
        if ($packet->originData->type !== CommandOriginData::ORIGIN_PLAYER) {
          $event->cancel();
          return;
        }
        break;
      case ServerSettingsRequestPacket::NETWORK_ID:
        // (new SettingsForm($this->divinityCore))->settingsForm($player, true);
        break;
      case InteractPacket::NETWORK_ID:
        /** @var InteractPacket $packet */
        if ($packet->action === InteractPacket::ACTION_LEAVE_VEHICLE) {
          /* TODO FOR LATER ONCE RIDEABLE MOBS ARE IMPLEMENTED
          if ($packet->targetActorRuntimeId === $player->getRidingEntityId()) {
            $player->removeRidingEntity();
          }
          */
        }
        break;
    }

    // seems unneeded due to swim core framework already ticking everything when needed
    // $this->tickDetections($player, $packet, $event);
  }

  // useless for the time being due to swimcore framework already doing this stuff, the add after packet handle cb is interesting though
  private function tickDetections(SwimPlayer $player, DataPacket $packet, Event $event): void
  {
    // PluginTimings::$acChecks->startTiming();
    //foreach ($player->getAntiCheatData()->getDetections() as $detection) {
    // if ($detection->handlesPacket($packet->pid())) {
    //  if ($detection->shouldProcessAfterHandling()) {
    /** @var SwimNetworkSession */
    //$ns = $player->getNetworkSession();
    //$ns->addAfterPacketHandledCb(function() use($detection, $event) : void {
    // $detection->getTimings()->startTiming();
    //$detection->handle($event);
    // $detection->getTimings()->stopTiming();
    // });
    // } else {
    // $detection->getTimings()->startTiming();
    //$detection->handle($event);
    // $detection->getTimings()->stopTiming();
    // }
    // }
    //}
    // PluginTimings::$acChecks->stopTiming();
  }

  private function enableVibrantVisuals(DataPacketSendEvent $event, ResourcePacksInfoPacket $packet): void
  {
    (new ReflectionProperty(ResourcePacksInfoPacket::class, "forceDisableVibrantVisuals"))->setValue($packet, false);
    $pl = $event->getTargets()[0];
    $info = $pl->getPlayerInfo();
    if ($info instanceof XboxLivePlayerInfo) {
      $event->cancel();
      $disableVibrantVisuals = false;
      (new ReflectionProperty(ResourcePacksInfoPacket::class, "forceDisableVibrantVisuals"))->setValue($packet, $disableVibrantVisuals);
      if ($pl instanceof SwimNetworkSession) {
        $pl->sendDataPacketNoEvent($packet);
      }
    }
  }

  /**
   * @throws Exception
   */
  public function onDataPacketSend(DataPacketSendEvent $event): void
  {
    $packets = $event->getPackets();

    foreach ($packets as $key => $packet) {
      switch ($packet->pid()) {
        case ResourcePacksInfoPacket::NETWORK_ID:
          /** @var $packet ResourcePacksInfoPacket */
          $this->enableVibrantVisuals($event, $packet);
          return;

        case CraftingDataPacket::NETWORK_ID:
          // $this->handleCraftingPacket($packet, $packets, $key); // I couldn't figure this out for only allowing certain recipes
          break;

        case SetTimePacket::NETWORK_ID:
          $this->handleSetTimePacket($packet, $packets, $key);
          break;

        case PlayerListPacket::NETWORK_ID:
          $this->handlePlayerListPacket($packet);
          break;

        case StartGamePacket::NETWORK_ID:
          $this->handleStartGamePacket($packet, $event, $key);
          break;

        case TextPacket::NETWORK_ID:
          /** @var TextPacket $packet */
          $this->handleTextPacket($packet, $event, $key);
          break;

        /* deprecated, See CustomItemLoader
      case CreativeContentPacket::NETWORK_ID:
        $this->handleCreativeContentPacket($packet, $event, $key);
        break;
        */

        case SetPlayerGameTypePacket::NETWORK_ID:
          $this->handleSetPlayerGameTypePacket($packet, $event, $key);
          break;

        case LevelSoundEventPacket::NETWORK_ID:
          $this->handleLevelSoundEventPacket($packet, $packets, $key);
          break;

        case BlockEventPacket::NETWORK_ID:
          $this->handleBlockEventPacket($packet, $packets, $key);
          break;

        case MoveActorAbsolutePacket::NETWORK_ID:
        case AddActorPacket::NETWORK_ID:
        case AddPlayerPacket::NETWORK_ID:
          $this->handleActorPackets($packet, $packets, $key, $event);
          break;

        case RemoveActorPacket::NETWORK_ID:
          $this->handleRemoveActorPacket($packet, $event);
          break;

        case SetActorMotionPacket::NETWORK_ID:
          $this->handleSetActorMotionPacket($packet, $event);
          break;

        default:
          // Optionally handle other packets or do nothing
          break;
      }
    }

    $event->setPackets($packets);
  }

  // On certain versions of the game, the client will instantly disconnect when given a text packet with no message on it.
  private function handleTextPacket(TextPacket $packet, &$packets, $key): void
  {
    // Do we want the not isset check too? Will it ever be null?
    if ($packet->message === "" || !isset($packet->message)) {
      unset($packets[$key]);
    }
  }

  // this is for ranked sky wars
  private static array $allowedRecipes = [
    // Essential items
    ItemTypeIds::STICK,
    ItemTypeIds::SHEARS,
    ItemTypeIds::BUCKET,

    // Diamond tools and armor
    ItemTypeIds::DIAMOND_SWORD,
    ItemTypeIds::DIAMOND_PICKAXE,
    ItemTypeIds::DIAMOND_AXE,
    ItemTypeIds::DIAMOND_SHOVEL,
    ItemTypeIds::DIAMOND_HOE,
    ItemTypeIds::DIAMOND_HELMET,
    ItemTypeIds::DIAMOND_CHESTPLATE,
    ItemTypeIds::DIAMOND_LEGGINGS,
    ItemTypeIds::DIAMOND_BOOTS,

    // Iron tools and armor
    ItemTypeIds::IRON_SWORD,
    ItemTypeIds::IRON_PICKAXE,
    ItemTypeIds::IRON_AXE,
    ItemTypeIds::IRON_SHOVEL,
    ItemTypeIds::IRON_HOE,
    ItemTypeIds::IRON_HELMET,
    ItemTypeIds::IRON_CHESTPLATE,
    ItemTypeIds::IRON_LEGGINGS,
    ItemTypeIds::IRON_BOOTS,

    // Gold tools and armor
    ItemTypeIds::GOLDEN_SWORD,
    ItemTypeIds::GOLDEN_PICKAXE,
    ItemTypeIds::GOLDEN_AXE,
    ItemTypeIds::GOLDEN_SHOVEL,
    ItemTypeIds::GOLDEN_HOE,
    ItemTypeIds::GOLDEN_HELMET,
    ItemTypeIds::GOLDEN_CHESTPLATE,
    ItemTypeIds::GOLDEN_LEGGINGS,
    ItemTypeIds::GOLDEN_BOOTS,

    // Stone tools
    ItemTypeIds::STONE_SWORD,
    ItemTypeIds::STONE_PICKAXE,
    ItemTypeIds::STONE_AXE,
    ItemTypeIds::STONE_SHOVEL,
    ItemTypeIds::STONE_HOE,

    // Wooden tools
    ItemTypeIds::WOODEN_SWORD,
    ItemTypeIds::WOODEN_PICKAXE,
    ItemTypeIds::WOODEN_AXE,
    ItemTypeIds::WOODEN_SHOVEL,
    ItemTypeIds::WOODEN_HOE,

    // Ranged weapons
    ItemTypeIds::BOW,
    ItemTypeIds::ARROW,
  ];

  private function handleCraftingPacket($packet, &$packets, $key): void
  {
    /** @var CraftingDataPacket $packet */

    // Iterate through the recipes to identify the ones you want to keep
    foreach ($packet->recipesWithTypeIds as $recipe) {
      if ($recipe instanceof ShapelessRecipe) {
        // Check if the output of the recipe matches allowed items
        foreach ($recipe->getOutputs() as $output) {
          if (in_array($output->getId(), self::$allowedRecipes, true)) {
            // Don't unset the packet if it contains an allowed recipe
            if (SwimCore::$DEBUG) {
              echo("Allowing item: " . $output->getId());
            }
            return;
          }
        }
      } else if ($recipe instanceof ShapedRecipe) {
        // Check if the output of the recipe matches allowed items
        $outputs = $recipe->getOutput();
        foreach ($outputs as $output) {
          if (in_array($output->getId(), self::$allowedRecipes, true)) {
            // Don't unset the packet if it contains an allowed recipe
            if (SwimCore::$DEBUG) {
              echo("Allowing item: " . $output->getId());
            }
            return;
          }
        }
      }
    }

    // Remove the packet if no allowed recipes are found
    unset($packets[$key]);
  }

  /**
   * Handles the SetTimePacket.
   */
  private function handleSetTimePacket($packet, &$packets, $key): void
  {
    /** @var SetTimePacket $packet */
    if ($packet->time >= 2000000000) {
      $packet->time -= 2000000000;
    } else {
      unset($packets[$key]);
    }
  }

  /**
   * Handles the PlayerListPacket.
   */
  private function handlePlayerListPacket($packet): void
  {
    /** @var PlayerListPacket $packet */
    foreach ($packet->entries as $entry) {
      $entry->xboxUserId = ""; // why do we do this?
    }
  }

  /**
   * Handles the StartGamePacket.
   */
  private function handleStartGamePacket($packet, $event, $key): void
  {
    /** @var StartGamePacket $packet */
    if (isset($packet->itemTable)) { // Vanilla PM does not have an item table
      for ($i = 0; $i < count($packet->itemTable); $i++) {
        if (str_contains($packet->itemTable[$i]->getStringId(), "element") ||
          str_contains($packet->itemTable[$i]->getStringId(), "chemistry")) {
          $playerName = $event->getTargets()[$key]->getPlayer()->getName() ?? "null";
          $this->eduItemIds[$playerName][] = $packet->itemTable[$i]->getNumericId();
          unset($packet->itemTable[$i]);
        }
      }
    }

    $packet->levelSettings->gameRules["dodaylightcycle"] = new BoolGameRule(false, false);
    $packet->levelSettings->gameRules["locatorBar"] = new BoolGameRule(false, false);
    $packet->levelSettings->time = World::TIME_DAY;

    $experiments = ["deferred_technical_preview" => true];

    $protocol = ProtocolInfo::CURRENT_PROTOCOL;
    if (isset($event->getTargets()[0]) && SwimCore::$isNetherGames) {
      $protocol = $event->getTargets()[0]->getProtocolId();
    }

    if ($protocol == 671) {
      $experiments["updateAnnouncedLive2023"] = true;
    }

    $packet->levelSettings->experiments = new Experiments($experiments, true);
  }

  /**
   * Handles the CreativeContentPacket.
   * @deprecated Deprecated, see CustomItemLoader
   */
  private function handleCreativeContentPacket($packet, $event, $key): void
  {
    /** @var CreativeContentPacket $packet */
    /*
    $entries = $packet->getEntries();
    for ($i = 0; $i < count($entries); $i++) {
      if (isset($entries[$i]) && in_array($entries[$i]->getItem()->getId(),
          $this->eduItemIds[$event->getTargets()[$key]->getPlayer()->getName() ?? "null"])) {
        unset($entries[$i]);
      }
    }

    $reflection = new ReflectionClass($packet);
    $property = $reflection->getProperty("entries");
    $property->setAccessible(true); // not sure why phpstorm throws a fit over this
    $property->setValue($packet, $entries);
    */
  }

  /**
   * Handles the SetPlayerGameTypePacket.
   */
  private function handleSetPlayerGameTypePacket($packet, $event, $key): void
  {
    /** @var SetPlayerGameTypePacket $packet */
    if ($packet->gamemode == GameMode::CREATIVE && count($event->getTargets()) > 0) {
      $firstTarget = array_values($event->getTargets())[$key] ?? null;
      if ($firstTarget) {
        $player = $firstTarget->getPlayer();
        if ($player !== null && $player->getGamemode() === GameMode::SPECTATOR) {
          // Assuming 6 corresponds to spectator or something, not sure, this might be for divinity setting custom types where you can see your own head
          $packet->gamemode = 6;
        }
      }
    }
  }

  /**
   * Handles the LevelSoundEventPacket.
   */
  private function handleLevelSoundEventPacket($packet, &$packets, $key): void
  {
    /** @var LevelSoundEventPacket $packet */
    $suppressSounds = [
      LevelSoundEvent::ATTACK_NODAMAGE,
      LevelSoundEvent::HIT,
      LevelSoundEvent::CHEST_CLOSED,
      LevelSoundEvent::CHEST_OPEN,
      LevelSoundEvent::ENDERCHEST_OPEN,
      LevelSoundEvent::ENDERCHEST_CLOSED
    ];

    if (in_array($packet->sound, $suppressSounds, true) || in_array($packet->sound, $this->armorSounds, true)) {
      unset($packets[$key]);
    }
  }

  /**
   * Handles the BlockEventPacket.
   */
  private function handleBlockEventPacket($packet, &$packets, $key): void
  {
    /** @var BlockEventPacket $packet */
    if ($packet->eventType == 1) {
      unset($packets[$key]);
    }
  }

  /**
   * Handles MoveActorAbsolutePacket, AddActorPacket, and AddPlayerPacket.
   */
  private function handleActorPackets($packet, &$packets, $key, $event): void
  {
    /** @var MoveActorAbsolutePacket|AddActorPacket|AddPlayerPacket $packet */
    $entity = $this->core->getServer()->getWorldManager()->findEntity($packet->actorRuntimeId);
    if ($entity instanceof SwimPlayer) {
      $tp = false;
      if (isset($packet->flags)) {
        $tp = ($packet->flags & MoveActorAbsolutePacket::FLAG_TELEPORT) > 0;
      }
      foreach ($event->getTargets() as $target) {
        if ($target instanceof SwimNetworkSession) {
          $target->addToNslBuffer(new EntityPositionAck($packet->position, $packet->actorRuntimeId, $tp));
        }
      }
    }

    // Special handling for AddActorPacket with FIREBALL type
    /*
    if ($packet->pid() === AddActorPacket::NETWORK_ID && $packet->type === EntityIds::FIREBALL) {
      if (isset($event->getTargets()[0])) {
        $player = $event->getTargets()[0]->getPlayer();
        if ($player !== null && $player->getSettings()->dragonFireball) {
          $packet->type = EntityIds::DRAGON_FIREBALL;
        }
      }
    }
    */

    // Handle delta updates if enabled
    if ($this->core->deltaOn && $entity !== null && isset($entity->supportsDelta)) {
      if ($packet->pid() === AddPlayerPacket::NETWORK_ID || $packet->pid() === AddActorPacket::NETWORK_ID) {
        $pos = $entity->getOffsetPosition($packet->position);
        $packets[] = MoveActorAbsolutePacket::create(
          $packet->actorRuntimeId,
          $pos,
          $packet->pitch,
          $packet->yaw,
          $packet->headYaw,
          0
        );
      }
      if ($packet->pid() === MoveActorAbsolutePacket::NETWORK_ID) {
        /** @var MoveActorAbsolutePacket $packet */
        $lastLocation = clone $entity->getPrevPos();
        $lastLocation->y = $entity->getOffsetPosition($lastLocation)->getY();
        $currentLocation = Location::fromObject($packet->position, null, $packet->yaw, $packet->pitch);

        $pk = new MoveActorDeltaPacket();
        $pk->actorRuntimeId = $packet->actorRuntimeId;
        $pk->flags = 0;

        if (($packet->flags & MoveActorAbsolutePacket::FLAG_GROUND) > 0) {
          $pk->flags |= MoveActorDeltaPacket::FLAG_GROUND;
        }

        if ($lastLocation->x !== $currentLocation->x) {
          $pk->xPos = $currentLocation->x;
          $pk->flags |= MoveActorDeltaPacket::FLAG_HAS_X;
        }
        if ($lastLocation->y !== $currentLocation->y) {
          $pk->yPos = $currentLocation->y;
          $pk->flags |= MoveActorDeltaPacket::FLAG_HAS_Y;
        }
        if ($lastLocation->z !== $currentLocation->z) {
          $pk->zPos = $currentLocation->z;
          $pk->flags |= MoveActorDeltaPacket::FLAG_HAS_Z;
        }
        if ($lastLocation->pitch !== $currentLocation->pitch) {
          $pk->pitch = $currentLocation->pitch;
          $pk->flags |= MoveActorDeltaPacket::FLAG_HAS_PITCH;
        }
        if ($lastLocation->yaw !== $currentLocation->yaw) {
          $pk->yaw = $currentLocation->yaw;
          $pk->flags |= MoveActorDeltaPacket::FLAG_HAS_YAW;
          $pk->headYaw = $currentLocation->yaw;
          $pk->flags |= MoveActorDeltaPacket::FLAG_HAS_HEAD_YAW;
        }
        $packets[$key] = $pk;
      }
    }

    // Existing processing for Actor Data Packets
    if ($packet->pid() == SetActorDataPacket::NETWORK_ID || $packet->pid() == AddActorPacket::NETWORK_ID || $packet->pid() == AddPlayerPacket::NETWORK_ID) {
      if (isset($event->getTargets()[0]) && count($event->getTargets()) == 1) {
        $target = $event->getTargets()[0];
        $player = $target->getPlayer();
        $swimPlayer = $this->playerSystem->getSwimPlayer($player);
        if ($swimPlayer) {
          if (!$swimPlayer->getSettings()->getToggle('showScoreTags')) {
            $packet->metadata[EntityMetadataProperties::SCORE_TAG] = new StringMetadataProperty("");
          } else if (!isset($packet->metadata[EntityMetadataProperties::SCORE_TAG])) {
            foreach ($this->core->getServer()->getOnlinePlayers() as $pl) {
              if ($pl->getId() == $packet->actorRuntimeId) {
                $packet->metadata[EntityMetadataProperties::SCORE_TAG] = new StringMetadataProperty($pl->getScoreTag());
                break;
              }
            }
          }
        }
      } else {
        foreach ($event->getTargets() as $target) {
          $target->sendDataPacket(clone($packet));
        }
        unset($packets[$key]);
      }
    }
  }

  /**
   * Handles the RemoveActorPacket.
   */
  private function handleRemoveActorPacket($packet, $event): void
  {
    /** @var RemoveActorPacket $packet */
    foreach ($event->getTargets() as $target) {
      if ($target instanceof SwimNetworkSession) {
        $target->addToNslBuffer(new EntityRemovalAck($packet->actorUniqueId));
      }
    }
  }

  /**
   * Handles the SetActorMotionPacket.
   */
  private function handleSetActorMotionPacket($packet, $event): void
  {
    /** @var SetActorMotionPacket $packet */
    foreach ($event->getTargets() as $target) {
      $pl = $target->getPlayer();
      if ($pl->getId() != $packet->actorRuntimeId) {
        continue;
      }
      if ($target instanceof SwimNetworkSession) {
        $target->addToNslBuffer(new KnockbackAck($packet->motion));
      }
    }
  }

  /* no longer called here manually as AckHandler has decoupled this logic into its self inside the recv() method, we also do actor handling packets in the code above
  private function processAck($packet, &$packets, $event): void
  {
    // add move actor absolute packets
    if ($packet instanceof MoveActorAbsolutePacket || $packet instanceof AddActorPacket || $packet instanceof AddPlayerPacket) {
      $timestamp = NetworkStackLatencyHandler::randomIntNoZeroEnd();
      $tp = false;
      if (isset($packet->flags)) {
        $tp = $packet->flags & MoveActorAbsolutePacket::FLAG_TELEPORT > 0;
      }
      foreach ($event->getTargets() as $target) {
        $pl = $target->getPlayer();
        $pl->getAckHandler()?->add($packet->actorRuntimeId, $packet->position, $timestamp, $tp);
      }

      $packets[] = NetworkStackLatencyPacket::create($timestamp * 1000, true);
    }

    // and then remove from the ack handler if needed
    if ($packet instanceof RemoveActorPacket) {
      $timestamp = NetworkStackLatencyHandler::randomIntNoZeroEnd();
      foreach ($event->getTargets() as $target) {
        $pl = $target->getPlayer();
        $pl->getAckHandler()?->addRemoval($packet->actorUniqueId, $timestamp);
      }
      $packets[] = NetworkStackLatencyPacket::create($timestamp * 1000, true);
    }

    // add motion if needed
    if ($packet instanceof SetActorMotionPacket) {
      $timestamp = NetworkStackLatencyHandler::randomIntNoZeroEnd();
      foreach ($event->getTargets() as $target) {
        $pl = $target->getPlayer();
        if ($pl->getId() != $packet->actorRuntimeId) continue;
        $pl->getAckHandler()?->addKb($packet->motion, $timestamp);
        $pl->getNetworkSession()->sendDataPacket(NetworkStackLatencyPacket::create($timestamp, true));
      }
    }
  }
  */

  public function noTrampling(EntityTrampleFarmlandEvent $event): void
  {
    $event->cancel();
  }

  public function onQueryRegenerate(QueryRegenerateEvent $ev): void
  {
    if (!$this->core->getRegionInfo()->isHub()) return;
    $total = 0;
    foreach ($this->core->getCommunicator()->getAllRegionPlayers() as $regionPlayers) {
      if (isset($regionPlayers)) {
        $total += count($regionPlayers);
      }
    }
    $count = $total + count($this->core->getServer()->getOnlinePlayers());
    $ev->getQueryInfo()->setPlayerCount($count);
    $ev->getQueryInfo()->setMaxPlayerCount($count + 1);
  }

}