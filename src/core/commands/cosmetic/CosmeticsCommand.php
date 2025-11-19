<?php

namespace core\commands\cosmetic;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\BaseCommand;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class CosmeticsCommand extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->setPermission("use.all");
    parent::__construct($core, "cosmetics");
  }

  /**
   * @inheritDoc
   */
  protected function prepare(): void
  {
    // nop
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {

      if (!$sender->isInScene("Hub")) {
        $sender->sendMessage(TextFormat::RED . "You must be in the hub to use this!");
        return;
      }

      $rank = $sender->getRank()->getRankLevel();
      if ($rank >= Rank::VIP) {
        self::cosmeticsForm($sender);
      } else {
        $sender->sendMessage(TextFormat::YELLOW . "You need VIP or MVP Rank to use this: " . TextFormat::AQUA . "swim.tebex.io");
      }
    }
  }

  public static function cosmeticsForm(SwimPlayer $swimPlayer): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, $data) {
      if ($data === null) {
        return;
      }

      switch ($data) {
        case 0:
          TagCommand::tagForm($player);
          break;
        case 1:
          KillMessageCommand::setKillMessage($player);
          break;
        case 2:
          ChatColorCommand::chatColorForm($player);
          break;
        case 3:
          ParticleTrailCommand::particleTrailForm($player);
          break;
        //case 4:
        //self::soundEffectForm($player);
        //break;
      }
    });

    $form->setTitle(TextFormat::AQUA . "Cosmetics Menu");
    $form->addButton("Edit Tag", 0, "textures/items/name_tag");
    $form->addButton("Edit Kill Message", 0, "textures/items/diamond_sword");
    $form->addButton("Edit Chat Color", 0, "textures/items/book_enchanted");
    $form->addButton("Particle Trail", 0, "textures/items/blaze_powder");
    // $form->addButton("Kill Sound Effect", 0, "textures/items/record_cat");
    $swimPlayer->sendForm($form);
  }

  public static function checkInappropriateCosmetic(string $in): bool
  {
    $in = strtolower(TextFormat::clean($in));
    $bad = ["nigg", "niqq", "n1gg", "nlgg", "n1qq", "nlqq"];
    return array_any($bad, fn($i) => str_contains($in, $i));
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}