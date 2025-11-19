<?php

namespace core\maps\info;

use core\systems\map\MapInfo;
use core\utils\PositionHelper;
use pocketmine\math\Vector3;

// the same as normal MapInfo, just with 2 more team spots. Also holds an array of the spawn points.
// Honestly this should be turned into MultiTeamMapInfo which is just the raw array of positions (that is what MapInfo should have been to begin with)
class FourTeamMapInfo extends MapInfo
{

  private Vector3 $spawnPos3;
  private Vector3 $spawnPos4;

  /** @var Vector3[] */
  public array $spawnPoints = [];

  public function __construct(string $mapName, Vector3 $spawnPos1, Vector3 $spawnPos2, Vector3 $spawnPos3, Vector3 $spawnPos4)
  {
    parent::__construct($mapName, $spawnPos1, $spawnPos2);
    $this->spawnPos3 = PositionHelper::centerVector($spawnPos3);
    $this->spawnPos4 = PositionHelper::centerVector($spawnPos4);
    $this->spawnPoints = [$spawnPos1, $spawnPos2, $spawnPos3, $spawnPos4];
  }

  /**
   * @return Vector3
   */
  public function getSpawnPos3(): Vector3
  {
    return $this->spawnPos3;
  }

  /**
   * @return Vector3
   */
  public function getSpawnPos4(): Vector3
  {
    return $this->spawnPos4;
  }

}