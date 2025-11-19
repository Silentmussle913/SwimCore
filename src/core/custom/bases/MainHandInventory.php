<?php

namespace core\custom\bases;

use core\systems\entity\entities\Actor;
use pocketmine\inventory\SimpleInventory;

class MainHandInventory extends SimpleInventory
{

  private Actor $holder;

  public function __construct(Actor $holder, int $size = 1)
  {
    $this->holder = $holder;
    parent::__construct($size);
  }

  public function getHolder(): Actor
  {
    return $this->holder;
  }

}