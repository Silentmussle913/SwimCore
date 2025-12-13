<?php

namespace core\systems\map;

use core\maps\pool\BasicDuelMaps;
use core\systems\player\SwimPlayer;
use core\systems\System;

class MapsData extends System
{

  private BasicDuelMaps $basicDuelMaps; // used flat basic duel maps for pot, boxing, buhc. However, fireball fight uses this world too for its maps.
  private BasicDuelMaps $miscDuelMaps; // all the OG swim.gg kohi maps are in this, and bed fight, bridge, battle rush, and sky wars

  /** @var MapPool[] */
  private array $mapPools; // key is duel type as string

  // I have no idea a good way to automate this creation without hardcoding all the map initialization
  public function init(): void
  {
    // basic duels
    $this->basicDuelMaps = new BasicDuelMaps($this->core, "BasicDuelMaps.json");
    $this->miscDuelMaps = new BasicDuelMaps($this->core, "MiscDuelMaps.json");

    // in a data structure because much more scalable for our getters
    $this->mapPools = [
      'basic' => $this->basicDuelMaps,
      'misc' => $this->miscDuelMaps,
    ];
  }

  /** Normalize a key by stripping non-alphanumerics and lowercasing. */
  public static function normalizeKey(string $s): string
  {
    return strtolower(preg_replace('/[^a-z0-9]+/i', '', $s));
  }

  public function getMapPoolFromMode(string $mode): ?MapPool
  {
    $m = self::normalizeKey($mode);

    if ($this->modeUsesBasicMaps($m)) {
      return $this->basicDuelMaps;
    }

    if (isset($this->mapPools[$m])) {
      return $this->mapPools[$m];
    }

    return $this->miscDuelMaps;
  }

  public function modeHasAvailableMap(string $mode): bool
  {
    $m = self::normalizeKey($mode);

    if (isset($this->mapPools[$m])) {
      return $this->mapPools[$m]->hasAvailableMap();
    }
    return $this->mapPools['basic']->hasAvailableMap();
  }

  public function getRandomMapFromMode(string $mode): ?MapInfo
  {
    $m = self::normalizeKey($mode);

    if (isset($this->mapPools[$m])) {
      return $this->mapPools[$m]->getRandomMap();
    }
    return $this->mapPools['basic']->getRandomMap();
  }

  public function getFirstInactiveMapByBaseNameFromMode(string $mode, string $name, bool $normalizeMode = true): ?MapInfo
  {
    if ($normalizeMode) {
      $m = self::normalizeKey($mode);
    } else {
      $m = $mode;
    }

    if (isset($this->mapPools[$m])) {
      return $this->mapPools[$m]->getFirstInactiveMapByBaseName($name);
    }

    // special handling for basic and misc maps:

    if ($this->modeUsesBasicMaps($m)) {
      return $this->mapPools['basic']->getFirstInactiveMapByBaseName($name);
    }

    return $this->mapPools['misc']->getFirstInactiveMapByBaseName($name);
  }

  public function getMostSimilarNamedMapThatIsAvailable(string $mode, string $name): ?MapInfo
  {
    $m = self::normalizeKey($mode);

    // Determine which pool to use.
    if (isset($this->mapPools[$m])) {
      $pool = $this->mapPools[$m];
    } elseif ($this->modeUsesBasicMaps($m)) {
      $pool = $this->mapPools['basic'];
    } else {
      $pool = $this->mapPools['misc'];
    }

    // Get all maps from the chosen pool.
    $maps = $pool->getMaps();

    // If the requested name has trailing digits, extract the base and target number.
    if (preg_match('/^(.*?)(\d+)$/', $name, $matches)) {
      $base = $matches[1]; // For "ender3", this gives "ender"
      $targetNumber = (int)$matches[2]; // For "ender3", this gives 3
      $closestMap = null;
      $smallestDiff = PHP_INT_MAX;

      foreach ($maps as $mapName => $mapInfo) {
        // Only consider inactive maps.
        if ($mapInfo->mapIsActive()) {
          continue;
        }
        // Match only names that consist exactly of the base followed by digits.
        if (preg_match('/^' . preg_quote($base, '/') . '(\d+)$/', $mapName, $numMatch)) {
          $number = (int)$numMatch[1];
          $diff = abs($number - $targetNumber);
          if ($diff < $smallestDiff) {
            $smallestDiff = $diff;
            $closestMap = $mapInfo;
          }
        }
      }

      return $closestMap;
    } else {
      // If the requested name doesn't end with digits, try an exact match first.
      foreach ($maps as $mapName => $mapInfo) {
        if (!$mapInfo->mapIsActive() && $mapName === $name) {
          return $mapInfo;
        }
      }
      // Then try to find one that starts with the given name and is followed by digits.
      foreach ($maps as $mapName => $mapInfo) {
        if (!$mapInfo->mapIsActive() && preg_match('/^' . preg_quote($name, '/') . '\d+$/', $mapName)) {
          return $mapInfo;
        }
      }
    }

    return null;
  }

  public function modeUsesBasicMaps(string $mode): bool
  {
    $m = self::normalizeKey($mode);
    if (isset($this->mapPools[$m])) {
      return false;
    }
    return true;
  }

  public function needsToUseMiscWorld(string $selectedMapName): bool
  {
    // check if map exists in our misc maps, if it does, then this returns true saying that we do need to use the misc world
    if ($this->miscDuelMaps->getMapInfoByName($selectedMapName)) {
      return true;
    }
    return false;
  }

  public function getNamedMapFromMode(string $mode, string $name): ?MapInfo
  {
    $m = self::normalizeKey($mode);
    if (isset($this->mapPools[$m])) {
      return $this->mapPools[$m]->getMapInfoByName($name);
    }
    return $this->mapPools['basic']->getMapInfoByName($name);
  }

  public function getMapPool(string $mode, bool $normalize = true): ?MapPool
  {
    if ($normalize) {
      $m = self::normalizeKey($mode);
      return $this->mapPools[$m] ?? null;
    } else {
      return $this->mapPools[$mode] ?? null;
    }
  }

  /**
   * @return ?BasicDuelMaps
   */
  public function getBasicDuelMaps(): ?BasicDuelMaps
  {
    $d = $this->mapPools['basic'];
    if ($d instanceof BasicDuelMaps) {
      return $d;
    }
    return null;
  }

  /**
   * @return ?BasicDuelMaps
   */
  public function getMiscDuelMaps(): ?BasicDuelMaps
  {
    $d = $this->mapPools['misc'];
    if ($d instanceof BasicDuelMaps) {
      return $d;
    }
    return null;
  }

  public function updateTick(): void
  {

  }

  public function updateSecond(): void
  {

  }

  public function exit(): void
  {

  }

  public function handlePlayerLeave(SwimPlayer $swimPlayer): void
  {

  }

}