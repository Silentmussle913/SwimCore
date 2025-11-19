<?php

namespace core\custom\prefabs\boombox;

use core\scenes\PvP;
use core\systems\player\SwimPlayer;
use pocketmine\block\Block;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\TNT;
use pocketmine\block\VanillaBlocks;
use pocketmine\entity\Location;
use pocketmine\world\sound\IgniteSound;

abstract class BaseBox extends TNT
{

  public function __construct()
  {
    $block = VanillaBlocks::TNT();
    $typeID = $block->getTypeId();

    parent::__construct(new BlockIdentifier($typeID), "Custom TNT", new BlockTypeInfo($block->getBreakInfo()));
  }

  public function prepareTNT(Block $blockReplace, SwimPlayer $player): SmoothPrimedTNT
  {
    // the pvp scene states the tnt's behavior
    $fuse = 40;
    $breaksBlocks = false;
    $scene = $player->getSceneHelper()?->getScene();
    if ($scene instanceof PvP) {
      $breaksBlocks = $scene->tntBreaksBlocks;
      $fuse = $scene->tntFuse;
    }

    // place the primed tnt
    $pos = $blockReplace->getPosition();
    $primedTnt = new SmoothPrimedTNT($player, Location::fromObject($pos->add(0.5, 0, 0.5), $pos->getWorld()), $breaksBlocks);
    $primedTnt->setFuse($fuse);
    $primedTnt->spawnToAll();
    $primedTnt->broadcastSound(new IgniteSound());

    return $primedTnt;
  }

}