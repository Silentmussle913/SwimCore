<?php

namespace core\custom\behaviors\entity_behaviors;

use core\SwimCore;
use core\systems\entity\Behavior;

class AnimationCycler extends Behavior
{

  private array $animations = [];

  private int $secondsSinceLastEmote = 3;
  private int $delay = 3;
  private int $animIndex = 0;

  public function setAnimations(array $animations): void
  {
    $this->animations = $animations;
  }

  public function init(): void
  {

  }

  public function setDelay(int $d): void
  {
    $this->delay = $d;
  }

  public function updateSecond(): void
  {
    if (empty($this->animations)) {
      if (SwimCore::$DEBUG) echo("No animations to run!\n");
      return;
    }

    $this->secondsSinceLastEmote--;
    if ($this->secondsSinceLastEmote <= 0) {
      // Play current animation
      $this->parent->doAnimation($this->animations[$this->animIndex]);
      // Go to the next animation
      $this->animIndex = ($this->animIndex + 1) % count($this->animations);

      $this->secondsSinceLastEmote = $this->delay;
    }
  }

  public function updateTick(): void
  {

  }

  public function exit(): void
  {

  }

}