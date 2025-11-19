<?php

namespace core\custom\prefabs\bots;

use core\systems\entity\Behavior;
use pocketmine\math\Vector2;
use pocketmine\math\Vector3;
use pocketmine\block\Flowable;
use pocketmine\block\BlockTypeIds;
use ReflectionException;

class SimpleMover extends Behavior
{
  private ?Vector3 $targetPosition = null;
  private float $targetPitch = 0.0;
  private float $targetYaw = 0.0;

  private float $lookSpeedYaw = 36.0;
  private float $lookSpeedPitch = 24.0;
  private bool $look = false;
  private bool $faceMovementWhenIdleLook = true;

  private const ARRIVAL_EPSILON = 0.3; // how close we need to be considered at our goal
  private const EDGE_AVOID_YAW_MIN = 100.0; // degrees
  private const EDGE_AVOID_YAW_MAX = 250.0; // degrees
  private const ABOUT_TO_FALL_MAX_DROP = 3.0; // blocks

  private const GROUND_ACCEL = 1.0; // accelerate fully on ground toward target speed
  private const AIR_ACCEL = 0.08; // accelerate much slower in air
  private const WALK_SPEED_PER_TICK = 0.415;
  private const SPRINT_SPEED_PER_TICK = 0.480;
  private const SPRINT_DISTANCE_ACTIVATE = 3.0;
  private const SPRINT_JUMP_DISTANCE_ACTIVATE = 10.0;
  private const JUMP_BOOST = 0.04; // makes jump a tiny bit higher and feel equal to a players jump height
  private const JUMP_COOL_DOWN_TICKS = 5;
  private int $jumpCoolDown = 0;

  /**
   * @throws ReflectionException
   */
  public function init(): void
  {
    // Injected into base entity tick in parent Actor
    $this->parent->setEntityBaseTickCallback($this->actorBaseEntityTickCallback(...));
  }

  public function setTargetPosition(Vector3 $position, ?float $pitch = null, ?float $yaw = null): void
  {
    $this->targetPosition = $position;
    if ($pitch !== null) {
      $this->targetPitch = $pitch;
      $this->look = true;
    }
    if ($yaw !== null) {
      $this->targetYaw = $yaw;
      $this->look = true;
    }
  }

  public function stop(): void
  {
    $this->targetPosition = null;
    $loc = $this->parent->getLocation();
    $this->targetPitch = $loc->getPitch();
    $this->targetYaw = $loc->getYaw();
    $this->look = false;

    $m = $this->parent->getMotion();
    // zero horizontal, keep vertical for gravity
    $this->parent->setMotion(new Vector3(0.0, $m->y, 0.0));

    if ($this->parent->isSprinting()) {
      $this->parent->setSprinting(false);
    }
  }

  /**
   * @param int $tickDiff
   * @return bool
   */
  public function actorBaseEntityTickCallback(int $tickDiff): bool
  {
    $loc = $this->parent->getLocation();
    $pos = new Vector3($loc->getX(), $loc->getY(), $loc->getZ());
    $motion = $this->parent->getMotion();

    $desiredYaw = $loc->getYaw();
    $desiredPitch = $loc->getPitch();

    // Local XZ lock epsilon to prevent micro-oscillation when aligned in XZ but offset in Y
    $xzLockEps = 0.20;

    if ($this->targetPosition !== null) {
      $to = $this->targetPosition->subtractVector($pos);
      $dx = $to->x;
      $dy = $to->y;
      $dz = $to->z;

      $horizontalDist = ($dx !== 0.0 || $dz !== 0.0) ? sqrt($dx * $dx + $dz * $dz) : 0.0;
      $dist3 = sqrt($dx * $dx + $dy * $dy + $dz * $dz);

      // Arrived?
      if ($dist3 <= self::ARRIVAL_EPSILON) {
        $this->stop();
      } else {
        // If we're essentially aligned in XZ, lock horizontal motion and only solve vertical
        if ($horizontalDist <= $xzLockEps) {
          // Stop sprinting if any
          if ($this->parent->isSprinting()) {
            $this->parent->setSprinting(false);
          }

          // Freeze horizontal motion, keep vertical for gravity/jumps
          $this->parent->setMotion(new Vector3(0.0, $motion->y, 0.0));

          // Keep yaw stable to avoid jitter; set pitch to face up/down toward target
          // (when horizontalDist is tiny, aim pitch nearly straight up/down)
          if (abs($dy) > 1.0e-4) {
            // -atan2 because MC pitch up is negative
            $desiredPitch = -rad2deg(atan2($dy, max($horizontalDist, 1.0e-6)));
            $desiredPitch = $this->clamp($desiredPitch, -90.0, 90.0);
          }

          // Skip movement logic below (no edge-avoid/jump/accel when XZ-locked)
        } else {
          // Sprint logic
          $farSprint = $horizontalDist > self::SPRINT_DISTANCE_ACTIVATE;
          if ($farSprint !== $this->parent->isSprinting()) {
            $this->parent->setSprinting($farSprint);
          }
          $targetXZSpeed = $this->parent->isSprinting() ? self::SPRINT_SPEED_PER_TICK : self::WALK_SPEED_PER_TICK;

          // Direction on XZ
          if ($horizontalDist > 1.0e-6) {
            $dirX = $dx / $horizontalDist;
            $dirZ = $dz / $horizontalDist;
          } else {
            $dirX = 0.0;
            $dirZ = 0.0;
          }

          // Edge avoid
          if ($this->isAboutToFall(self::ABOUT_TO_FALL_MAX_DROP)) {
            $turn = mt_rand((int)self::EDGE_AVOID_YAW_MIN, (int)self::EDGE_AVOID_YAW_MAX);
            $this->parent->setRotation($this->wrapDegrees($loc->getYaw() + $turn), $loc->getPitch());
            $this->parent->setMotion(new Vector3(0.0, $motion->y, 0.0));
            return $this->parent->isAlive();
          }

          // Jumping and step-up detection
          $vy = $motion->y;

          if ($this->jumpCoolDown < 0) {
            $needSlopeJump = ($dy > 0.6 && $dy <= 1.1);
            $forceSprintJump = ($horizontalDist > self::SPRINT_JUMP_DISTANCE_ACTIVATE); // sprint jump when far

            if ($this->parent->isOnGround() && ($forceSprintJump || $needSlopeJump || $this->needsStepUpOneBlock()) /*&& !$this->hasBlockAbove()*/ ) {
              $vy = $this->parent->getJumpVelocity() + self::JUMP_BOOST;
              $this->jumpCoolDown = self::JUMP_COOL_DOWN_TICKS;
            }
          }

          $this->jumpCoolDown--;

          // Target horizontal velocity
          $tx = $dirX * $targetXZSpeed;
          $tz = $dirZ * $targetXZSpeed;

          // Accelerate much slower in air
          $alpha = $this->parent->isOnGround() ? self::GROUND_ACCEL : self::AIR_ACCEL;
          $vx = $motion->x + ($tx - $motion->x) * $alpha;
          $vz = $motion->z + ($tz - $motion->z) * $alpha;

          $this->parent->setMotion(new Vector3($vx, $vy, $vz));

          // Auto-face movement if no explicit look target
          if (!$this->look && $this->faceMovementWhenIdleLook) {
            if ($horizontalDist > 1.0e-4) {
              $desiredYaw = rad2deg(atan2(-$dx, $dz));
            } // else keep yaw to avoid jitter when directly above/below
            if ($horizontalDist < 1.0e-4 && abs($dy) > 1.0e-4) {
              $desiredPitch = ($dy > 0.0) ? -90.0 : 90.0;
            } else {
              $desiredPitch = -rad2deg(atan2($dy, max(1.0e-6, $horizontalDist)));
            }
            $desiredPitch = $this->clamp($desiredPitch, -90.0, 90.0);
          }
        }
      }
    } else {
      // No target: stop horizontal motion, keep vertical (gravity)
      $this->parent->setMotion(new Vector3(0.0, $motion->y, 0.0));
      if ($this->parent->isSprinting()) {
        $this->parent->setSprinting(false);
      }
    }

    // Explicit look target overrides auto-face
    if ($this->look) {
      $desiredYaw = $this->targetYaw;
      $desiredPitch = $this->targetPitch;
    }

    // Smooth rotations
    [$newYaw, $yawDone] = $this->approachAngle($loc->getYaw(), $desiredYaw, $this->lookSpeedYaw);
    [$newPitch, $pitchDone] = $this->approachAngle($loc->getPitch(), $this->clamp($desiredPitch, -90.0, 90.0), $this->lookSpeedPitch);
    $this->parent->setRotation($newYaw, $newPitch);

    if ($this->look && $yawDone && $pitchDone) {
      $this->look = false;
    }

    return $this->parent->isAlive();
  }

  /** Step-up detection at foot/knee with clear headroom */
  private function needsStepUpOneBlock(): bool
  {
    $frontFoot = $this->hasObstacleInFrontAtHeight(0.2);
    $frontKnee = $this->hasObstacleInFrontAtHeight(0.6);

    if (!($frontFoot || $frontKnee)) {
      return false;
    }

    if ($this->hasCeilingAhead()) {
      return false;
    }

    return true;
  }

  /** Check small box in front at a given local height */
  private function hasObstacleInFrontAtHeight(float $h): bool
  {
    $dir = $this->getDirectionVector2($this->parent->getLocation()->getYaw());
    $offset = new Vector3($dir->x * max(0.6, $this->parent->getScale()), $h, $dir->y * max(0.6, $this->parent->getScale()));
    $bb = $this->parent->getBoundingBox()->offsetCopy($offset->x, $offset->y, $offset->z);
    $blocks = $this->parent->getWorld()->getCollisionBlocks($bb);

    foreach ($blocks as $b) {
      if ($b->getTypeId() !== BlockTypeIds::AIR && !$b instanceof Flowable) {
        return true;
      }
    }

    return false;
  }

  /** Ceiling two blocks above in front */
  private function hasCeilingAhead(): bool
  {
    $dir = $this->getDirectionVector2($this->parent->getLocation()->getYaw());
    $offset1 = new Vector3($dir->x * max(0.6, $this->parent->getScale()), 1.2, $dir->y * max(0.6, $this->parent->getScale()));
    $offset2 = new Vector3($dir->x * max(0.6, $this->parent->getScale()), 2.0, $dir->y * max(0.6, $this->parent->getScale()));

    $bb1 = $this->parent->getBoundingBox()->offsetCopy($offset1->x, $offset1->y, $offset1->z);
    $bb2 = $this->parent->getBoundingBox()->offsetCopy($offset2->x, $offset2->y, $offset2->z);

    $blocks1 = $this->parent->getWorld()->getCollisionBlocks($bb1);
    foreach ($blocks1 as $b) {
      if ($b->getTypeId() !== BlockTypeIds::AIR && !$b instanceof Flowable) {
        return true;
      }
    }

    $blocks2 = $this->parent->getWorld()->getCollisionBlocks($bb2);
    foreach ($blocks2 as $b) {
      if ($b->getTypeId() !== BlockTypeIds::AIR && !$b instanceof Flowable) {
        return true;
      }
    }

    return false;
  }

  private function hasBlockAbove(): bool
  {
    $bb = $this->parent->getBoundingBox()->offsetCopy(0, 1.2, 0);
    $blocks = $this->parent->getWorld()->getCollisionBlocks($bb);

    foreach ($blocks as $b) {
      if ($b->getTypeId() !== BlockTypeIds::AIR && !$b instanceof Flowable) {
        return true;
      }
    }

    return false;
  }

  /** Don’t run off cliffs / into holes. This seems to not work. */
  private function isAboutToFall(float $maxAllowedFallDist = 3.0): bool
  {
    if (!$this->parent->isOnGround()) {
      return false;
    }

    $dir = $this->getDirectionVector2($this->parent->getLocation()->getYaw());
    $offsetPos = $this->parent->getLocation()->add($dir->x, 0, $dir->y)->floor();
    $world = $this->parent->getWorld();

    for ($y = $offsetPos->y; $y >= $offsetPos->y - $maxAllowedFallDist; --$y) {
      $block = $world->getBlockAt($offsetPos->x, $y, $offsetPos->z);
      if (!empty($block->getCollisionBoxes())) {
        return false;
      }
    }

    return true;
  }

  /** Move current angle toward target by at most $step degrees, wrapping correctly. */
  private function approachAngle(float $current, float $target, float $step): array
  {
    $delta = $this->wrapDegrees($target - $current);
    $abs = abs($delta);

    if ($abs <= $step) {
      return [$this->wrapDegrees($target), true];
    }

    $next = $current + ($delta > 0 ? $step : -$step);
    return [$this->wrapDegrees($next), false];
  }

  private function wrapDegrees(float $deg): float
  {
    $deg = fmod($deg, 360.0);
    if ($deg <= -180.0) $deg += 360.0;
    if ($deg > 180.0) $deg -= 360.0;

    return $deg;
  }

  private function clamp(float $v, float $lo, float $hi): float
  {
    return ($v < $lo) ? $lo : (($v > $hi) ? $hi : $v);
  }

  /** Vector2 from yaw (deg) */
  private function getDirectionVector2(float $yawDeg): Vector2
  {
    $rad = deg2rad($yawDeg);
    // MC: yaw 0 = +Z; yaw +90 = -X; so (x,z) = (-sin, cos)
    return new Vector2(-sin($rad), cos($rad));
  }

  // --------- lifecycle stubs from Behavior ---------

  public function updateSecond(): void
  {
    /* nop */
  }

  public function updateTick(): void
  {
    /* nop (we drive via base tick callback) */
  }

  public function exit(): void
  {
    /* nop */
  }

}
