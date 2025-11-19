<?php

namespace core\commands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\args\BooleanArgument;
use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat as TF;

class TebexAlert extends BaseCommand
{

  private SwimCore $core;
  private Server $server;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->server = $this->core->getServer();
    $this->setPermission("use.op");
    parent::__construct($core, "tebexalert");
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new RawStringArgument("username"));
    $this->registerArgument(1, new RawStringArgument("packageName"));
    $this->registerArgument(2, new RawStringArgument("price"));
    $this->registerArgument(3, new RawStringArgument("id"));
    $this->registerArgument(4, new BooleanArgument("isRank"));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if (!($sender instanceof ConsoleCommandSender)) return; // console only

    $user = $args["username"];
    $packageName = $args["packageName"];
    // $xuid = $args["id"];
    $price = $args["price"];

    // alert the server with a message that they bought this package
    $alert = TF::DARK_GRAY . "[" . TF::RED . "ALERT" . TF::DARK_GRAY . "] " . TF::RESET;
    $message = TF::AQUA . $user . TF::LIGHT_PURPLE . " Purchased " . TF::GREEN . $packageName . TF::DARK_GRAY . " (" . TF::GREEN . "$" . $price . TF::DARK_GRAY . ")";
    $site = TF::DARK_GRAY . " | " . TF::AQUA . "swim.tebex.io";
    $this->server->broadcastMessage($alert . $message . $site);

    // if this was a rank purchase and the player is online, set the players rank just for this session, as TebexRank command already updated it in the database
    if ($args["isRank"]) {
      $player = SeeNick::getPlayerFromNick($user);
      if (isset($player) && $player instanceof SwimPlayer) {
        $rank = $player->getRank();
        if (isset($rank)) {
          $level = Rank::getRankLevelFromPackageName($packageName);
          if ($level > $rank->getRankLevel()) { // only do it if it's an upgrade
            $rank->setOnlinePlayerRank($level);
          }
        }
      }
    }
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }

}