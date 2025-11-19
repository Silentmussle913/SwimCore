<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ToggleRanked extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("ranked", "toggle ranked");
    $this->core = $core;
    $this->setPermission("use.op");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank == Rank::OWNER_RANK) {
        SwimCore::$RANKED = !SwimCore::$RANKED;
        $str = SwimCore::$RANKED ? "true" : "false";
        $sender->sendMessage(TextFormat::GREEN . "Ranked toggled to " . $str);
      } else {
        $sender->sendMessage(TextFormat::RED . "You can not use this");
      }
    }
    return true;
  }

}