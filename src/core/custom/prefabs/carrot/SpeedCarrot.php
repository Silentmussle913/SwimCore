<?php

namespace core\custom\prefabs\carrot;

use core\systems\player\SwimPlayer;
use core\utils\InventoryUtil;
use core\utils\TimeHelper;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\entity\EntityRegainHealthEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\GoldenCarrot;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\BurpSound;

class SpeedCarrot extends GoldenCarrot
{

  public function __construct
  (
    ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::GOLDEN_CARROT),
    string         $name = TextFormat::MINECOIN_GOLD . "Speed Carrot",
    array          $enchantmentTags = []
  )
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . $name);
  }

  public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
  {
    if ($player instanceof SwimPlayer) {
      $player->heal(new EntityRegainHealthEvent($player, 6, EntityRegainHealthEvent::CAUSE_CUSTOM));
      $player->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), TimeHelper::secondsToTicks(3)));
      $item = $player->getInventory()->getItemInHand();
      $player->getCoolDowns()?->triggerItemCoolDownEvent(new PlayerItemUseEvent($player, $item, $directionVector), $item, 1);
      $player->broadcastSound(new BurpSound());
      InventoryUtil::forceItemPop($player, $item);
    }
    return ItemUseResult::NONE;
  }

}