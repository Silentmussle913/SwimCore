<?php

namespace core\commands\debugCommands;

use core\commands\SeeNick;
use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\utils\TargetArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;

class DumpEvents extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "dumpevent", "dump all event component data to the console");
    $this->setPermission("use.staff");
    $this->core = $core;
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->setPermission("use.staff");
    $this->registerArgument(0, new TargetArgument("player", true));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $level = $sender->getRank()->getRankLevel();
      if ($level == Rank::OWNER_RANK) {

        if (isset($args["player"])) {
          $player = SeeNick::getPlayerFromNick($args["player"]);
        } else {
          $player = $sender;
        }

        $components = $player->getEventBehaviorComponentManager()?->getComponents() ?? [];
        foreach ($components as $component) {
          $component->printProperties();
        }
      }
    }
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }


}