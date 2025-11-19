<?php

namespace core\commands;

use core\scenes\PvP;
use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\systems\scene\SceneSystem;
use core\utils\TargetArgument;
use CortexPE\Commando\args\FloatArgument;
use CortexPE\Commando\args\TextArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;

class AcceptSceneJoinCommand extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "ok", "accept a player to join");
    $this->setPermission("use.all");
    $this->setAliases(["ok", "accept"]);
    $this->setUsage("ok <player>");
    $this->core = $core;
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new TargetArgument("player"));
  }

  /**
   * @inheritDoc
   * @throws ScoreFactoryException
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $scene = $sender->getSceneHelper()->getScene();
      // Currently only for pvp scenes
      if ($scene instanceof PvP) {
        $plr = SeeNick::getPlayerFromNick($args["player"]);
        if ($plr instanceof SwimPlayer && $plr->isOnline()) {
          $rm = $scene->getJoinRequestManager();
          if ($rm->hasSentJoinRequest($plr)) {
            $rm->acceptedJoinRequest($plr, $sender); // handles all the logic from here
          } else {
            $sender->sendMessage(TextFormat::RED . "This player has not requested to join.");
          }
        } else {
          $sender->sendMessage(TextFormat::RED . "Could not locate player.");
        }
      } else {
        $sender->sendMessage(TextFormat::RED . "You can not use this now!");
      }
    }
  }

  public function getPermission(): string
  {
    return "use.all";
  }

}