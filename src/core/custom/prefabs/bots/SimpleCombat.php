<?php

namespace core\custom\prefabs\bots;

use core\systems\entity\Behavior;
use pocketmine\item\Armor;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

/*
 * This class has multiple priorities we might want to make into a behavior tree:
 * 1. Select best item and hold it for the current situation if we are in combat.
 * 2. Equip best armor in our inventory if needed.
 * 3. Select and use the best item if we need to do a different type of combat: agro pearl, throw snowball, throw de-buff potion, shoot bow.
 * 4. Select and use the best item if we need to heal: eat/use food, throw/drink heal potion, etc.
 * 5. Start swinging at target opponent if we are within range to do so and don't have any other survival critical responsibilities like healing.
 */

class SimpleCombat extends Behavior
{

  private ?BotPlayer $botPlayer = null;
  private ?Item $bestItemForAttacking = null;

  public function setBotPlayer(BotPlayer $botPlayer): void
  {
    $this->botPlayer = $botPlayer;
  }

  /**
   * @param int $currentScore The current equipped armor item in the armor inventory.
   * @param int $bestScore The best armor score over all.
   * @param int $bestSlot And where that armor item is in the inventory.
   * @param int $scoreToCompare The score we are checking.
   * @param int $slot And what slot that item comes from that we are checking.
   * @return void
   */
  private function compareAndUpdatePiecesByRef(int $currentScore, int &$bestScore, int &$bestSlot, int $scoreToCompare, int $slot): void
  {
    if ($scoreToCompare > $bestScore && $scoreToCompare > $currentScore) {
      $bestScore = $scoreToCompare;
      $bestSlot = $slot;
    }
  }

  public function selectAndEquipBestItems(): void
  {
    if ($this->botPlayer === null) {
      return;
    }

    $mainHand = $this->botPlayer->getMainHandInventory();
    $armorInventory = $this->botPlayer->getArmorInventory();

    $currentHelmet = $armorInventory->getHelmet();
    $currentHelmetScore = ArmorHelper::getArmorScore($currentHelmet);
    $bestHelmetScore = $currentHelmetScore;
    $bestHelmetInInventorySlot = -1;

    $currentChest = $armorInventory->getChestplate();
    $currentChestScore = ArmorHelper::getArmorScore($currentChest);
    $bestChestScore = $currentChestScore;
    $bestChestInInventorySlot = -1;

    $currentLeggings = $armorInventory->getLeggings();
    $currentLeggingsScore = ArmorHelper::getArmorScore($currentLeggings);
    $bestLeggingsScore = $currentLeggingsScore;
    $bestLeggingsInInventorySlot = -1;

    $currentBoots = $armorInventory->getBoots();
    $currentBootsScore = ArmorHelper::getArmorScore($currentBoots);
    $bestBootScore = $currentBootsScore;
    $bestBootInInventorySlot = -1;

    // Choose the best weapon to hold, during this pass we will also check the armor in our inventory and cache each best piece
    $bestWeapon = VanillaItems::AIR();
    $bestDamage = 0;
    $bestSlot = -1;
    foreach ($mainHand->getContents() as $slot => $item) {
      // Durable will either be an armor or tool item.
      if ($item instanceof Durable) {
        // armor check first
        if ($item instanceof Armor) {
          $type = ArmorHelper::getArmorType($item);
          $score = $item->getDefensePoints();
          // Set best pieces in inventory
          switch ($type) {
            case ArmorType::Helmet:
              $this->compareAndUpdatePiecesByRef
              (
                $currentHelmetScore,
                $bestHelmetScore,
                $bestHelmetInInventorySlot,
                $score,
                $slot
              );
              break;
            case ArmorType::Chest:
              $this->compareAndUpdatePiecesByRef(
                $currentChestScore,
                $bestChestScore,
                $bestChestInInventorySlot,
                $score,
                $slot
              );
              break;
            case ArmorType::Legs:
              $this->compareAndUpdatePiecesByRef(
                $currentLeggingsScore,
                $bestLeggingsScore,
                $bestLeggingsInInventorySlot,
                $score,
                $slot
              );
              break;
            case ArmorType::Boots:
              $this->compareAndUpdatePiecesByRef(
                $currentBootsScore,
                $bestBootScore,
                $bestBootInInventorySlot,
                $score,
                $slot
              );
              break;
            case ArmorType::NotArmor:
              break;
          }

          continue; // continue to avoid considering armor as a holdable item
        }

        // weapon check
        $damage = $item->getDamage();
        if ($damage > $bestDamage) {
          $bestSlot = $slot;
          $bestWeapon = $item;
          $bestDamage = $damage;
        }
      }
    }

    // Choose the best armor to equip
    // Helper closure to swap an inventory slot item into an armor slot, returning the old armor to that slot.
    $equipFromInventory = function (int $invSlot, callable $getCurrent, callable $setCurrent) use ($mainHand): void {
      // Get the item we're going to equip from the main-hand inventory (general inventory)
      $newItem = $mainHand->getItem($invSlot);
      // Read currently equipped armor piece
      /** @var Item $oldItem */
      $oldItem = $getCurrent();
      // Put new piece on
      $setCurrent($newItem);
      // Put the old piece back into the same inventory slot (AIR is fine)
      $mainHand->setItem($invSlot, $oldItem);
    };

    // Helmet
    if ($bestHelmetInInventorySlot !== -1) {
      $equipFromInventory(
        $bestHelmetInInventorySlot,
        fn() => $armorInventory->getHelmet(),
        fn(Item $i) => $armorInventory->setHelmet($i)
      );
    }

    // Chest plate
    if ($bestChestInInventorySlot !== -1) {
      $equipFromInventory(
        $bestChestInInventorySlot,
        fn() => $armorInventory->getChestplate(),
        fn(Item $i) => $armorInventory->setChestplate($i)
      );
    }

    // Leggings
    if ($bestLeggingsInInventorySlot !== -1) {
      $equipFromInventory(
        $bestLeggingsInInventorySlot,
        fn() => $armorInventory->getLeggings(),
        fn(Item $i) => $armorInventory->setLeggings($i)
      );
    }

    // Boots
    if ($bestBootInInventorySlot !== -1) {
      $equipFromInventory(
        $bestBootInInventorySlot,
        fn() => $armorInventory->getBoots(),
        fn(Item $i) => $armorInventory->setBoots($i)
      );
    }

    // We need to set the best item into slot 0 (held slot)
    if ($bestWeapon->getTypeId() != VanillaItems::AIR()->getTypeId() && $bestSlot != -1) {
      $this->bestItemForAttacking = $bestWeapon;
      $mainHand->swap(0, $bestSlot);
      $this->botPlayer->syncMainHandInventory($this->scene->getPlayers());
    }
  }

  public function init(): void
  {
    $this->bestItemForAttacking = VanillaItems::AIR();
    $this->selectAndEquipBestItems();
  }

  public function eventMessage(string $message, ...$args): void
  {
    if ($message === "inventory") {
      $this->selectAndEquipBestItems();
    }
  }

  public function updateSecond(): void
  {
    // TODO: Implement updateSecond() method.
  }

  public function updateTick(): void
  {
    // TODO: Implement updateTick() method.
  }

  public function exit(): void
  {
    // TODO: Implement exit() method.
  }

}