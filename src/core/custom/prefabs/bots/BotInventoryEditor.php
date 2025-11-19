<?php

namespace core\custom\prefabs\bots;

use core\SwimCore;
use core\systems\entity\Behavior;
use core\systems\player\SwimPlayer;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use muqsit\invmenu\type\InvMenuTypeIds;
use pocketmine\block\VanillaBlocks;
use pocketmine\inventory\Inventory;
use pocketmine\item\Armor;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class BotInventoryEditor extends Behavior
{

  private InvMenu $menu;

  private ?BotPlayer $botPlayer = null;

  private bool $editing = false;
  private bool $editingAllowed = false;

  public function setBotPlayer(BotPlayer $botPlayer): void
  {
    $this->botPlayer = $botPlayer;
  }

  public function allowEditing(bool $value): void
  {
    $this->editing = $value;
  }

  public function init(): void
  {
    // double chest since we need a lot of space for hot bar and armor slot simulation
    $this->menu = InvMenu::create(InvMenuTypeIds::TYPE_DOUBLE_CHEST);

    $name = strstr($this->parent->getName(), "\n", true) ?: $this->parent->getName();
    $this->menu->setName($name);

    $this->itemEditHandler();
    $this->onCloseHandler();
  }

  private function itemEditHandler(): void
  {
    // Make it so the slots we can't touch are discarded transactions
    $barrierID = VanillaBlocks::BARRIER()->asItem()->getTypeId();
    $airID = VanillaBlocks::AIR()->asItem()->getTypeId();
    $this->menu->setListener(function (InvMenuTransaction $transaction) use ($barrierID, $airID): InvMenuTransactionResult {
      $item = $transaction->getItemClicked();
      if ($item->getTypeId() == $barrierID) {
        return $transaction->discard(); // don't edit barriers
      }

      // Handling of placing armor in the designated last 4 slots of the chest inventory which map to the bot player's 4 armor inventory slots.
      $chestInv = $this->menu->getInventory();
      $slot = $transaction->getAction()->getSlot();
      if ($slot > $this->botPlayer->getMainHandInventory()->getSize()) {
        // We only want to be able to place armor in this designated area
        $clickedWith = $transaction->getItemClickedWith();

        // We can take stuff
        if ($clickedWith->getTypeId() == $airID) {
          return $transaction->continue();
        }

        $isArmor = $clickedWith instanceof Armor;
        if (!$isArmor) {
          return $transaction->discard();
        }

        $type = ArmorHelper::getArmorType($clickedWith);
        $maxChestSize = $chestInv->getSize();

        // Can place boots here check
        if ($slot == $maxChestSize - 1 && $type == ArmorType::Boots) {
          return $transaction->continue();
        }

        // Can place leggings here check
        if ($slot == $maxChestSize - 2 && $type == ArmorType::Legs) {
          return $transaction->continue();
        }

        // Can place chest plate here check
        if ($slot == $maxChestSize - 3 && $type == ArmorType::Chest) {
          return $transaction->continue();
        }

        // Can place helmet here check
        if ($slot == $maxChestSize - 4 && $type == ArmorType::Helmet) {
          return $transaction->continue();
        }

        // Otherwise can't place that here
        return $transaction->discard();
      }

      // Otherwise we can place stuff here
      return $transaction->continue();
    });
  }

  private function onCloseHandler(): void
  {
    $barrierID = VanillaBlocks::BARRIER()->asItem()->getTypeId();
    // On closing, we set the items in the bots inventory to be in sync with the edits we just made in the inv menu chest
    $this->menu->setInventoryCloseListener(function (Player $player, Inventory $inventory) use ($barrierID): void {
      if ($this->botPlayer !== null) {
        $botInv = $this->botPlayer->getMainHandInventory();
        $botArmorInv = $this->botPlayer->getArmorInventory();
        $botArmorInv->clearAll();
        $botInv->clearAll();
        $chestInv = $this->menu->getInventory();
        $maxChestSize = $chestInv->getSize();
        foreach ($chestInv->getContents() as $slot => $item) {
          // We do this because the barrier blocks are overflow and in slots that don't exist
          if ($botInv->slotExists($slot)) {
            $botInv->setItem($slot, $item);
          } else if ($item->getTypeID() != $barrierID) { // special handling for what could be in the designated armor slots
            $type = ArmorHelper::getArmorType($item);
            if ($type == ArmorType::Boots && $slot == $maxChestSize - 1) {
              $botArmorInv->setBoots($item);
            } else if ($type == ArmorType::Legs && $slot == $maxChestSize - 2) {
              $botArmorInv->setLeggings($item);
            } else if ($type == ArmorType::Chest && $slot == $maxChestSize - 3) {
              $botArmorInv->setChestplate($item);
            } else if ($type == ArmorType::Helmet && $slot == $maxChestSize - 4) {
              $botArmorInv->setHelmet($item);
            }
          }
        }
        // Flag we changed our items in our inventory other components that might care
        // $this->parent->getEntityBehaviorManager()->eventMessage("inventory");
      }
      // Back to editable for other players
      $this->editing = false;
    });
  }

  public function eventMessage(string $message, ...$args): void
  {
    if ($message === "open") {
      if ($this->botPlayer === null) {
        return;
      }

      $player = $args[0] ?? null;
      if (!($player instanceof SwimPlayer)) {
        echo("Player not found!\n");
        return;
      }

      if (!$this->editing && $this->editingAllowed) {
        $this->editing = true;
      } else if (SwimCore::$DEBUG) {
        // We can edit if we are in debug mode, hence this nop to avoid the other case.
        echo("Editing force allowed via debug moe\n");
        $this->editing = true;
      } else if ($this->editing && $this->editingAllowed) {
        // Try to tell player they can't edit this thing if another player is editing (if arg was supplied).
        $player->sendMessage(TextFormat::YELLOW . "This bot's inventory is currently being edited already!");
        return;
      }

      // On opening, clear the inv menu and sync it back up with what is in the bots inventory.
      $chestInv = $this->menu->getInventory();
      $chestInv->clearAll();

      $playerInv = $this->botPlayer->getMainHandInventory();

      foreach ($playerInv->getContents() as $slot => $item) {
        $chestInv->setItem($slot, $item);
      }

      // Make it so the slots outside the inventory bounds size of the regular
      // player bot inventory are barrier blocks for the inv display inventory we will edit.
      $maxSize = $playerInv->getSize();
      $barrier = VanillaBlocks::BARRIER()->asItem()->setCustomName(" ");
      // We include empty so we can get the overfill slots and mark them with the barriers to not be editable.
      foreach ($chestInv->getContents(true) as $slot => $item) {
        if ($slot > $maxSize) {
          $chestInv->setItem($slot, $barrier);
        }
      }

      // Designated special 4 slot area for setting armor
      $armorInv = $this->botPlayer->getarmorInventory();
      $maxChestSize = $chestInv->getSize();
      $chestInv->setItem($maxChestSize - 1, $armorInv->getBoots());
      $chestInv->setItem($maxChestSize - 2, $armorInv->getLeggings());
      $chestInv->setItem($maxChestSize - 3, $armorInv->getChestplate());
      $chestInv->setItem($maxChestSize - 4, $armorInv->getHelmet());

      $this->menu->send($player);
    }
  }

  public function updateSecond(): void
  {
    // nop
  }

  public function updateTick(): void
  {
    // nop
  }

  public function exit(): void
  {
    // nop
  }

}