<?php

namespace core\commands;

use core\forms\hub\FormSettings;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class SettingsCommand extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("settings", "Open settings menu");
    $this->core = $core;
    $this->setPermission("use.all");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      if (SwimCore::$DEBUG || $sender->isInScene("Hub")) {
        FormSettings::settingsForm($sender);
      } else {
        $sender->sendMessage(TextFormat::RED . "You must be in the hub to use this!");
      }
    }

    return true;
  }

}
