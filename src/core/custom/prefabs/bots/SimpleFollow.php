<?php

namespace core\custom\prefabs\bots;

use core\systems\entity\Behavior;
use core\utils\PositionHelper;
use pocketmine\player\Player;

class SimpleFollow extends Behavior
{

  // We know at bare minimum our parent has some kind of mover to talk to.
  private ?SimpleMover $mover = null;

  private bool $tickBased = true;

  public function init(): void
  {
    $this->getMover();
  }

  private function getMover(bool $cache = true): ?SimpleMover
  {
    if ($this->mover !== null) {
      return $this->mover;
    }

    $mover = $this->parent->getEntityBehaviorManager()->getBehavior("mover");

    if ($mover instanceof SimpleMover) {
      if ($cache) {
        $this->mover = $mover;
      }

      return $mover;
    }

    return null;
  }

  private function goTo(): void
  {
    /** @var ?Player $targetPlayer */
    $targetPlayer = $this->getNearestPlayer();

    // Set the mover to that area
    if ($targetPlayer !== null) {
      $myEyePos = $this->parent->getEyePos();
      $targetPos = $targetPlayer->getPosition();
      $targetEyePos = $targetPlayer->getEyePos();
      $pitch = -PositionHelper::getPitchTowardsPosition($myEyePos, $targetEyePos); // pitch up is negative
      $yaw = PositionHelper::getYawTowardsPosition($myEyePos, $targetEyePos);
      $mover = $this->getMover(false);
      $mover?->setTargetPosition($targetPos, $pitch, $yaw);
    } // TODO: otherwise we should make this thing just random walk around and patrol the area
  }

  protected function getNearestPlayer(): ?Player
  {
    /** @var ?Player $targetPlayer */
    $targetPlayer = null;

    $myPos = $this->parent->getPosition();
    $players = $this->scene->getPlayers();
    $smallestDistance = PHP_FLOAT_MAX;

    // Get the nearest player
    foreach ($players as $player) {
      if (!$player->isOnline()) continue;
      if ($player->isSpectator()) continue;
      $dist = $player->getPosition()->distance($myPos);
      if ($dist < $smallestDistance || $targetPlayer === null) {
        $smallestDistance = $dist;
        $targetPlayer = $player;
      }
    }

    return $targetPlayer;
  }

  public function updateSecond(): void
  {
    if (!$this->tickBased) {
      $this->goTo();
    }
  }

  public function updateTick(): void
  {
    if ($this->tickBased) {
      $this->goTo();
    }
  }

  public function exit(): void
  {
    // nop
  }

}