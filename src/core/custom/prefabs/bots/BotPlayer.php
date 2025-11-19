<?php

namespace core\custom\prefabs\bots;

use core\custom\bases\ItemHolderActor;
use core\SwimCore;
use core\systems\player\components\Nicks;
use core\systems\player\SwimPlayer;
use core\systems\scene\Scene;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class BotPlayer extends ItemHolderActor
{

  public static function getNetworkTypeId(): string
  {
    return EntityIds::PLAYER;
  }

  public function getInitialSizeInfo(): EntitySizeInfo
  {
    return new EntitySizeInfo(1.8, 0.6, 1.62);
  }

  public function __construct
  (
    Location     $location,
    ?Scene       $parentScene = null,
    ?CompoundTag $nbt = null,
    ?Skin        $skin = null,
    string       $name = ""
  )
  {
    if ($skin === null) {
      // Grab a random skin from an online player
      $players = Server::getInstance()->getOnlinePlayers();
      if (!empty($players)) {
        $key = array_rand($players);
        if (isset($players[$key])) {
          $player = $players[$key];
          $skin = $player->getSkin();
          if (SwimCore::$DEBUG) echo("Setting skin from {$player->getName()}\n");
        }
      }
    }

    // 36 is the magic number for amount of slots in a single regular player item inventory not counting armor or offhand held item
    parent::__construct($location, $parentScene, 36, $nbt, $skin);

    // Regular values
    $this->setMaxHealth(20);
    $this->setHasGravity();
    $this->setScale(1);

    // Set a random name if needed
    if ($name === "") {
      $name = Nicks::getRandomNick();
    }
    $this->setNameTag(TextFormat::GRAY . $name);
  }

  protected function playerInteract(SwimPlayer $player, Vector3 $clickPos): void
  {
    $this->entityBehaviorManager->eventMessage("open", $player);
  }

  protected function attackedByPlayer(EntityDamageByEntityEvent $source, SwimPlayer $player): void
  {
    // $this->entityBehaviorManager->eventMessage("attacked");
  }

}