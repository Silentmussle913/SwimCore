<?php

namespace core\forms\hub;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormServerSelector
{


  public static function serverSelectorForm(SwimPlayer $player, SwimCore $core): void
  {
    $regions = $core->getCommunicator()->getOtherRegions();
    $form = new SimpleForm(function (SwimPlayer $player, $data) use($regions) {
      if ($data === null) {
        return;
      }

      $region = array_values(array: $regions)[$data] ?? null;

      if (isset($region)) {
        $player->sendMessage(TextFormat::GREEN . "Joining " . TextFormat::YELLOW . $region->displayName);
        $player->transfer($region->ip, $region->port);
      }
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Select Server Region");

    foreach ($regions as $key => $region) {
      $players = $core->getCommunicator()->getRegionPlayers($key);
      $form->addButton(TextFormat::DARK_GREEN . $region->displayName . " | " . TextFormat::AQUA . (isset($players) ? count($players) : TextFormat::RED . "Offline"));
    }

    $player->sendForm($form);
  }
}