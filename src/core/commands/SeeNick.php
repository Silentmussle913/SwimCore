<?php

namespace core\commands;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\SwimCoreInstance;
use core\utils\TargetArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class SeeNick extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "seenick", "view a players nick");
    $this->core = $core;
    $this->setPermission("use.staff");
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
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    $player = $args["player"];
    $plr = self::getPlayerFromNick($player);
    if (isset($plr)) {
      $sender->sendMessage($plr->getName() . " is nicked as: " . $player);
    } else {
      $sender->sendMessage(TextFormat::RED . "Could not find player");
    }
  }

  public static function getPlayerFromNick(string $nick): ?SwimPlayer
  {
    $shortCut = Server::getInstance()->getPlayerExact($nick);
    if (isset($shortCut) && $shortCut instanceof SwimPlayer) return $shortCut;

    return array_find(SwimCoreInstance::getInstance()->getSystemManager()->getPlayerSystem()->getPlayers(), fn($plr) => $plr?->getNicks()->getNick() == $nick);
  }

  public function getPermission(): ?string
  {
    return "use.staff";
  }

}