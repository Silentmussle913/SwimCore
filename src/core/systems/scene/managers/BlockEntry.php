<?php

namespace core\systems\scene\managers;

use pocketmine\block\Block;
use pocketmine\math\Vector3;

class BlockEntry
{

  /**
   * @param Vector3 $position source of truth for where this block should be as $block won't always have an accurate position
   * @param Block $block the block to place, only trust this for its type and metadata, not its location
   * @param int $time the server tick this block was born into existence
   * @param int $key the cached vector3 key of $position, by default is -1 until set manually
   * @param int $ownerEntity the ID of the entity that placed/broke this block, default -1 for no owner
   */
  public function __construct
  (
    public Vector3 $position,
    public Block $block,
    public int $time = 0,
    public int $key = -1,
    public int $ownerEntity = -1
  )
  {
  }

}