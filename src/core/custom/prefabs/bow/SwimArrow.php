<?php

namespace core\custom\prefabs\bow;

use core\scenes\duel\Scrim;
use core\systems\player\SwimPlayer;
use core\utils\ServerSounds;
use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Arrow;
use pocketmine\math\RayTraceResult;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class SwimArrow extends Arrow
{

  public Location $firedLocation;

  public function initEntity(CompoundTag $nbt): void
  {
    parent::initEntity($nbt);
    $this->setCanSaveWithChunk(false); // hopefully fixes things
  }

  public function getResultDamage(): int
  {
    return floor($this->damage);
  }

  public function onHitBlock(Block $blockHit, RayTraceResult $hitResult): void
  {
    parent::onHitBlock($blockHit, $hitResult);
    // remove, does not stick to blocks
    $this->kill();
    $this->flagForDespawn();
  }

  protected function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void
  {
    $owner = $this->getOwningEntity();
    if (!$owner instanceof SwimPlayer) {
      parent::onHitEntity($entityHit, $hitResult);
      return;
    }

    // distance check if in a scrim
    if ($owner->getSceneHelper()?->getScene() instanceof Scrim) {
      $distance = $entityHit->getPosition()->distance($this->firedLocation);
      // not sure if 5 is a good distance or not
      if ($distance < 5) {
        if ($entityHit instanceof Player) {
          $owner->sendMessage(TextFormat::DARK_AQUA . "Close range arrows deal less damage..");
          ServerSounds::playSoundToPlayer($owner, "item.shield.block", 2, 1);
          ServerSounds::playSoundToPlayer($entityHit, "item.shield.block", 2, 1);
          $this->damage = 0; // will cancel any combat related events
          $this->kill();
          $this->flagForDespawn();
          return;
        }
      }
    }

    parent::onHitEntity($entityHit, $hitResult);
  }

}