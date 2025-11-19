<?php

namespace core\custom\blocks;

use pocketmine\math\Vector3;

class CustomBlockData
{

  public function __construct(
    public string   $customName,
    public string   $customTexture,
    public string   $customIdentifier,
    public string   $customGeo,
    public Vector3 $origin = new Vector3(-8, 0, -8),
    public Vector3 $size = new Vector3(16, 16, 16),
  )
  {
    // nop, pure data
  }

}