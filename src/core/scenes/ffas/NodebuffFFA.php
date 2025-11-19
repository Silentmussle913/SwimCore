<?php

namespace core\scenes\ffas;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\systems\scene\FFAInfo;
use core\utils\BehaviorEventEnum;
use core\utils\InventoryUtil;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;

class NodebuffFFA extends FFA
{

  public static function getIcon(): string
  {
    return "textures/items/potion_bottle_splash_heal";
  }

  public function __construct(SwimCore $core, string $name)
  {
    $this->world = $core->getServer()->getWorldManager()->getWorldByName("PotFFA");
    parent::__construct($core, $name);
  }

  function init(): void
  {
    parent::init();

    $this->info = new FFAInfo(
      "NodebuffFFA",
      TextFormat::RED . "Nodebuff",
      "PotFFA",
      4
    );

    $this->registerCanceledEvents([
      BehaviorEventEnum::PLAYER_DROP_ITEM_EVENT,
      BehaviorEventEnum::BLOCK_BREAK_EVENT,
      BehaviorEventEnum::BLOCK_PLACE_EVENT
    ]);

    // arena center
    $this->x = 244;
    $this->y = 12;
    $this->z = 177;
    $this->spawnOffset = 20;

    $this->interruptAllowed = false;
    $this->world = $this->core->getServer()->getWorldManager()->getWorldByName("PotFFA");
  }

  public function playerAdded(SwimPlayer $player): void
  {
    $this->restart($player);
  }

  // pearl cool down mechanics
  public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void
  {
    $item = $event->getItem();
    if ($item->getTypeId() == ItemTypeIds::ENDER_PEARL) {
      $swimPlayer->getCoolDowns()->triggerItemCoolDownEvent($event, $item);
    }
  }

  protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void
  {
    $this->potKillMessage($attacker, $victim);
    $attacker->getCosmetics()?->killMessageLogic($victim);

    InventoryUtil::clearInventory($attacker);
    InventoryUtil::potKit($attacker);
  }

  private function potKillMessage(SwimPlayer $attacker, SwimPlayer $victim): void
  {
    $attackerName = $attacker->getNicks()->getNick();
    $attackerPotCount = InventoryUtil::getItemCount($attacker, VanillaItems::SPLASH_POTION()->setType(PotionType::STRONG_HEALING()));
    $victimPotCount = InventoryUtil::getItemCount($victim, VanillaItems::SPLASH_POTION()->setType(PotionType::STRONG_HEALING()));
    $attackerPotString = TextFormat::GRAY . " (" . TextFormat::GREEN . $attackerPotCount . TextFormat::GRAY . ")";
    $victimPotString = TextFormat::GRAY . " (" . TextFormat::GREEN . $victimPotCount . TextFormat::GRAY . ")";
    if ($attackerPotCount > $victimPotCount) {
      $pots = $attackerPotCount - $victimPotCount;
      $this->sceneAnnouncement(TextFormat::GREEN . $attackerName . $attackerPotString . TextFormat::YELLOW
        . " " . $pots . " Potted " . TextFormat::RED . $victim->getNicks()->getNick() . $victimPotString);
    } else {
      $this->sceneAnnouncement(TextFormat::GREEN . $attackerName . $attackerPotString . TextFormat::YELLOW
        . " Killed " . TextFormat::RED . $victim->getNicks()->getNick() . $victimPotString);
    }
  }

  /**
   * @throws ScoreFactoryException
   */
  public function updateSecond(): void
  {
    parent::updateSecond();
    foreach ($this->players as $player) {
      $this->ffaScoreboard($player);
      $this->ffaScoreTag($player);
    }
  }

  public function restart(SwimPlayer $swimPlayer): void
  {
    $this->teleportToArena($swimPlayer);
    InventoryUtil::potKit($swimPlayer);
    $this->ffaNameTag($swimPlayer);

    // enable 3rd party protection
    $logger = $swimPlayer->getCombatLogger();
    $logger->setIsProtected(true);
    $logger->setCoolDownTime(10);
    $logger->setUsingCombatCoolDown(true);

    $swimPlayer->setGamemode(GameMode::ADVENTURE);
  }

}
