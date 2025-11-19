<?php

namespace core\custom\behaviors\player_event_behaviors\kit_sg;

use core\custom\prefabs\boombox\KnockerBox;
use core\custom\prefabs\boombox\ThrowingTNT;
use core\custom\prefabs\soup\HealSoup;
use core\systems\player\components\behaviors\EventBehaviorComponent;
use core\systems\player\SwimPlayer;
use core\utils\CustomDamage;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;

class ArabKitBehavior extends EventBehaviorComponent
{

  public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void
  {
    if (CustomDamage::calculateFinalDamageWithoutCrits($event) >= $victim->getHealth()) {
      $this->kit();
    }
  }

  public function eventMessage(Event $event, string $message, mixed $args)
  {
    if ($message === "kill") {
      $this->kit();
    }
  }

  private function kit(): void
  {
    $inv = $this->swimPlayer->getInventory();

    // Knock back TNT
    $knockerBox = (new KnockerBox())->asItem();
    $knockerBox->setCustomName(TextFormat::RESET . TextFormat::LIGHT_PURPLE . "Knocker Box");
    $knockerBox->setCount(1);
    $inv->addItem($knockerBox);

    // Throwing TNT
    $throwingTNT = (new ThrowingTNT())->asItem();
    $throwingTNT->setCustomName(TextFormat::RESET . TextFormat::RED . "Throwing TNT");
    $throwingTNT->setCount(1);
    $inv->addItem($throwingTNT);

    // re-soup
    $inv->addItem((new HealSoup())->setCount(1));

    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Arab Kit Gave you +1 of each TNT and +1 Heal Soup");
  }

}