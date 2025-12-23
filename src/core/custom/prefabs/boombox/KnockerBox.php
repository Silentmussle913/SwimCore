<?php

namespace core\custom\prefabs\boombox;

use core\systems\player\SwimPlayer;
use core\utils\InventoryUtil;
use pocketmine\block\Block;
use pocketmine\entity\Location;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\Random;
use pocketmine\world\BlockTransaction;
use pocketmine\world\sound\IgniteSound;

class KnockerBox extends BaseBox
{

  public function __construct()
  {
    parent::__construct();
    $this->setWorksUnderwater(true); // client hack to make the tnt use underwater tnt textures
  }

  public function place
  (
    BlockTransaction $tx,
    Item             $item,
    Block            $blockReplace,
    Block            $blockClicked,
    int              $face,
    Vector3          $clickVector,
    ?Player          $player = null
  ): bool
  {
    if ($player instanceof SwimPlayer) {

      // if on cool down then don't do throwing tnt logic
      $cd = $player->getCoolDowns();
      if ($cd?->onCoolDown($item)) {
        return false;
      }

      $pos = $blockReplace->getPosition();
      $primedTnt = new KnockerBoxEntity(Location::fromObject($pos->add(0.5, 0, 0.5), $pos->getWorld()), $player);
      $primedTnt->setWorksUnderwater(true);
      $mot = (new Random())->nextSignedFloat() * M_PI * 2;
      $primedTnt->setMotion(new Vector3(-sin($mot) * 0.02, 0.2, -cos($mot) * 0.02));
      $primedTnt->setFuse(15);
      $primedTnt->spawnToAll();
      $primedTnt->broadcastSound(new IgniteSound());

      // then add a cool down to it
      $cd->setCoolDown($item, 0.10, false);
      // $cd->setFocused($item);
      InventoryUtil::forceItemPop($player, $item);
    }

    return true;
  }

}