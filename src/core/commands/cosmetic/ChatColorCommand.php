<?php

namespace core\commands\cosmetic;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\utils\ArrayEnumArgument;
use core\utils\Colors;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ChatColorCommand extends BaseCommand
{

  private SwimCore $swimCore;

  public function __construct(SwimCore $swimCore)
  {
    $this->swimCore = $swimCore;
    $this->setPermission("use.all");
    $this->setUsage("if you wish to reset your chat color, simply only run /chatcolor with no arguments afterwards");
    parent::__construct($swimCore, "chatcolor", "Set chat color (VIP Rank+) | Run only /chatcolor with no arguments after to reset it");
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new ArrayEnumArgument("color", array_keys(Colors::COLOR_LIST), true));
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
        if (!isset($args["color"])) {
          $sender->getCosmetics()->setChatFormat("");
          $sender->sendMessage(TextFormat::GRAY . "Chat color reset to default");
          return;
        }

        $chatColor = $args["color"];
        self::handleChatColor($sender, $chatColor);
      } else {
        $sender->sendMessage(TextFormat::YELLOW . "You need VIP or MVP Rank to use this: " . TextFormat::AQUA . "swim.tebex.io");
      }
    }
  }

  public static function chatColorForm(SwimPlayer $SwimPlayer): void
  {
    $colors = array_keys(Colors::COLOR_LIST);
    $form = new CustomForm(function (SwimPlayer $player, $data) use ($colors) {
      if ($data === null) return;

      if (!isset($data[0])) return;

      // update the chat color
      $message = $colors[$data[0]] ?? "";
      self::handleChatColor($player, $message);
    });

    $form->setTitle("Set Chat Color");
    $previous = $SwimPlayer->getCosmetics()->getChatFormat();
    $form->addDropdown("Color", array_map(function ($color) {
      return Colors::handleMessageColor($color, str_replace("_", " ", ucfirst($color)));
    }, $colors), array_search($previous, $colors));
    $SwimPlayer->sendForm($form);
  }

  private static function handleChatColor(SwimPlayer $sender, string $color): void
  {
    //check if color exist, if not list all the colors to them
    if (array_key_exists($color, Colors::COLOR_LIST)) {
      $sender->getCosmetics()->setChatFormat($color);
      $sender->sendMessage(TextFormat::GRAY . "Set your chat color to: " . $color);
    } else {
      $sender->sendMessage(TextFormat::RED . "Color input is invalid");
      $colorList = "";
      foreach (Colors::COLOR_LIST as $colorName => $colorPrefix) {
        if ($colorName == "chroma") {
          $newPrefix = Colors::colorize(Colors::CHROMA, $colorName);
          $colorList .= $newPrefix . "\n";
        } else {
          $colorList .= $colorPrefix . $colorName . "\n";
        }

      }
      $sender->sendMessage(TextFormat::GRAY . "Here are the list of colors: " . $colorList);
    }
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }


}