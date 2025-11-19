<?php

namespace core\forms\hub;

use core\systems\player\SwimPlayer;
use core\utils\TimeHelper;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormSettings
{

  public static function settingsForm(SwimPlayer $swimPlayer): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, $data) {
      if ($data === null) {
        return;
      } else if ($data == 0) { // clicked button 0
        self::regularSettings($player);
      } else if ($data == 1) { // clicked button 1
        self::scrimSettings($player);
      }
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Select Settings to Modify");
    $form->addButton(TextFormat::DARK_GREEN . "Default Settings", 0, "textures/items/book_normal");
    $form->addButton(TextFormat::DARK_AQUA . "Scrim Settings");

    $swimPlayer->sendForm($form);
  }

  public static function regularSettings(SwimPlayer $swimPlayer): void
  {
    // get toggle settings
    $settings = $swimPlayer->getSettings();
    $toggles = $settings->getToggles();

    $form = new CustomForm(function (SwimPlayer $swimPlayer, array $data = null) use ($settings) {
      if ($data !== null) {

        // bool settings
        $index = -1;
        $settings->setToggle('showCPS', $data[++$index]);
        $settings->setToggle('nhc', $data[++$index]);
        $settings->setToggle('sprint', $data[++$index]);
        $settings->setToggle('showScoreboard', $data[++$index]);
        $settings->setToggle('fullBright', $data[++$index]);
        $settings->setToggle('dc', $data[++$index]);
        $settings->setToggle('duelInvites', $data[++$index]);
        $settings->setToggle('partyInvites', $data[++$index]);
        $settings->setToggle('showCords', $data[++$index]);
        $settings->setToggle('showScoreTags', $data[++$index]);
        $settings->setToggle('msg', $data[++$index]);
        $settings->setToggle('pearl', $data[++$index]);

        // day time is special because it is a dropdown of options
        $time = TimeHelper::timeIndexToRaw($data[++$index]);
        $settings->setToggleInt('personalTime', $time);

        $settings->updateSettings();
        $swimPlayer->sendMessage("§aSaved Settings");
      }
      return true;
    });

    $form->setTitle(TextFormat::DARK_GREEN . $swimPlayer->getName() . "'s Settings");

    // bool settings
    $form->addToggle("CPS Counter", $toggles['showCPS']);
    $form->addToggle("No hurt cam (camera shake must be enabled)", $toggles['nhc']);
    $form->addToggle("Auto Sprint", $toggles['sprint']);
    $form->addToggle("Show Scoreboard", $toggles['showScoreboard']);
    $form->addToggle("Full Bright (night vision)", $toggles['fullBright']);
    $form->addToggle("DC Prevent", $toggles['dc']);
    $form->addToggle("Allow Duel Requests", $toggles['duelInvites']);
    $form->addToggle("Allow Party Invites", $toggles['partyInvites']);
    $form->addToggle("Show Coordinates", $toggles['showCords']);
    $form->addToggle("Show Score Tags", $toggles['showScoreTags']);
    $form->addToggle("Allow Messages", $toggles['msg']);
    $form->addToggle("Animated Pearl TP", $toggles['pearl']);

    // misc
    $form->addDropdown("Personal Time", ["sunrise", "day", "noon", "sunset", "midnight"], TimeHelper::getTimeIndex($toggles['personalTime']));

    $swimPlayer->sendForm($form);
  }

  public static function scrimSettings(SwimPlayer $swimPlayer): void
  {
    // get toggle settings
    $settings = $swimPlayer->getSettings();
    $toggles = $settings->getToggles();

    $form = new CustomForm(function (SwimPlayer $swimPlayer, array $data = null) use ($settings) {
      if ($data !== null) {

        $index = -1;

        $shopType = $data[++$index];
        $scrimRole = $data[++$index];

        $settings->setToggleInt("shopType", $shopType);
        $settings->setToggleInt("scrimRole", $scrimRole);

        $settings->updateSettings();
        $swimPlayer->sendMessage("§aSaved Scrim Settings");
      }
      return true;
    });

    $form->setTitle(TextFormat::DARK_GREEN . $swimPlayer->getName() . "'s Scrim Settings");

    $form->addDropdown("Shop Type", ["Classic Form UI", "Single Chest UI"], $toggles['shopType']);
    $form->addDropdown("Scrim Role", ["Banker", "Staller", "Rusher", "Bower", "Any"], $toggles['scrimRole']);

    $swimPlayer->sendForm($form);
  }

}