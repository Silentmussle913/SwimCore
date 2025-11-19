<?php

namespace core\custom\behaviors\player_event_behaviors\kit_sg;

use core\custom\prefabs\pearl\SwimPearlItem;
use core\systems\player\components\behaviors\EventBehaviorComponent;
use core\systems\player\SwimPlayer;
use core\utils\TimeHelper;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\utils\TextFormat;

class BruteKitBehavior extends EventBehaviorComponent
{

  public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void
  {
    if ($event->getFinalDamage() >= $victim->getHealth()) {
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
    $this->swimPlayer->getEffects()->add(new EffectInstance(VanillaEffects::STRENGTH(), TimeHelper::secondsToTicks(5)));
    $this->swimPlayer->getInventory()->addItem(new SwimPearlItem($this->swimPlayer, 1));
    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Brute Kit Gave you an Ender Pearl and 5 seconds of strength!");
  }

}