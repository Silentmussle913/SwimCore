<?php

namespace core\custom\prefabs\apples;

use core\systems\player\SwimPlayer;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\entity\Living;
use pocketmine\item\GoldenApple;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\utils\TextFormat;

class SwimApple extends GoldenApple
{

  public function __construct
  (
    ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::GOLDEN_APPLE),
    string $name = "Unknown",
    array $enchantmentTags = []
  )
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . TextFormat::GOLD . "Golden Apple");
  }

  public function getAdditionalEffects(): array
  {
    return [
      new EffectInstance(VanillaEffects::REGENERATION(), 100, 1),
      // new EffectInstance(VanillaEffects::ABSORPTION(), 2400) // on consume does this
    ];
  }

  public function onConsume(Living $consumer): void
  {
    if ($consumer instanceof SwimPlayer) {
      $abs = $consumer->getAbsorption();
      if ($abs <= 10) {
        $consumer->setAbsorption($abs + 4);
      }
    }
  }

}
