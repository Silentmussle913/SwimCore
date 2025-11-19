<?php

namespace core\commands\debugCommands;

use core\custom\prefabs\shopwars\TacticalNuke;
use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;

class NukeTest extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "nuke", "nuke everything");
    $this->setPermission("use.staff");
    $this->core = $core;
  }

  /**
   * @inheritDoc
   */
  protected function prepare(): void
  {
    $this->setPermission("use.staff");
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $level = $sender->getRank()->getRankLevel();
      if ($level == Rank::OWNER_RANK) {
        $sender->registerBehavior(new TacticalNuke("nuke", $this->core, $sender));
      }
    }
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }


}