<?php

namespace core\commands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\utils\AcData;
use core\utils\security\LoginProcessor;
use core\utils\TargetArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\utils\TextFormat;

class InfoCommand extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->setPermission("use.staff");
    parent::__construct($core, "info", 'get info of player', ["pinfo"]);
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new TargetArgument("player", false, PHP_INT_MAX));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) { // from staff in game
      $rank = $sender->getRank()->getRankLevel();
      if ($rank >= Rank::MOD_RANK) {
        $this->commandLogic($sender, $args);
      } else {
        $sender->sendMessage(TextFormat::RED . "You do not have permission to use this!");
      }
    } elseif ($sender instanceof ConsoleCommandSender) { // from console
      $this->commandLogic($sender, $args);
    }
  }

  private function commandLogic(CommandSender $sender, array $args): void
  {
    $name = $args["player"];

    $player = SeeNick::getPlayerFromNick($name);
    if (isset($player) && $player instanceof SwimPlayer) {
      $data = $player->getAntiCheatData();
      if (isset($data)) {
        $os = $data->getData(AcData::DEVICE_OS) ?? "Unknown"; // already a string
        $input = $data->getData(AcData::INPUT_MODE);
        $inputString = LoginProcessor::$inputModeMap[$input] ?? "Unknown";
        $version = $player->getPlayerInfo()->getExtraData()["GameVersion"];
        $sender->sendMessage(TextFormat::AQUA . $name . " Info:\nInput: $inputString\nOS: $os\nVersion: $version");
      } else {
        $player->sendMessage(TextFormat::RED . "Error");
      }
    } else { // TODO: offline player info
      $sender->sendMessage(TextFormat::YELLOW . $name . " is not online");
    }
  }

  public function getPermission(): ?string
  {
    return "use.staff";
  }

}