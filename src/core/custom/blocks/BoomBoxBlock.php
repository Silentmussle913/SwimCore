<?php

namespace core\custom\blocks;

class BoomBoxBlock extends CustomBlock
{

  public static function getCustomBlockData(): CustomBlockData
  {
    return new CustomBlockData(
      "§r§4Boombox",
      "boombox",
      "custom:boombox",
      "geometry.boombox"
    );
  }

}
