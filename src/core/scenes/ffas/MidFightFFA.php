<?php

namespace core\scenes\ffas;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\systems\scene\FFAInfo;
use core\utils\BehaviorEventEnum;
use core\utils\CustomDamage;
use core\utils\InventoryUtil;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;

class MidFightFFA extends FFA
{

  public static function getIcon(): string
  {
    return "textures/items/diamond_chestplate";
  }

  public function __construct(SwimCore $core, string $name)
  {
    $this->world = $core->getServer()->getWorldManager()->getWorldByName("midFFA");
    parent::__construct($core, $name);
  }

  function init(): void
  {
    parent::init();

    $this->info = new FFAInfo(
      "MidFightFFA",
      TextFormat::RED . "Midfight",
      "midFFA",
      2
    );

    $this->registerCanceledEvents([
      BehaviorEventEnum::PLAYER_DROP_ITEM_EVENT,
      BehaviorEventEnum::BLOCK_BREAK_EVENT
    ]);

    // arena center
    $this->x = 223;
    $this->y = 77;
    $this->z = 191;
    $this->spawnOffset = 20;

    $this->interruptAllowed = true;
    $this->world = $this->core->getServer()->getWorldManager()->getWorldByName("midFFA");
  }

  public function playerAdded(SwimPlayer $player): void
  {
    $this->restart($player);
  }

  public function restart(SwimPlayer $swimPlayer): void
  {
    $this->teleportToArena($swimPlayer);
    InventoryUtil::midfKit($swimPlayer);
    $this->ffaNameTag($swimPlayer);

    // enable 3rd party protection
    $logger = $swimPlayer->getCombatLogger();
    $logger->setIsProtected(!$this->interruptAllowed);
    $logger->setCoolDownTime(5);
    $logger->setUsingCombatCoolDown(!$this->interruptAllowed);

    $swimPlayer->setGamemode(GameMode::ADVENTURE);
  }

  protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void
  {
    $this->killMessage($attacker, $victim);
    $attacker->setHealth($attacker->getMaxHealth());
  }

  protected function playerHit(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void
  {
    // apply no critical custom damage
    CustomDamage::customDamageHandle($event);
  }

  /**
   * @throws ScoreFactoryException
   */
  public function updateSecond(): void
  {
    parent::updateSecond();

    foreach ($this->players as $player) {
      if (!$player->isOnline()) continue; // maybe a fix
      $this->ffaScoreboard($player);
      $this->ffaScoreTag($player);
    }
  }

}