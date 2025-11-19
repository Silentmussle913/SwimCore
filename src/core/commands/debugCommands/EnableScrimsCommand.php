<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class EnableScrimsCommand extends Command
{

  private SwimCore $core;

  public static bool $scrimsEnabled = true;

  public function __construct(SwimCore $core)
  {
    parent::__construct("enablescrims", "toggle scrims on");
    $this->core = $core;
    $this->setPermission("use.staff");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank == Rank::OWNER_RANK) {
        self::$scrimsEnabled = !self::$scrimsEnabled;
        $str = self::$scrimsEnabled ? "true" : "false";
        $sender->sendMessage(TextFormat::GREEN . "Scrims enabled toggled to " . TextFormat::YELLOW . $str);
      } else {
        $sender->sendMessage(TextFormat::RED . "You can not use this");
      }
    }
    return true;
  }

}