<?php

namespace core\utils;

use pocketmine\world\World;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use WeakMap;

final class WorldCollisionAccessorCacheHack {

  /** @var ReflectionProperty|null */
  private static ?ReflectionProperty $rpWorldRegistry = null;

  /** @var ReflectionProperty|null */
  private static ?ReflectionProperty $rpRegistryCollision = null;

  /** @var WeakMap<World, mixed>|null */
  private static ?WeakMap $cache = null;

  /**
   * Returns the internal collisionInfo for the given World.
   * Uses reflection only once per World instance (and once globally per property).
   * @throws ReflectionException
   */
  public static function get(World $world): mixed {
    // lazy-init cache
    self::$cache ??= new WeakMap();

    // fast path: already cached for this world
    if (isset(self::$cache[$world])) {
      return self::$cache[$world];
    }

    // lazy-init reflection props (only once globally)
    if (self::$rpWorldRegistry === null || self::$rpRegistryCollision === null) {
      // World::$blockStateRegistry
      $rcWorld = new ReflectionClass($world);
      $propRegistry = $rcWorld->getProperty('blockStateRegistry');
      // $propRegistry->setAccessible(true);
      self::$rpWorldRegistry = $propRegistry;

      // (BlockStateRegistry)::$collisionInfo
      $registry = $propRegistry->getValue($world);
      $rcRegistry = new ReflectionClass($registry);
      $propCollision = $rcRegistry->getProperty('collisionInfo');
      // $propCollision->setAccessible(true);
      self::$rpRegistryCollision = $propCollision;
    }

    // resolve for this world and cache
    $registry = self::$rpWorldRegistry->getValue($world);
    $collisionInfo = self::$rpRegistryCollision->getValue($registry);
    self::$cache[$world] = $collisionInfo;

    return $collisionInfo;
  }

}