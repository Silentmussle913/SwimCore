<?php

namespace core\custom\prefabs\fireball;

use core\systems\player\SwimPlayer;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Throwable;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\item\ProjectileItem;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class FireBallItem extends ProjectileItem
{

  public function __construct
  (
    ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FIRE_CHARGE),
    string         $name = TextFormat::MINECOIN_GOLD . TextFormat::BOLD . "Fire Ball",
    array          $enchantmentTags = []
  )
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . $name);
  }

  public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
  {
    if ($player instanceof SwimPlayer) {

      // if on cool down then don't do throwing tnt logic
      $cd = $player->getCoolDowns();
      if ($cd?->onCoolDown($this)) {
        return ItemUseResult::FAIL;
      }

      // then add a cool down to it
      $cd->setCoolDown($this, 1, false);
      $cd->setFocused($this);

      return parent::onClickAir($player, $directionVector, $returnedItems);
    }

    return ItemUseResult::FAIL;
  }

  protected function createEntity(Location $location, Player $thrower): Throwable
  {
    return new FireBallEntity($location, $thrower);
  }

  public function getThrowForce(): float
  {
    return 1;
  }

  public function getCooldownTicks(): int
  {
    return 10;
  }

}