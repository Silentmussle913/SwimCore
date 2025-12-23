<?php

namespace core\custom\prefabs\boombox;

use core\scenes\PvP;
use core\systems\entity\entities\DeltaSupportTrait;
use core\systems\player\SwimPlayer;
use pocketmine\entity\Attribute;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\object\PrimedTNT;
use pocketmine\event\entity\EntityPreExplodeEvent;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\AddActorPacket;
use pocketmine\network\mcpe\protocol\types\entity\Attribute as NetworkAttribute;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;
use pocketmine\network\mcpe\protocol\types\entity\PropertySyncData;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;
use function array_map;

class SmoothPrimedTNT extends PrimedTNT
{

  use DeltaSupportTrait;

  private int $maxFuse;

  public static function getNetworkTypeId(): string
  {
    return EntityIds::TNT_MINECART;
  }

  private bool $breaksBlocks;
  private float $blastRadius;
  protected SwimPlayer $owner;

  public function __construct
  (
    SwimPlayer   $owner,
    Location     $location,
    bool         $breakBlocks = false,
    float        $blastRadius = 3.5,
    ?CompoundTag $nbt = null
  )
  {
    parent::__construct($location, $nbt);
    $this->owner = $owner;
    $this->setOwningEntity($owner);
    $this->blastRadius = $blastRadius;
    $this->breaksBlocks = $breakBlocks;
    $this->setNameTagAlwaysVisible();
  }

  protected function getInitialSizeInfo(): EntitySizeInfo
  {
    return new EntitySizeInfo(0.8, 0.8, 0.5);
  }

  protected function sendSpawnPacket(Player $player): void
  {
    $player->getNetworkSession()->sendDataPacket(AddActorPacket::create(
      $this->getId(),
      $this->getId(),
      static::getNetworkTypeId(),
      $this->getOffsetPosition($this->location),
      $this->getMotion(),
      $this->location->pitch,
      $this->location->yaw,
      $this->location->yaw,
      $this->location->yaw,
      array_map(function (Attribute $attr): NetworkAttribute {
        return new NetworkAttribute($attr->getId(), $attr->getMinValue(), $attr->getMaxValue(), $attr->getValue(), $attr->getDefaultValue(), []);
      }, $this->attributeMap->getAll()),
      $this->getAllNetworkData(),
      new PropertySyncData([], []),
      []
    ));
  }

  public function explode(): void
  {
    $radius = 3.5;
    $scene = $this->owner->getSceneHelper()?->getScene() ?? null;
    if ($scene instanceof PvP) {
      $radius = $scene->tntRadius;
    }

    $ev = new EntityPreExplodeEvent($this, $radius);
    $ev->setBlockBreaking($this->breaksBlocks);
    $ev->call();

    if (!$ev->isCancelled()) {
      $explosion = new CustomExplosion
      (
        Position::fromObject($this->location->add(0, $this->size->getHeight() / 2, 0), $this->getWorld()),
        $ev->getRadius(),
        $this
      );

      if ($ev->isBlockBreaking()) {
        $explosion->explodeA();
      }

      $explosion->explodeB();
    }
  }

  public function getOffsetPosition(Vector3 $vector3): Vector3
  {
    return $vector3->add(0, 1.25, 0);
  }

  protected function syncNetworkData(EntityMetadataCollection $properties): void
  {
    parent::syncNetworkData($properties);
    $properties->setFloat(EntityMetadataProperties::SCALE, 0.001);
  }

  public function setFuse(int $fuse): void
  {
    $this->maxFuse = $fuse;
    parent::setFuse($fuse);
  }

  public function onUpdate(int $currentTick): bool
  {
    $text = TextFormat::RED;
    $this->setNameTag($text . round($this->getFuse() / 20, 1));
    return parent::onUpdate($currentTick);
  }

}