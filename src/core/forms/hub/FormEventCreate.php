<?php

namespace core\forms\hub;

use core\SwimCore;
use core\systems\event\EventSystem;
use core\systems\event\ServerGameEvent;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use jojoe77777\FormAPI\CustomForm;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormEventCreate
{

  public static function eventBaseForm(SwimCore $core, SwimPlayer $player): void
  {
    $eventSystem = $core->getSystemManager()->getEventSystem();

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($eventSystem, $core) {
      if ($data === null) {
        return; // Player closed the form
      }

      if ($data == 0) {
        // rank requirements are subject to change
        if ($player->getRank()->getRankLevel() < Rank::BOOSTER_RANK) { // was media rank, but we are loosening the requirements (for now)
          $player->sendMessage(
            TextFormat::YELLOW . "You need to buy a rank to Host Events! " . TextFormat::DARK_GRAY . " | " . TextFormat::AQUA . "swim.tebex.io"
          );
        } else {
          self::createEventsForm($player, $core, $eventSystem);
        }
      } elseif ($data == 1) {
        self::joinEventsForm($player, $core);
      }
    });

    $form->setTitle(TextFormat::DARK_AQUA . "Events");

    $form->addButton(TextFormat::AQUA . "Create Event");
    $form->addButton(TextFormat::DARK_GREEN . "Join Events " . TextFormat::DARK_GRAY
      . "(" . TextFormat::YELLOW . $eventSystem->getInQueueEventsCount() . TextFormat::DARK_GRAY . ")");

    $player->sendForm($form);
  }

  private static function joinEventsForm(SwimPlayer $swimPlayer, SwimCore $core): void
  {
    $buttons = [];

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, &$buttons) {
      if ($data === null) return;

      $eventNames = array_keys($buttons);
      if (!isset($eventNames[$data])) return;
      $eventName = $eventNames[$data];
      if (!isset($buttons[$eventName])) return;
      $event = $buttons[$eventName];

      if ($event instanceof ServerGameEvent) {
        if (!$event->isStarted() && !$event->isBlocked($player) && $event->canAdd()) {
          $event->addPlayer($player);
          $event->joinMessage($player);
          $sh = $player->getSceneHelper();
          $sh->setNewScene("EventQueue");
        } else {
          $player->sendMessage(TextFormat::RED . "Event no longer available to join (either started, full, or you are blocked from joining)");
        }
      }
    });

    // add the non started events to the buttons
    foreach ($core->getSystemManager()->getEventSystem()->getInQueueEvents() as $eventName => $event) {
      if ($event instanceof ServerGameEvent && !$event->isStarted()) {
        $playerCount = $event->formatPlayerCount();
        $timeToStart = $event->formatTimeToStart();
        $buttons[$eventName] = $event;
        $form->addButton(
          $eventName . TextFormat::DARK_GRAY . " | " . $playerCount . TextFormat::DARK_GRAY . " | " . TextFormat::YELLOW . $timeToStart
        );
      }
    }

    $form->setTitle(TextFormat::AQUA . "Events Available to Join");

    $swimPlayer->sendForm($form);
  }

  private static function createEventsForm(SwimPlayer $swimPlayer, SwimCore $core, EventSystem $eventSystem): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($eventSystem, $core) {
      if ($data === null) {
        return; // Player closed the form
      }

      // first mode index 0 is modded sg
      /*
      if ($data == 0) {
        self::SGForm($player, $core, $eventSystem, false);
      } else if ($data == 1) {
        self::SGForm($player, $core, $eventSystem, true);
      }
      */
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Create an Event");
    $form->addButton(TextFormat::AQUA . "Tournament SG");
    $form->addButton(TextFormat::LIGHT_PURPLE . "Modded SG");

    $swimPlayer->sendForm($form);
  }

  /* some example code for how to make an event
  private static function SGForm(SwimPlayer $swimPlayer, SwimCore $core, EventSystem $eventSystem, bool $isModded): void
  {
    // get the available sg maps we can select from
    // $maps = $core->getSystemManager()->getMapsData()->getAvailableSGMaps();
    $mapsData = $core->getSystemManager()->getMapsData();
    $maps = $mapsData->getMapPool("sg event", false)->getUniqueMapBaseNames();
    if (empty($maps)) {
      $swimPlayer->sendMessage(TextFormat::RED . "Sorry, currently all SG maps are in use");
      return;
    }

    $form = new CustomForm(function (SwimPlayer $player, $data) use ($eventSystem, $mapsData, $core, $isModded, &$maps) {
      if ($data === null) {
        return; // Player closed the form
      }

      // fetch needed data
      $teamSize = $data[0];
      $mapIndex = $data[1]; // returns the index of the array

      // safety check
      if (!isset($maps[$mapIndex])) {
        $player->sendMessage(
          TextFormat::RED . "If you are seeing this, tell Swimfan he has a horrible bug in his survival games event map manager code"
        );
        return;
      }

      $pickedMapName = $maps[$mapIndex]; // use that index to get the map key from maps array
      // echo("SG Event Picked $pickedMapName \n");
      $mapInfo = $mapsData->getFirstInactiveMapByBaseNameFromMode("sg event", $pickedMapName, false);

      if ((!$mapInfo instanceof SurvivalGamesMapInfo)) {
        $player->sendMessage(TextFormat::RED . "Map $pickedMapName is not available currently!");
        return;
      }

      // check if valid and not in use
      if ($mapInfo->mapIsActive()) {
        $player->sendMessage(TextFormat::RED . "Sorry, your selected SG map is currently in use");
        return;
      }

      // make the event
      $str = $isModded ? "Modded SG" : "SG";
      $eventName = $player->getNicks()->getNick() . " | $str";
      if (!$eventSystem->eventNameExists($eventName)) {
        $mapInfo->setActive(true); // remember to mark as active
        $event = new SurvivalGamesEvent(
          $core, $eventSystem, $eventName, $player, $mapInfo->getMapName(), 8, 24, $teamSize
        );
        $event->isModded = $isModded;
        $event->setMapInfo($mapInfo);
        $eventSystem->registerEvent($player, $event);
      } else {
        $player->sendMessage(TextFormat::RED . "Error: event with name '" . TextFormat::YELLOW . $eventName . TextFormat::RED . "' already exists.");
      }
    });

    $form->setTitle(TextFormat::DARK_AQUA . "Configure SG Event");
    $form->addSlider(TextFormat::AQUA . "Team Size", 1, 4);
    $form->addDropdown(TextFormat::DARK_GREEN . "Select Map", $maps, 0);
    $swimPlayer->sendForm($form);
  }
  */

}