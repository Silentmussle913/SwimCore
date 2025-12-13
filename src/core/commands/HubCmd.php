<?php

namespace core\commands;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class HubCmd extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("hub", "Teleport to hub!", null, ["ff", "spawn", "die"]);
    $this->core = $core;
    $this->setPermission("use.all");
  }

  /**
   * @throws ScoreFactoryException
   */
  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      return self::goHub($sender);
    }

    return true;
  }

  /**
   * @throws ScoreFactoryException
   */
  public static function goHub(SwimPlayer $player, bool $careAboutCombatCheck = true): bool
  {
    $sh = $player->getSceneHelper();

    // trolled
    if ($careAboutCombatCheck && $player->getCombatLogger()->isInCombat()) {
      $player->sendMessage(TextFormat::RED . "Hubbing while in combat is for pussies!");
      return false;
    }

    // party check
    if ($sh->isInParty()) {
      $party = $sh->getParty();
      $party->removePlayerFromParty($player);
      $party->partyMessage(TextFormat::YELLOW . $player->getNicks()->getNick() . TextFormat::GREEN . " Left the Party");
      $player->sendMessage(TextFormat::YELLOW . "Hubbing made you leave your party, if you were the only player in the party it is now disbanded");
    }

    // event check
    $event = $sh->getEvent();
    if ($event) {
      $player->sendMessage(TextFormat::YELLOW . "Hubbing made you leave the event!");
      $event->removePlayer($player);
      $event->removeMessage($player);
    }

    // set the scene to Hub
    $sh->setNewScene('Hub');
    $player->sendMessage("§7Teleporting to hub...");

    return true;
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}