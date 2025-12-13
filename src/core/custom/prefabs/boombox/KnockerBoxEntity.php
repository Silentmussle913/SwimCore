<?php

namespace core\custom\prefabs\boombox;

use core\systems\player\SwimPlayer;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\object\PrimedTNT;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;

class KnockerBoxEntity extends PrimedTNT
{

  private SwimPlayer $target;

  public function __construct(Location $location, SwimPlayer $target)
  {
    $this->target = $target;
    parent::__construct($location);
    $this->setNameTagAlwaysVisible();
  }

  protected function getInitialSizeInfo(): EntitySizeInfo
  {
    return new EntitySizeInfo(0.8, 0.8);
  }

  public function explode(): void
  {
    $explosion = new KnockerBoxExplosion
    (
      Position::fromObject($this->location->add(0, $this->size->getHeight() / 2, 0), $this->getWorld()), $this->target
    );
    $explosion->explodeB();
  }

  public function onUpdate(int $currentTick): bool
  {
    $text = TextFormat::LIGHT_PURPLE;
    $this->setNameTag($text . round($this->getFuse() / 20, 1));
    return parent::onUpdate($currentTick);
  }

}