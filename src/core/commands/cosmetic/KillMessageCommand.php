<?php

namespace core\commands\cosmetic;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\BaseCommand;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class KillMessageCommand extends BaseCommand
{

  private SwimCore $swimCore;

  public function __construct(SwimCore $swimCore)
  {
    $this->swimCore = $swimCore;
    $this->setPermission("use.all");
    $this->setUsage("opens a text ui to set the kill message (VIP+ Rank Required)");
    parent::__construct($swimCore, "killmessage", "opens a text ui to set the kill message (VIP+ Rank Required)");
  }

  protected function prepare(): void
  {
    // no op
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank >= Rank::VIP) {
        if ($sender->isInScene("Hub")) {
          self::setKillMessage($sender);
        } else {
          $sender->sendMessage(TextFormat::RED . "You must be in the hub!");
        }
      } else {
        $sender->sendMessage(TextFormat::YELLOW . "You need VIP or MVP Rank to use this: " . TextFormat::AQUA . "swim.tebex.io");
      }
    }
  }

  public static function setKillMessage(SwimPlayer $divinityPlayer): void
  {
    $form = new CustomForm(function (SwimPlayer $player, $data) {
      if ($data === null) return;

      if (!isset($data[0])) return;
      $banned = ["\n", "§k"];

      // update the players kill message
      $message = str_replace($banned, "", $data[0]);
      $length = strlen($message);

      // length check
      if ($length >= 100) {
        $player->sendMessage(TextFormat::RED . "Your kill message is over 100 letters! " . TextFormat::YELLOW . "(" . $length . ")");
        return;
      }

      // format check
      if (!(str_contains($message, "{you}") && str_contains($message, "{other}"))) {
        $player->sendMessage(TextFormat::RED . "Your kill message must be formatted like: " . TextFormat::GRAY . "{you} killed {other}");
        return;
      }

      if (CosmeticsCommand::checkInappropriateCosmetic($message)) {
        $player->sendMessage(TextFormat::RED . "Inappropriate kill message detected");
        return;
      }

      $player->getCosmetics()->setKillMessage($message);

      $player->sendMessage(TextFormat::GREEN . "Set your kill message to: " . TextFormat::GRAY . $message);
    });

    $form->setTitle("Set a Kill Message");
    $previous = $divinityPlayer->getCosmetics()->getKillMessage();
    $form->addInput("Must be formatted using {you} and {other} for the name inputs:", $previous, $previous);
    $divinityPlayer->sendForm($form);
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}