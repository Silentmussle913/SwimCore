<?php

namespace core\commands;

use core\forms\hub\FormSpectate;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class SpectateCommand extends Command
{

  private SwimCore $core;
  public static bool $disableOnHub = true;


  public function __construct(SwimCore $core)
  {
    parent::__construct("spectate", "Open the spectate form");
    $this->core = $core;
    $this->setPermission("use.all");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      if ($sender->isInScene("Hub")) {
        FormSpectate::spectateSelectionForm($this->core, $sender);
      } else {
        $sender->sendMessage(TextFormat::RED . "You must be in the hub to use this!");
      }
    }

    return true;
  }

}