<?php

namespace core\custom\prefabs\snowball;

use pocketmine\entity\Location;
use pocketmine\entity\projectile\Snowball;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ProjectileItem;
use pocketmine\player\Player;

class SnowBall_Item extends ProjectileItem
{

  public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::SNOWBALL), string $name = "Unknown", array $enchantmentTags = [])
  {
    parent::__construct($identifier, $name, $enchantmentTags);
  }

  public function getMaxStackSize(): int
  {
    return 16; // was 64 but that is fighting the client way too hard
  }

  protected function createEntity(Location $location, Player $thrower): Throwable
  {
    return new Snowball($location, $thrower);
  }

  public function getThrowForce(): float
  {
    return 1.5;
  }

  public function getCooldownTicks(): int
  {
    return 0;
  }

}