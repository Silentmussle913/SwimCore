<?php

namespace core\custom\behaviors\player_event_behaviors\kit_sg;

use core\systems\player\components\behaviors\EventBehaviorComponent;
use core\systems\player\SwimPlayer;
use core\utils\CustomDamage;
use core\utils\TimeHelper;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\item\VanillaItems;
use pocketmine\utils\TextFormat;
use core\custom\prefabs\carrot\SpeedCarrot;

class ArcherKitBehavior extends EventBehaviorComponent
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
    $this->swimPlayer->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), TimeHelper::secondsToTicks(10), 1));
    $this->swimPlayer->getInventory()->addItem(VanillaItems::ARROW()->setCount(8));
    $this->swimPlayer->getInventory()->addItem((new SpeedCarrot())->setCount(1));
    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Archer Kit Gave you +8 arrows +1 Speed Carrot and 10 seconds of speed!");
  }

}