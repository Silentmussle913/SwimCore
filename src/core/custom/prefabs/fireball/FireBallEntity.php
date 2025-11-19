<?php

namespace core\custom\prefabs\fireball;

use core\SwimCore;
use core\systems\entity\entities\DeltaSupportTrait;
use pocketmine\block\Block;
use pocketmine\entity\Entity;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\RayTraceResult;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\entity\projectile\Throwable;
use pocketmine\world\particle\HugeExplodeParticle;
use pocketmine\world\sound\ExplodeSound;
use function ceil;
use function floor;

class FireBallEntity extends Throwable
{

  use DeltaSupportTrait;

  private int $lifeTime = 10 * 20; // 10 seconds converted to ticks
  private int $aliveTicks = 0;

  protected function getInitialDragMultiplier(): float
  {
    return 0;
  }

  protected function getInitialGravity(): float
  {
    return 0;
  }

  public static function getNetworkTypeId(): string
  {
    return EntityIds::FIREBALL;
  }

  public function entityBaseTick(int $tickDiff = 1): bool
  {
    $this->aliveTicks += $tickDiff;
    if ($this->aliveTicks >= $this->lifeTime) {
      $this->kill();
      $this->flagForDespawn();
      if (SwimCore::$DEBUG) {
        echo("Despawning fireball entity with ID $this->id\n");
      }
    }

    return parent::entityBaseTick($tickDiff);
  }

  protected function onHitBlock(Block $blockHit, RayTraceResult $hitResult): void
  {
    $this->flagForDespawn();
    $this->doExplosion($hitResult);
  }

  private function doExplosion(RayTraceResult $hitResult): void
  {
    $pos = $hitResult->getHitVector();

    $size = 5;
    $minX = (int)floor($pos->x - $size - 1);
    $maxX = (int)ceil($pos->x + $size + 1);
    $minY = (int)floor($pos->y - $size - 1);
    $maxY = (int)ceil($pos->y + $size + 1);
    $minZ = (int)floor($pos->z - $size - 1);
    $maxZ = (int)ceil($pos->z + $size + 1);

    $bb = new AxisAlignedBB($minX, $minY, $minZ, $maxX, $maxY, $maxZ);

    $list = $this->getWorld()->getNearbyEntities($bb, $this);

    $this->getWorld()->addParticle($pos, new HugeExplodeParticle());
    $this->getWorld()->addSound($pos, new ExplodeSound());

    foreach ($list as $entity) {
      $entityPos = $entity->getPosition();
      $distance = $entityPos->distance($pos);
      $motion = $entityPos->subtractVector($pos)->normalize();

      $impact = ($size - $distance) * 0.5;

      if ($impact < 0) continue;

      $motion->y += 0.4;

      $motionVec = $motion->multiply($impact);

      $motionVec->y /= 3;
      $motionVec->y += 0.4;

      $entity->setMotion($entity->getMotion()->addVector($motionVec));
    }
  }

  protected function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void
  {
    $this->doExplosion($hitResult);
    parent::onHitEntity($entityHit, $hitResult);
  }

}