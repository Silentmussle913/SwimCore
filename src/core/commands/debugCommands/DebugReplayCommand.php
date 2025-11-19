<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\systems\scene\replay\ReplaySelectionDebugUI;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class DebugReplayCommand extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("debugreplay", "debug replays");
    $this->core = $core;
    $this->setPermission("use.staff");
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      if ($sender->getRank()?->getRankLevel() ?? 0 >= Rank::OWNER_RANK) {
        ReplaySelectionDebugUI::replaySelectionDebugUI($sender);
      } else {
        $sender->sendMessage(TextFormat::RED . "You cant use this lil bro");
      }
    }
  }

}