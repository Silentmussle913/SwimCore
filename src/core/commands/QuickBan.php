<?php

namespace core\commands;

use core\SwimCore;
use core\systems\player\components\detections\Detection;
use core\systems\player\SwimPlayer;
use core\systems\scene\SceneSystem;
use core\utils\cordhook\CordHook;
use core\utils\TargetArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class QuickBan extends BaseCommand
{

  private SwimCore $core;
  private SceneSystem $sceneSystem;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "quickban", "quick bans a player permanently, intended for use on hackers", ["qb", "ban"]);
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
    $plr = $args["player"];
    $player = null;
    if (isset($plr)) {
      $player = SeeNick::getPlayerFromNick($plr);
    }

    if (!isset($player) && !($player instanceof SwimPlayer)) {
      $sender->sendMessage(TextFormat::RED . "Player not found");
      return;
    }

    $name = "Console";
    if ($sender instanceof SwimPlayer) {
      $name = $sender->getName();
      $rank = $player->getRank()?->getRankLevel() ?? 0;
      if ($sender->getRank()->getRankLevel() <= $rank) {
        $sender->sendMessage(TextFormat::RED . "You can not ban this player");
        return;
      }
    }

    CordHook::sendEmbed($name . " Quick Banned " . $player->getName(), "Staff Quick Ban");
    Detection::BanPlayer($player, $this->core);
  }

  public function getPermission(): ?string
  {
    return "use.staff";
  }

}