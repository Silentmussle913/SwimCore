<?php

namespace core\custom\prefabs\pearl;

use core\systems\player\SwimPlayer;
use pocketmine\entity\Entity;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\EnderPearl;
use pocketmine\event\entity\ProjectileHitEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\world\particle\EndermanTeleportParticle;
use pocketmine\world\sound\EndermanTeleportSound;

class SwimPearl extends EnderPearl
{

  private bool $animated;

  public function __construct(bool $animated, Location $location, ?Entity $shootingEntity, ?CompoundTag $nbt = null)
  {
    parent::__construct($location, $shootingEntity, $nbt);
    $this->animated = $animated;
  }

  public function onHit(ProjectileHitEvent $event): void
  {
    $owner = $this->getOwningEntity();
    if ($owner instanceof SwimPlayer) {
      // teleport particles and sound effects at original position
      $origin = $owner->getPosition();
      $this->getWorld()->addParticle($origin, new EndermanTeleportParticle());
      $this->getWorld()->addSound($origin, new EndermanTeleportSound());

      // position of where pearl hit
      $target = $event->getRayTraceResult()->getHitVector();

      // if animated or not
      if ($this->animated) {
        $owner->setPosition($target);
        $owner->getNetworkSession()->syncMovement($target);
        $owner->ticksSinceLastTeleport = 0;
        $data = $owner->getAntiCheatData();
        $data?->teleported();
      } else {
        $owner->teleport($target); // vanilla TP
      }

      // play teleport sound
      $this->getWorld()->addSound($target, new EndermanTeleportSound());
    }
  }

}