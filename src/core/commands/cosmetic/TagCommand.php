<?php

namespace core\commands\cosmetic;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\args\TextArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class TagCommand extends BaseCommand
{

  private SwimCore $swimCore;

  public function __construct(SwimCore $xenonCore)
  {
    $this->swimCore = $xenonCore;
    $this->setPermission("use.all");
    $this->setUsage("if you wish to reset your tag, simply only run /tag with no arguments afterwards");
    parent::__construct($xenonCore, "tag", "Set a tag (VIP Rank+) | Run only /tag with no arguments after to reset it");
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new TextArgument("tag", true));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank >= Rank::VIP) {

        // hub check
        if (!$sender->isInScene("Hub")) {
          $sender->sendMessage(TextFormat::RED . "You must be in the hub to use this!");
          return;
        }

        // check if resetting by passing no arguments
        if (!isset($args["tag"])) {
          $sender->getCosmetics()->setTag("");
          $sender->sendMessage(TextFormat::GRAY . "Removed your tag");
          return;
        }

        $tag = $args["tag"];
        self::handleTag($sender, $tag);
      } else {
        $sender->sendMessage(TextFormat::YELLOW . "You need VIP or MVP Rank to use this: " . TextFormat::AQUA . "swim.tebex.io");
      }
    }
  }

  public static function tagForm(SwimPlayer $SwimPlayer): void
  {
    $form = new CustomForm(function (SwimPlayer $player, $data) {
      if ($data === null) return;

      if (!isset($data[0])) return;

      // update the tag
      $message = $data[0];
      self::handleTag($player, $message);
    });

    $form->setTitle("Set a Tag");
    $previous = $SwimPlayer->getCosmetics()->getTag();
    $form->addInput("Must be under 20 Letters", $previous, $previous);
    $SwimPlayer->sendForm($form);
  }

  private static function handleTag(SwimPlayer $sender, string $tag): void
  {
    $len = strlen(TextFormat::clean($tag));
    $rawlen = strlen($tag);

    if ($len <= 20 && $rawlen <= 30) {
      if (CosmeticsCommand::checkInappropriateCosmetic($tag)) {
        $sender->sendMessage(TextFormat::RED . "Inappropriate tag detected");
        return;
      }
      $cosmetics = $sender->getCosmetics();
      $cosmetics->setTag($tag);
      $cosmetics->tagNameTag();
      $sender->sendMessage(TextFormat::GRAY . "Set your tag to: " . $tag);
    } else {
      $sender->sendMessage(TextFormat::RED . "Your tag is too long, it is over 10 letters!" . TextFormat::YELLOW . "(" . $len . " letters)");
    }
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}