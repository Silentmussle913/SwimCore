<?php

namespace core\commands;

use core\forms\parties\FormPartyCreate;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\SwimCoreInstance;
use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class PartyCommand extends BaseCommand
{

  private SwimCore $core;
  public static bool $disableOnHub = true;


  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->setPermission("use.all");
    parent::__construct($core, "party", "opens the party menu");
  }

  /**
   * @inheritDoc
   */
  protected function prepare(): void
  {
    // TODO: Implement prepare() method.
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      if ($sender->isInScene("Hub") && !$sender->getSceneHelper()?->isInParty()) {
        FormPartyCreate::partyBaseForm(SwimCoreInstance::getInstance(), $sender);
      } else {
        $sender->sendMessage(TextFormat::RED . "You must be in the hub and not in a party to start a party!");
      }
    }
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}
