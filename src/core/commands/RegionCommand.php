<?php

namespace core\commands;

use core\forms\hub\FormServerSelector;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class RegionCommand extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("region", "Choose a new region", null, ["regions", "server", "servers", "na", "eu"]);
    $this->core = $core;
    $this->setPermission("use.all");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      if ($sender->isInScene(sceneName: "Hub")) {
        FormServerSelector::serverSelectorForm($sender, $this->core);
      } else {
        $sender->sendMessage(TextFormat::RED . "You must be in the hub to use this!");
      }
    }

    return true;
  }

}
