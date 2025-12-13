<?php

namespace core\scenes;

use core\custom\prefabs\rod\FishingHook;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\systems\scene\managers\DroppedItemManager;
use core\systems\scene\Scene;
use core\utils\ServerSounds;
use core\utils\StackTracer;
use pocketmine\entity\Entity;
use pocketmine\entity\object\ItemEntity;
use pocketmine\entity\projectile\Arrow as ArrowEntity;
use pocketmine\entity\projectile\EnderPearl as PearlEntity;
use pocketmine\entity\projectile\Snowball as SnowballEntity;
use pocketmine\event\entity\EntityDamageByChildEntityEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityItemPickupEvent;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\entity\EntitySpawnEvent;
use pocketmine\event\entity\ProjectileLaunchEvent;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;

// this is a middle man class for doing common pvp mechanics a duel or FFA scene might need

abstract class PvP extends Scene
{

  public bool $disableVelocityChecks = false;
  public float $vertKB = 0.4;
  public float $kb = 0.4;
  public float $controllerVertKB = 0.4;
  public float $controllerKB = 0.4;
  public int $hitCoolDown = 10; // in ticks
  public float $pearlKB = 0.6;
  public float $snowballKB = 0.5;
  public float $rodKB = 0.41;
  public float $arrowKB = 0.5;
  public float $pearlSpeed = 2.5;
  public float $pearlGravity = 0.1;

  // These 2 are more custom duel/playground specific
  public bool $reKitOnKill = true;
  public bool $healOnKill = true;

  public bool $naturalRegen = true;
  public bool $fallDamage = true;
  protected bool $voidDamage = false;

  public bool $tntBreaksBlocks = false;
  public float $blastKB = 1.5;
  public bool $canThrowTnt = true;
  public float $tntRadius = 3.5;
  public int $tntFuse = 40;
  public int $maxHearts = 10;

  protected DroppedItemManager $droppedItemManager;

  public function __construct(SwimCore $core, string $name)
  {
    parent::__construct($core, $name);

    $this->droppedItemManager = new DroppedItemManager();

    $this->vertKB = 0.4;
    $this->kb = 0.4;
    $this->controllerVertKB = 0.4;
    $this->controllerKB = 0.4;
    $this->hitCoolDown = 10;
    $this->pearlKB = 0.6;
    $this->snowballKB = 0.5;
    $this->rodKB = 0.41;
    $this->arrowKB = 0.5;
    $this->pearlSpeed = 2.5;
    $this->pearlGravity = 0.1;
    $this->naturalRegen = true;
    $this->fallDamage = false;
    $this->voidDamage = false; // most scenes will have custom bounding boxes set for playable region, anything outside no block placement or damage
  }

  public final function getDroppedItemManager(): DroppedItemManager
  {
    return $this->droppedItemManager;
  }

  private const GRAVITY_UNIT_PER_TICK = 0.346;

  public function sceneEntityDamageEvent(EntityDamageEvent $event, SwimPlayer $swimPlayer): void
  {
    if ($event->getCause() == EntityDamageEvent::CAUSE_FALL) {
      if (!$this->fallDamage) {
        $event->cancel();
      } else {
        // custom fall damage because pocket-mine's is not consistent with vanilla, it is a tick too strong
        $this->adjustFallDamage($event, $swimPlayer);
      }
    } else if (!$this->voidDamage && $event->getCause() == EntityDamageEvent::CAUSE_VOID) {
      $event->cancel();
    }

    // now handle if that damage killed them (also do generic damage call back)
    if (!$event->isCancelled()) {
      $this->playerTakesMiscDamage($event, $swimPlayer);
      if ($event->getFinalDamage() >= $swimPlayer->getHealth() && !$event->isCancelled()) { // event can be cancelled by player takes misc damage
        $event->cancel();
        // gameplay scripting callback
        $this->playerDiedToMiscDamage($event, $swimPlayer);
      }
    }
  }

  // callback for when taking generic damage that isn't from an attack
  protected function playerTakesMiscDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void
  {
  }

  // you really should override this method
  protected function playerDiedToMiscDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void
  {
    echo("WARNING | " . $this->sceneName . " DID NOT HANDLE NATURAL CAUSE DEATH OF PLAYER " . $swimPlayer->getName() . "\n");
  }

  private function adjustFallDamage(EntityDamageEvent $event, SwimPlayer $swimPlayer): void
  {
    // Adjust the fall distance to match the vanilla behavior
    $adjustedFallDistance = $swimPlayer->getFallDistance() - self::GRAVITY_UNIT_PER_TICK;
    if ($adjustedFallDistance <= 0) {
      // If the adjusted fall distance is not enough to cause damage, cancel the event
      $event->cancel();
    } else {
      // Recalculate fall damage based on the adjusted fall distance
      $damage = $swimPlayer->calculateFallDamage($adjustedFallDistance);
      if ($damage > 0) {
        $event->setBaseDamage($damage);
      } else {
        $event->cancel();
      }
    }
  }

  // projectile launch handling
  public function sceneProjectileLaunchEvent(ProjectileLaunchEvent $event, SwimPlayer $swimPlayer): void
  {
    $player = $event->getEntity()->getOwningEntity();
    if ($player::getNetworkTypeId() == EntityIds::PLAYER) {
      $projectile = $event->getEntity();
      if ($projectile::getNetworkTypeId() == EntityIds::ENDER_PEARL) {
        $projectile->setScale(0.5);
        $projectile->setMotion($projectile->getDirectionVector()->multiply($this->pearlSpeed));
        $projectile->setGravity($this->pearlGravity);
      }
    }
  }

  private static array $kbMap = [
    EntityIds::ENDER_PEARL => 0.4,
    EntityIds::ARROW => 0.3,
    EntityIds::SNOWBALL => 0.25,
    EntityIds::FISHING_HOOK => 0.5,
  ];

  // projectile hit handling
  public function sceneEntityDamageByChildEntityEvent(EntityDamageByChildEntityEvent $event, SwimPlayer $swimPlayer): void
  {
    $player = $event->getEntity();
    if ($player instanceof SwimPlayer) {
      $attacker = $event->getChild()->getOwningEntity();
      if ($attacker instanceof SwimPlayer) {

        // we don't want team damage from children entities
        if ($this->arePlayersInSameTeam($attacker, $player)) {
          $event->cancel();
          return;
        }

        $child = $event->getChild();
        if ($child instanceof PearlEntity) {
          $event->setKnockBack($this->pearlKB);
        } else if ($child instanceof ArrowEntity) {
          $event->setKnockBack($this->arrowKB);
        } else if ($child instanceof SnowballEntity) {
          $event->setKnockBack($this->snowballKB);
        } else if ($child instanceof FishingHook) {
          $event->setKnockBack($this->rodKB);
        }

        // this allows projectile combo stacking by turning cool down to 0 tick
        $event->setAttackCooldown(0);

        // scripted event callback derived scenes can override
        $this->hitByProjectile($swimPlayer, $attacker, $child, $event);
        // death check
        if ($event->getFinalDamage() >= $swimPlayer->getHealth()) {
          $event->cancel();
          // scripting event callback
          $this->playerDiedToChildEntity($event, $swimPlayer, $attacker, $child);
        }
      }
    }
  }

  // you should really override this
  protected function playerDiedToChildEntity(EntityDamageByChildEntityEvent $event, SwimPlayer $victim, SwimPlayer $attacker, Entity $childEntity): void
  {
    echo("WARNING | " . $this->sceneName . " DID NOT HANDLE CHILD ENTITY KILL ON PLAYER " . $victim->getName() . "\n");
    if (SwimCore::$DEBUG) StackTracer::PrintStackTrace();
  }

  // optional override
  protected function hitByProjectile(SwimPlayer $hitPlayer, SwimPlayer $hitter, Entity $projectile, EntityDamageByChildEntityEvent $event): void
  {
    $id = $projectile::getNetworkTypeId();
    if ($id == EntityIds::ARROW) {
      $this->arrowDamageMessage($hitter, $hitPlayer, $event);
    } elseif ($id == EntityIds::SNOWBALL || $id == EntityIds::EGG) {
      ServerSounds::playSoundToPlayer($hitter, 'note.bell', 2, 1);
    }

    // handle the attack for combat logging
    $hitter->getCombatLogger()?->handleAttack($hitPlayer);
  }

  protected function arrowDamageMessage(SwimPlayer $hitter, SwimPlayer $hitPlayer, EntityDamageByChildEntityEvent $event, bool $doSound = true): void
  {
    $hp = $hitPlayer->getHearts($event->getFinalDamage());
    if ($hp > 0) {
      $hitter->sendMessage(TextFormat::GREEN . $hitPlayer->getNicks()->getNick() . " has $hp Hearts");
    }
    if ($doSound) {
      ServerSounds::playSoundToPlayer($hitter, 'note.bell', 2, 1);
    }
  }

  protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void
  {
    // optional override
  }

  protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void
  {
    // optional override
  }

  // can set natural regen to be cancelled
  public function sceneEntityRegainHealthEvent(EntityRegainHealthEvent $event, SwimPlayer $swimPlayer): void
  {
    if (!$this->naturalRegen && $event->getRegainReason() == EntityRegainHealthEvent::CAUSE_SATURATION) $event->cancel();
  }

  public function scenePlayerSpawnChildEvent(EntitySpawnEvent $event, SwimPlayer $swimPlayer, Entity $spawnedEntity): void
  {
    if ($spawnedEntity::getNetworkTypeId() == EntityIds::ITEM) {
      /** @var $spawnedEntity ItemEntity */
      $this->droppedItemManager->addDroppedItem($spawnedEntity);
    }
  }

  public function scenePlayerPickupItem(EntityItemPickupEvent $event, SwimPlayer $swimPlayer): void
  {
    $origin = $event->getOrigin();
    if ($origin::getNetworkTypeId() == EntityIds::ITEM) {
      /** @var $origin ItemEntity */
      $this->droppedItemManager->removeDroppedItem($origin);
    }
  }

  protected function stayCloseSpec(SwimPlayer $player, Vector3 $mapCenter, float $distance = 50): void
  {
    if ($player->getGamemode() == GameMode::SPECTATOR) {
      if ($player->getPosition()->distance($mapCenter) >= $distance) {
        $player->teleport($mapCenter);
        if (SwimCore::$DEBUG) {
          echo("PvP::stayCloseSpec({$player->getName()}) called\n");
        }
      }
    }
  }

  public function exit(): void
  {
    parent::exit();
    $this->droppedItemManager->despawnAll();
  }

}