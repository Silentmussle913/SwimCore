<?php

namespace core\commands\debugCommands;

use core\scenes\duel\Duel;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\utils\TextFormat;

class TestCmd extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("test", "Test");
    $this->core = $core;
    $this->setPermission("use.op");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer && $sender->hasPermission(DefaultPermissions::ROOT_OPERATOR)) {
      $sender->sendMessage(TextFormat::GREEN . "Running test command code");

      $scene = $sender->getSceneHelper()?->getScene();
      if ($scene instanceof Duel) $scene->dumpDuel();
    }
    return true;
  }

}