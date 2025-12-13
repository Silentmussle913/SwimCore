<?php

namespace core\custom\prefabs\rod;

use core\SwimCore;
use core\systems\entity\entities\DeltaSupportTrait;
use core\utils\raklib\SwimTypeConverter;
use core\utils\TimeHelper;
use pocketmine\entity\Entity;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\projectile\Projectile;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\item\ItemTypeIds;
use pocketmine\math\RayTraceResult;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\RemoveActorPacket;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\Player;
use pocketmine\utils\Random;

class FishingHook extends Projectile
{

  use DeltaSupportTrait;

  public static function getNetworkTypeId(): string
  {
    return EntityIds::FISHING_HOOK;
  }

  protected function getInitialDragMultiplier(): float
  {
    return 0.01;
  }

  protected function getInitialGravity(): float
  {
    return 0.09;
  }

  protected function getInitialSizeInfo(): EntitySizeInfo
  {
    return new EntitySizeInfo(0.25, 0.25);
  }

  public function __construct(Location $location, ?Entity $shootingEntity, private readonly CustomFishingRod $item, ?CompoundTag $nbt = null)
  {
    $this->setCanSaveWithChunk(false);
    parent::__construct($location, $shootingEntity, $nbt);
  }

  public function onHitEntity(Entity $entityHit, RayTraceResult $hitResult): void
  {
    $damage = $this->getResultDamage();

    if ($this->getOwningEntity() !== null) {
      $event = new EntityDamageByChildEntityEvent($this->getOwningEntity(), $this, $entityHit, EntityDamageEvent::CAUSE_PROJECTILE, $damage);

      if (!$event->isCancelled()) {
        $entityHit->attack($event);
      }
    }

    $this->isCollided = true;
    $this->flagForDespawn();
  }

  public function onUpdate(int $currentTick): bool
  {
    if ($this->isClosed()) {
      return false;
    }

    // Let the parent do all the usual movement + base tick stuff
    $parentResult = parent::onUpdate($currentTick);

    // Our extra despawn logic (distance, lifetime, owner state, etc.)
    $this->updates();

    // If parent says "no more updates needed", but we haven't flagged for despawn,
    // force a "true" so the world keeps ticking this entity.
    // This is because projectiles (which we are deriving from) that stop moving are marked to stop updating.
    // But fishing hooks from rods can live on while laying on the ground once still cast, we hack fix the behavior here:
    if (!$parentResult && !$this->isFlaggedForDespawn() && $this->getOwningEntity() !== null) {
      return true;
    }

    return $parentResult;
  }


  private function updates(): bool
  {
    $player = $this->getOwningEntity();
    $hasUpdate = false;
    $despawn = false;

    // Checks for automatic despawn
    if ($player instanceof Player) {
      // not holding a fishing rod anymore
      if ($player->getInventory()->getItemInHand()->getTypeId() != ItemTypeIds::FISHING_ROD) {
        if (SwimCore::$DEBUG) {
          echo("FishingHook: despawn because player is not holding a fishing rod\n");
        }
        $despawn = true;
      }

      // player is dead
      if (!$despawn && !$player->isAlive()) {
        if (SwimCore::$DEBUG) {
          echo("FishingHook: despawn because player is not alive\n");
        }
        $despawn = true;
      }

      // player object closed
      if (!$despawn && $player->isClosed()) {
        if (SwimCore::$DEBUG) {
          echo("FishingHook: despawn because player is closed\n");
        }
        $despawn = true;
      }

      // different world
      if (
        !$despawn
        && $player->getLocation()->getWorld()->getId() != $this->getLocation()->getWorld()->getId()
      ) {
        if (SwimCore::$DEBUG) {
          echo("FishingHook: despawn because player is in a different world\n");
        }
        $despawn = true;
      }

      // too far away
      if (
        !$despawn
        && $player->getPosition()->distanceSquared($this->getPosition()) > 1600
      ) {
        if (SwimCore::$DEBUG) {
          echo("FishingHook: despawn because player is too far away\n");
        }
        $despawn = true;
      }

      // lived too long
      if (
        !$despawn
        && $this->ticksLived > TimeHelper::secondsToTicks(5)
      ) {
        if (SwimCore::$DEBUG) {
          echo("FishingHook: despawn because hook lived longer than 5 seconds\n");
        }
        $despawn = true;
      }
    } else {
      if (SwimCore::$DEBUG) {
        echo("FishingHook: despawn because owning entity is not a Player\n");
      }
      $despawn = true;
    }

    if ($despawn) {
      $this->flagForDespawn();
      $hasUpdate = true;
    }

    return $hasUpdate;
  }

  public function flagForDespawn(): void
  {
    $owningEntity = $this->getOwningEntity();

    if ($owningEntity instanceof Player) {
      $owningEntity->fishing = false;
      CustomFishingRod::clearCurrentHook($owningEntity, $this);
    }
    // $this->superKillMySelf(); // don't think we need to do this anymore

    parent::flagForDespawn();
  }

  // Tell the goddamn fishing hook entity to do a triple backflip off a 70-story skyscraper
  private function superKillMySelf(): void
  {
    $targets = $this->server->getOnlinePlayers();
    $entityId = $this->id;
    SwimTypeConverter::broadcastByTypeConverter($targets, function (TypeConverter $typeConverter) use ($entityId): array {
      return [
        RemoveActorPacket::create($entityId)
      ];
    });
  }

  public function handleHookCasting(Vector3 $vec): void
  {
    $x = $vec->getX();
    $y = $vec->getY();
    $z = $vec->getZ();

    $f2 = 1.0;
    $f1 = 1.5;

    $rand = new Random();
    $f = sqrt($x * $x + $y * $y + $z * $z);
    $x = $x / $f;
    $y = $y / $f;
    $z = $z / $f;
    $x = $x + $rand->nextSignedFloat() * 0.007499999832361937;
    $y = $y + $rand->nextSignedFloat() * 0.007499999832361937 * $f2;
    $z = $z + $rand->nextSignedFloat() * 0.007499999832361937 * $f2;
    $x = $x * 1.5;
    $y = $y * $f1;
    $z = $z * $f1;

    $this->motion->x += $x;
    $this->motion->y += $y;
    $this->motion->z += $z;
  }

}
