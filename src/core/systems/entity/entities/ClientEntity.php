<?php

namespace core\systems\entity\entities;

use pocketmine\math\Vector3;

class ClientEntity
{
  private Vector3 $recvPos;
  private Vector3 $pos;
  private Vector3 $prevPos;
  private int $interpolationTicks = 0;

  public function __construct()
  {
    $this->recvPos = Vector3::zero();
  }

  public function tick(): void
  {
    if ($this->interpolationTicks > 0) {
      $multAmt = 1 / $this->interpolationTicks;

      $newPos = new Vector3
      (
        ($this->recvPos->x - $this->pos->x) * $multAmt + $this->pos->x,
        ($this->recvPos->y - $this->pos->y) * $multAmt + $this->pos->y,
        ($this->recvPos->z - $this->pos->z) * $multAmt + $this->pos->z
      );

      $this->interpolationTicks -= 1;
      $this->setPosition($newPos);
    } else {
      $this->setPosition($this->recvPos);
    }
  }

  public function update(Vector3 $recvPos, int $interpolationTicks): void
  {
    if ($recvPos->equals($this->recvPos)) {
      return;
    }

    $this->recvPos = $recvPos;
    $this->interpolationTicks = $interpolationTicks;

    if (!isset($this->pos)) {
      $this->pos = $recvPos;
      $this->prevPos = $recvPos;
    }
  }

  public function getPosition(): Vector3
  {
    return $this->pos;
  }

  public function getPrevPosition(): Vector3
  {
    return $this->prevPos;
  }

  private function setPosition(Vector3 $pos): void
  {
    $this->prevPos = $this->pos;
    $this->pos = $pos;
  }

}