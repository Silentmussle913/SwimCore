<?php

namespace core\commands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\args\RawStringArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\console\ConsoleCommandSender;
use pocketmine\Server;

class TebexRank extends BaseCommand
{

  private SwimCore $core;
  private Server $server;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->server = $this->core->getServer();
    $this->setPermission("use.op");
    parent::__construct($core, "tebexrank");
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
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if (!($sender instanceof ConsoleCommandSender)) return; // console only

    // $user = $args["username"];
    $packageName = $args["packageName"];
    $xuid = $args["id"];
    // $price = $args["price"];

    $rankLevel = Rank::getRankLevelFromPackageName($packageName);

    // TebexAlert sets their rank to something temporary if they are online, this commands single job is to update the rank in the database, as its only ran on the hub server
    Rank::attemptRankUpgrade($xuid, $rankLevel);
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }

}