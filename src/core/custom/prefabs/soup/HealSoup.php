<?php

namespace core\custom\prefabs\soup;

use core\utils\ServerSounds;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\item\BeetrootSoup;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class HealSoup extends BeetrootSoup
{

  public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::BEETROOT_SOUP), string $name = "Unknown", array $enchantmentTags = [])
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . TextFormat::DARK_RED . "Heal Soup");
  }

  public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
  {
    if ($player->getHealth() < $player->getMaxHealth()) {
      $player->heal(new EntityRegainHealthEvent($player, 8, EntityRegainHealthEvent::CAUSE_CUSTOM));
      $player->getInventory()->setItemInHand(VanillaItems::AIR());
      ServerSounds::playSoundToPlayer($player, "random.eat", 1, 1);
    }
    return ItemUseResult::SUCCESS;
  }

}