<?php

namespace core\utils;

use pocketmine\block\RuntimeBlockStateRegistry;
use pocketmine\block\BlockTypeIds;
use pocketmine\math\AxisAlignedBB;
use pocketmine\world\format\Chunk;
use pocketmine\world\format\SubChunk;
use pocketmine\world\World;
use ReflectionException;

class WorldCollisionBoxHelper
{

  /**
   * @throws ReflectionException
   */
  public static function getCollisionBlocksIncludingSoft(AxisAlignedBB $bb, World $world, bool $targetFirst = false): array
  {
    $minX = (int)floor($bb->minX - 1);
    $minY = (int)floor($bb->minY - 1);
    $minZ = (int)floor($bb->minZ - 1);
    $maxX = (int)floor($bb->maxX + 1);
    $maxY = (int)floor($bb->maxY + 1);
    $maxZ = (int)floor($bb->maxZ + 1);

    $collides = [];

    // cached reflection grab (lazy, per-world)
    $collisionInfo = WorldCollisionAccessorCacheHack::get($world);

    if ($targetFirst) {
      for ($z = $minZ; $z <= $maxZ; ++$z) {
        for ($x = $minX; $x <= $maxX; ++$x) {
          for ($y = $minY; $y <= $maxY; ++$y) {
            if (self::hitCheck($x, $y, $z, $collisionInfo, $world, $bb)) {
              return [$world->getBlockAt($x, $y, $z)];
            }
          }
        }
      }
    } else {
      for ($z = $minZ; $z <= $maxZ; ++$z) {
        for ($x = $minX; $x <= $maxX; ++$x) {
          for ($y = $minY; $y <= $maxY; ++$y) {
            if (self::hitCheck($x, $y, $z, $collisionInfo, $world, $bb)) {
              $collides[] = $world->getBlockAt($x, $y, $z);
            }
          }
        }
      }
    }

    return $collides;
  }

  private static function hitCheck(int $x, int $y, int $z, mixed $collisionInfo, World $world, AxisAlignedBB $bb): bool
  {
    $stateCollisionInfo = self::getBlockCollisionInfo($x, $y, $z, $collisionInfo, $world);

    /*
    if (SwimCore::$DEBUG) {
      $block = $world->getBlockAt($x, $y, $z);
      if ($block instanceof Liquid) {
        echo("{$block->getName()} State: " . $stateCollisionInfo . "\n");
      }
    }
    */

    return match ($stateCollisionInfo) {
      // 1x1x1 full cube — quick integer AABB test
      RuntimeBlockStateRegistry::COLLISION_CUBE => self::checkCubeCollision($x, $y, $z, $bb),

      // no (solid) collision or weird overflowing — but we still want to catch soft blocks like liquids/cobweb/liquid/vines/ladder
      RuntimeBlockStateRegistry::COLLISION_MAY_OVERFLOW,
      RuntimeBlockStateRegistry::COLLISION_NONE => self::checkSoftCollision($x, $y, $z, $bb, $world),

      // complex voxel shapes — defer to block’s collision boxes
      default => $world->getBlockAt($x, $y, $z)->collidesWithBB($bb), // this is dangerous
    };
  }

  private static function checkCubeCollision(int $x, int $y, int $z, AxisAlignedBB $bb, float $epsilon = 0.0001): bool
  {
    $bMaxX = $x + 1;
    $bMaxY = $y + 1;
    $bMaxZ = $z + 1;

    // Standard AABB overlap with a tiny epsilon to avoid FP edge cases
    if ($bMaxX - $bb->minX > $epsilon && $bb->maxX - $x > $epsilon) {
      if ($bMaxY - $bb->minY > $epsilon && $bb->maxY - $y > $epsilon) {
        return $bMaxZ - $bb->minZ > $epsilon && $bb->maxZ - $z > $epsilon;
      }
    }
    return false;
  }

  public static function isSoft(int $id): bool
  {
    // Soft-interaction list:
    // - COBWEB
    // - Liquids (WATER/LAVA or any Liquid subclass)
    // - Climbable (VINES, LADDER, CAVE_VINES)
    return
      $id == BlockTypeIds::COBWEB ||
      $id == BlockTypeIds::WATER ||
      $id == BlockTypeIds::LAVA ||
      $id == BlockTypeIds::VINES ||
      $id == BlockTypeIds::LADDER ||
      $id == BlockTypeIds::CAVE_VINES;
  }

  /**
   * Treat soft blocks as collidable for detection purposes (cobwebs/liquids/vines/ladders/etc).
   * We use a simple cube AABB check to determine if the player is inside/overlapping the block space.
   */
  private static function checkSoftCollision(int $x, int $y, int $z, AxisAlignedBB $bb, World $world): bool
  {
    $block = $world->getBlockAt($x, $y, $z);
    $id = $block->getTypeId();

    // Skip obvious empties fast (AIR and friends will typically be NONE as well)
    if ($id == BlockTypeIds::AIR) {
      return false;
    }

    if (!self::isSoft($id)) {
      return false;
    }

    /*
    if (SwimCore::$DEBUG) {
      $str = $didCollide ? "TRUE" : "FALSE";
      echo("Collision on {$block->getName()}: $str\n");
    }
    */

    // If it's soft, treat it as a full block volume for presence tests
    return self::checkCubeCollision($x, $y, $z, $bb);
  }

  /**
   * @param int[] $collisionInfo
   * @phpstan-param array<int, int> $collisionInfo
   */
  private static function getBlockCollisionInfo(int $x, int $y, int $z, array $collisionInfo, World $world): int
  {
    if (!$world->isInWorld($x, $y, $z)) {
      return RuntimeBlockStateRegistry::COLLISION_NONE;
    }

    $chunk = $world->getChunk($x >> Chunk::COORD_BIT_SIZE, $z >> Chunk::COORD_BIT_SIZE);
    if ($chunk === null) {
      return RuntimeBlockStateRegistry::COLLISION_NONE;
    }

    $stateId = $chunk
      ->getSubChunk($y >> SubChunk::COORD_BIT_SIZE)
      ->getBlockStateId(
        $x & SubChunk::COORD_MASK,
        $y & SubChunk::COORD_MASK,
        $z & SubChunk::COORD_MASK
      );

    return $collisionInfo[$stateId] ?? RuntimeBlockStateRegistry::COLLISION_NONE;
  }

}
