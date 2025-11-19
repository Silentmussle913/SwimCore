<?php

namespace core\custom\prefabs\props;

use core\custom\bases\ItemHolderActor;
use core\systems\scene\Scene;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use ReflectionException;

// Other than being a simple player dummy to move around, it also has held item capabilities
class MovieActor extends ItemHolderActor
{

  public static function getNetworkTypeId(): string
  {
    return EntityIds::PLAYER;
  }

  public function getInitialSizeInfo(): EntitySizeInfo
  {
    return new EntitySizeInfo(1.8, 0.6, 1.62);
  }

  /**
   * @throws ReflectionException
   */
  public function __construct
  (
    string       $name,
    Location     $location,
    ?Scene       $scene = null,
    ?CompoundTag $nbt = null,
    ?Skin        $skin = null
  )
  {
    // parent ctor
    parent::__construct($location, $scene, $nbt, $skin);

    // set values
    $this->setNameTag($name);
    $this->setHasGravity(false);
    $this->setMaxHealth(999);
    $this->setScale(1);
  }

  // override to force public, we don't use this anymore in MovieScene, we instead use teleport
  public function move(float $dx, float $dy, float $dz): void
  {
    parent::move($dx, $dy, $dz);
  }

}