<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\BaseCommand;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ShopWarsToggler extends BaseCommand
{

  private SwimCore $core;
  public static bool $SHOP_WARS_ENABLED = true;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "shoptoggler", "toggle shopwars being enabled or not");
    $this->setPermission("use.staff");
    $this->core = $core;
  }

  protected function prepare(): void
  {
  }

  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank == Rank::OWNER_RANK) {
        self::$SHOP_WARS_ENABLED = !self::$SHOP_WARS_ENABLED;
        $sender->sendMessage(TextFormat::GREEN . "Shop Wars Enabled set to: " . (self::$SHOP_WARS_ENABLED ? "true" : "false"));
      } else {
        $sender->sendMessage(TextFormat::RED . "You can not use this");
      }
    }
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }

}