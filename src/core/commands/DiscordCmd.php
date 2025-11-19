<?php

namespace core\commands;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\utils\ArrayEnumArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use pocketmine\command\CommandSender;

class DiscordCmd extends BaseCommand {
     private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "discord", "Link to Discord account");
    $this->core = $core;
    $this->setPermission("use.all");
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new ArrayEnumArgument("action", ["accept", "deny", "remove", "check"]));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if (!$sender instanceof SwimPlayer) return;
    switch ($args["action"]) {
        case "accept":
            $sender->getLinkHandler()->onLinkAccepted();
            break;
        case "deny":
            $sender->getLinkHandler()->onLinkDenied();
            break;
        case "remove":
            $sender->getLinkHandler()->onLinkRemoved();
            break;
        case "check":
          $sender->getLinkHandler()->checkLink();
          break;
    }
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}