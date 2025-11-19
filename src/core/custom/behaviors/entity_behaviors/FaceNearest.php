<?php

namespace core\custom\behaviors\entity_behaviors;

use core\systems\entity\Behavior;
use pocketmine\player\Player;

class FaceNearest extends Behavior
{

  public ?Player $nearestPlayer = null;

  public function init(): void
  {
    $this->look();
  }

  public function updateSecond(): void
  {
    $this->look();
  }

  private function look(): void
  {
    $this->findNearest();
    if ($this->nearestPlayer !== null) {
      $this->parent->lookAt($this->nearestPlayer->getEyePos());
    }
  }

  public function updateTick(): void
  {

  }

  public function exit(): void
  {

  }

  /**
   * Finds the nearest non-spectator player to this entity
   * and updates $this->nearestPlayer accordingly.
   *
   * If no valid player is found, $this->nearestPlayer is set to null.
   */
  private function findNearest(): void
  {
    // Grab this entity's current position
    $myPos = $this->parent->getPosition();

    // Track the closest player and its distance (squared) found so far
    $closestPlayer = null;
    $closestDistanceSq = PHP_INT_MAX; // Start with a very large number

    // Loop over all players in the scene
    foreach ($this->scene->getPlayers() as $player) {
      // Skip players who are spectating
      if ($player->isSpectator()) {
        continue;
      }

      // Calculate the square of the distance from this entity to the player
      $distSq = $myPos->distanceSquared($player->getPosition());

      // If this is closer than our current known close distance, update our tracking
      if ($distSq < $closestDistanceSq) {
        $closestDistanceSq = $distSq;
        $closestPlayer = $player;
      }
    }

    // Update the nearestPlayer property
    $this->nearestPlayer = $closestPlayer;
  }

}