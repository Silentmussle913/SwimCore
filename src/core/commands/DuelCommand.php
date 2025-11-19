<?php

namespace core\commands;

use core\scenes\duel\Duel;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\utils\ArrayEnumArgument;
use core\utils\TargetArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat as TF;

class DuelCommand extends BaseCommand
{

  public static bool $disableOnHub = true;

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;

    $this->setPermission("use.all");
    parent::__construct($core, "duel", "send a duel");
  }

  /**
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new TargetArgument("player", false));

    $args = array_keys(Duel::$MODES);

    // remove unwanted modes by value
    $args = array_values(array_diff($args, ["scrim", "scrims", "block in practice", "blockin practice"]));

    $this->registerArgument(1, new ArrayEnumArgument("mode", $args));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if (!$sender instanceof SwimPlayer) return;

    if (!$sender->isInScene("Hub") && $sender->getSceneHelper()?->isInParty()) {
      $sender->sendMessage(TF::RED . "You must be in the Hub out of a party and not queued to use this!");
      return;
    }

    if (!isset($args["player"]) || !isset($args["mode"])) {
      $sender->sendMessage(TF::RED . "Usage: /duel <player> <mode>");
      return;
    }

    if ($args["player"] === $sender->getName() || $args["player"] === $sender->getNicks()->getNick()) {
      $sender->sendMessage(TF::RED . "You can not duel your self!");
      return;
    }

    $keys = array_keys(Duel::$MODES);

    if (!in_array($args["mode"], $keys)) {
      $sender->sendMessage(TF::RED . "Invalid Mode passed, Available Games: " . implode(", ", $keys));
      return;
    }

    $targetPlayer = SeeNick::getPlayerFromNick($args["player"]);
    if (!($targetPlayer instanceof SwimPlayer)) {
      $sender->sendMessage(TF::RED . "Could not find player " . $args["player"]);
      return;
    }

    if ($targetPlayer === $sender) {
      $sender->sendMessage(TF::RED . "You can not duel your self!");
      return;
    }

    if ($targetPlayer->isInScene("Hub")) {
      $targetPlayer->getInvites()?->duelInvitePlayer($sender, $args["mode"]);
    } else {
      $sender->sendMessage(TF::RED . "Player must be in the Hub out of a party and not queued to use this!");
    }
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}