<?php

namespace core\custom\behaviors\player_event_behaviors\kit_sg;

use core\custom\prefabs\soup\HealSoup;
use core\systems\player\components\behaviors\EventBehaviorComponent;
use core\systems\player\SwimPlayer;
use core\utils\CustomDamage;
use core\utils\StackTracer;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;

class SouperManKitBehavior extends EventBehaviorComponent
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
    $this->swimPlayer->getInventory()->addItem((new HealSoup())->setCount(1));
    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Souper Man Kit Gave you +1 soup!");
  }

}