<?php

namespace core\forms\hub;

use core\scenes\ffas\FFA;
use core\SwimCoreInstance;
use core\systems\player\SwimPlayer;
use core\utils\loaders\WorldLoader;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormFFA
{

  /**
   * Displays a selection form for FFA arenas to a player.
   * @param SwimPlayer $player The player to display the form to.
   */
  public static function ffaSelectionForm(SwimPlayer $player): void
  {
    $sceneSystem = SwimCoreInstance::getInstance()->getSystemManager()->getSceneSystem();
    $scenes = $sceneSystem->getScenes();

    // Collect eligible FFA scenes
    $buttons = [];
    foreach ($scenes as $scene) {
      if ($scene instanceof FFA && $scene::AutoLoad() && isset($scene->info)) {
        if ($scene->info->enabled) {
          $buttons[] = $scene;
        }
      }
    }

    // Sort by preferredSlot (ascending). If missing/invalid, push to the end.
    // Tie-breaker: decoratedName (A–Z) for stable UX.
    usort($buttons, static function ($a, $b): int {
      $aSlot = isset($a->info->preferredSlot) && is_numeric($a->info->preferredSlot) ? (int)$a->info->preferredSlot : PHP_INT_MAX;
      $bSlot = isset($b->info->preferredSlot) && is_numeric($b->info->preferredSlot) ? (int)$b->info->preferredSlot : PHP_INT_MAX;

      if ($aSlot !== $bSlot) {
        return $aSlot <=> $bSlot;
      }

      $aName = $a->info->decoratedName ?? '';
      $bName = $b->info->decoratedName ?? '';

      return strcasecmp($aName, $bName);
    });

    // Build the form after sorting so indexes line up with button order.
    $form = new SimpleForm(function (SwimPlayer $player, $data) use (&$buttons) {
      // $data is the index of the clicked button
      if ($data === null) {
        return; // Player closed the form
      }
      // Guard against unexpected index
      if (!isset($buttons[$data]?->info?->sceneName)) {
        echo("Data is " . $data . "\n");
        return;
      }

      $player->getSceneHelper()?->setNewScene($buttons[$data]->info->sceneName);
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Select FFA Arena");

    // Add buttons in the sorted order
    foreach ($buttons as $button) {
      $info = $button->info;

      $worldName = $info->worldFolderName ?? '';
      $playerCount = WorldLoader::getWorldPlayerCount($worldName);
      if (!is_numeric($playerCount)) {
        $playerCount = 0; // fallback
      }

      $label = ($info->decoratedName ?? 'Unknown') . " §8[§a" . $playerCount . "§8]";

      $icon = $button::getIcon();
      $form->addButton($label, 0, $icon);
    }

    $player->sendForm($form);
  }

}
