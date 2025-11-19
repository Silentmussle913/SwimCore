<?php

namespace core\custom\behaviors\player_event_behaviors\kit_sg;

use core\custom\prefabs\pot\SwimDrinkPot;
use core\custom\prefabs\pot\SwimPotItem;
use core\systems\player\components\behaviors\EventBehaviorComponent;
use core\systems\player\SwimPlayer;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\Event;
use pocketmine\item\PotionType;
use pocketmine\utils\TextFormat;
use pocketmine\utils\TextFormat as TF;

class WizardManKitBehavior extends EventBehaviorComponent
{

  private static array $potionTypes = [
    "Night Vision" => [PotionType::NIGHT_VISION, TF::BLUE],
    "Invisibility" => [PotionType::INVISIBILITY, TF::GRAY],
    "Leaping" => [PotionType::LEAPING, TF::GREEN],
    "Leaping II" => [PotionType::STRONG_LEAPING, TF::GREEN],
    "Fire Resistance" => [PotionType::FIRE_RESISTANCE, TF::YELLOW],
    "Swiftness" => [PotionType::SWIFTNESS, TF::AQUA],
    "Swiftness II" => [PotionType::STRONG_SWIFTNESS, TF::AQUA],
    "Slowness" => [PotionType::SLOWNESS, TF::DARK_GRAY],
    "Water Breathing" => [PotionType::WATER_BREATHING, TF::DARK_AQUA],
    "Healing" => [PotionType::STRONG_HEALING, TF::RED],
    "Harming" => [PotionType::STRONG_HARMING, TF::DARK_RED],
    "Poison" => [PotionType::POISON, TF::DARK_GREEN],
    "Poison II" => [PotionType::STRONG_POISON, TF::DARK_GREEN],
    "Regeneration" => [PotionType::LONG_REGENERATION, TF::LIGHT_PURPLE],
    "Regeneration II" => [PotionType::STRONG_REGENERATION, TF::LIGHT_PURPLE],
    "Strength" => [PotionType::STRENGTH, TF::RED],
    "Strength II" => [PotionType::STRONG_STRENGTH, TF::RED],
    "Weakness" => [PotionType::WEAKNESS, TF::GRAY],
    "Wither" => [PotionType::WITHER, TF::BLACK],
    "Turtle Master" => [PotionType::TURTLE_MASTER, TF::MINECOIN_GOLD],
    "Slow Falling" => [PotionType::SLOW_FALLING, TF::DARK_PURPLE]
  ];

  public function attackedPlayer(EntityDamageByEntityEvent $event, SwimPlayer $victim): void
  {
    if ($event->getFinalDamage() >= $victim->getHealth()) { // if killed them
      $this->kit();
    }
  }

  public function eventMessage(Event $event, string $message, mixed $args)
  {
    if ($message === "kill") {
      $this->kit();
    }
  }

  protected function kit(): void
  {
    // Generate a random potion (drinkable or splash and with random effect)
    $inv = $this->swimPlayer->getInventory();
    $randomTypeKey = array_rand(self::$potionTypes);
    $randomTypeInfo = self::$potionTypes[$randomTypeKey];
    $randomType = $randomTypeInfo[0];
    $color = $randomTypeInfo[1];
    $isSplash = rand(0, 1);

    $stringName = TF::RESET . $color . "Potion of " . $randomTypeKey;
    if (!$isSplash) { // Drinkable
      $pot = new SwimDrinkPot();
      $pot->setCustomName($stringName);
    } else { // Splash
      $stringName = $color . "Splash Potion of " . $randomTypeKey; // have to rename to splash potion
      $pot = new SwimPotItem($stringName);
    }

    // Add to inventory if possible
    $pot->setType($randomType);
    if ($inv->canAddItem($pot)) {
      $inv->addItem($pot);
      $this->swimPlayer->sendMessage(TextFormat::GREEN . "Wizard Man Kit Gave you " . $stringName);
    }
  }

}