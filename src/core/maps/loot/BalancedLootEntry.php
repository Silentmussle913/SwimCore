<?php

namespace core\maps\loot;

use pocketmine\item\Item;

/**
 * Simple data holder for balanced loot entries.
 */
class BalancedLootEntry
{

  public Item $item;
  public int $weight;
  public int $minStack;
  public int $maxStack;
  public bool $avoidGood;

  public function __construct(Item $item, int $weight, int $minStack, int $maxStack, bool $avoidGood)
  {
    $this->item = $item;
    $this->weight = $weight;
    $this->minStack = $minStack;
    $this->maxStack = $maxStack;
    $this->avoidGood = $avoidGood;
  }

}