<?php

namespace core\custom\prefabs\fireball;

use pocketmine\block\Block;
use pocketmine\item\FireCharge;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

// a non-functioning version of the fire charge to work as a prop item to move around in the inventory inside the kit editor
class DummyCharge extends FireCharge
{

  public function __construct
  (
    ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FIRE_CHARGE),
    string         $name = TextFormat::MINECOIN_GOLD . "Fire Ball",
    array          $enchantmentTags = []
  )
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . $name);
  }

  public function onInteractBlock(Player $player, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, array &$returnedItems): ItemUseResult
  {
    return ItemUseResult::NONE;
  }

}