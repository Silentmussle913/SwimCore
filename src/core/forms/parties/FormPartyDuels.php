<?php

namespace core\forms\parties;

use core\commands\debugCommands\EnableScrimsCommand;
use core\forms\hub\FormDuelRequests;
use core\scenes\duel\Boxing;
use core\SwimCore;
use core\SwimCoreInstance;
use core\systems\party\Party;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormPartyDuels
{

  public static function baseForm(SwimCore $core, SwimPlayer $swimPlayer, Party $party): void
  {
    $isLeader = $party->isPartyLeader($swimPlayer);
    if (!$isLeader && !$party->getSetting('membersCanQueue')) {
      $swimPlayer->sendMessage(TextFormat::RED . "You do not have permission to do this!");
      return;
    }

    $form = new SimpleForm(function (SwimPlayer $swimPlayer, $data) use ($core, &$buttons, $party) {
      if ($data === null) return;

      if (!$party->isInDuel()) {
        switch ($data) {

          case 0:
            self::selfPartyDuel($core, $swimPlayer, $party);
            break;

          case 1:

            $override = $swimPlayer->getRank()->getRankLevel() >= Rank::OWNER_RANK;
            $partySize = $party->getCurrentPartySize();
            // if your party has 8 people in it, or we are in debug mode we can start a scrim
            // also owner rank can start whenever
            if (($partySize >= 8) || SwimCore::$DEBUG || $override) {
              self::selectMapForMode($core, $swimPlayer, $party, "scrim", true);
            } else {
              $swimPlayer->sendMessage(TextFormat::YELLOW . "You need 8 players in your party to start a scrim!");
            }
            break;
        }
      }
    });

    $form->setTitle(TextFormat::DARK_PURPLE . "Select Mode");
    $form->addButton(TextFormat::DARK_GREEN . "Duel own Party (Classic)", 0, Boxing::getIcon());
    /*
    if (EnableScrimsCommand::$scrimsEnabled) {
      $form->addButton(TextFormat::DARK_AQUA . "Scrims Beta Test", 0, BedFight::getIcon());
      $form->addButton(TextFormat::DARK_BLUE . "Block in Practice", 0, Blockinpractice::getIcon());
      $form->addButton(TextFormat::DARK_AQUA . "PvP Playground", 0, Playground::getIcon());
    }
    */
    $swimPlayer->sendForm($form);
  }

  private static function selfPartyDuel(SwimCore $core, SwimPlayer $swimPlayer, Party $party): void
  {
    if ($party->getCurrentPartySize() <= 1 && !SwimCore::$DEBUG) {
      $swimPlayer->sendMessage(TextFormat::RED . "You need at least 2 people in the party to start a duel!");
      return;
    }

    $buttons = []; // index -> modeName

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, $party, $swimPlayer, &$buttons) {
      if ($data === null || $party === null) return;

      // still valid?
      if ($party->getCurrentPartySize() <= 1 && !SwimCore::$DEBUG) {
        $player->sendMessage(TextFormat::RED . "You need at least 2 people in the party to start a duel!");
        return;
      }

      $mode = $buttons[$data] ?? null;
      if ($mode === null || $party->isInDuel()) return;

      $rankLevel = $swimPlayer->getRank()->getRankLevel();
      if ($rankLevel > Rank::DEFAULT_RANK) {
        self::selectMapForMode($core, $player, $party, $mode, true);
      } else {
        if ($core->getSystemManager()->getMapsData()->modeHasAvailableMap($mode)) {
          $party->startSelfDuel($mode);
          $player->sendMessage(FormDuelRequests::$adMsg);
        } else {
          $player->sendMessage(TextFormat::RED . "No map is currently available for that mode, try again later");
        }
      }
    });

    $buttons = FormDuelRequests::buildDuelFormWithButtons($form, $buttons, $swimPlayer);
  }

  public static function pickOtherPartyToDuel(SwimCore $core, SwimPlayer $player, Party $party): void
  {
    $isLeader = $party->isPartyLeader($player);
    if (!$isLeader && !$party->getSetting('membersCanDuel')) {
      $player->sendMessage(TextFormat::RED . "You do not have permission to do this!");
      return;
    }

    $buttons = [];

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, &$buttons, $party) {
      if ($data === null) return;

      $partyNames = array_keys($buttons);
      if (!isset($partyNames[$data])) return;
      $partyName = $partyNames[$data];
      if (!isset($buttons[$partyName])) return;
      $otherParty = $buttons[$partyName];

      if ($otherParty instanceof Party) {
        if (!$otherParty->isInDuel() && !$party->isInDuel() && $otherParty->getSetting('allowDuelInvites')) {
          if (EnableScrimsCommand::$scrimsEnabled) {
            self::choosePartyDuelType($core, $player, $party, $otherParty);
          } else {
            self::sendPartyDuelRequest($core, $player, $party, $otherParty);
          }
        } else {
          $player->sendMessage(TextFormat::RED . "Party no longer available to duel");
        }
      }
    });

    // add parties to the buttons
    foreach ($core->getSystemManager()->getPartySystem()->getParties() as $partyName => $p) {
      if ($p instanceof Party) {
        if (!$p->isInDuel() && $p->getSetting('allowDuelInvites') && ($party !== $p /*|| SwimCore::$DEBUG*/)) {
          $buttons[$partyName] = $p;
          // $label = $openJoin ? "Open to Join" : "Request to Join"; // not sure what label even is (sub text?)
          $form->addButton($partyName . TextFormat::GRAY . " | " . $p->formatSize());
        }
      }
    }

    $form->setTitle(TextFormat::LIGHT_PURPLE . "Parties Available to Duel");

    $player->sendForm($form);
  }

  // For determining if we want to send a beta/party games duel, or a regular duel
  private static function choosePartyDuelType(SwimCore $core, SwimPlayer $player, Party $senderParty, Party $otherParty): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, $senderParty, $otherParty) {
      if ($data === null) {
        return;
      }

      if (!$otherParty->isInDuel() && !$senderParty->isInDuel()) {
        if ($data == 0) { // clicked button 0, classic duels
          self::sendPartyDuelRequest($core, $player, $senderParty, $otherParty);
        } else if ($data == 1) { // clicked button 1, scrim duel
          $override = $player->getRank()->getRankLevel() >= Rank::OWNER_RANK;
          $senderPartySize = $senderParty->getCurrentPartySize();
          $otherPartySize = $otherParty->getCurrentPartySize();
          // if both parties have over 4 people in it, or we are in debug mode we can start a scrim
          // also owner rank can start whenever
          if (($senderPartySize >= 4 && $otherPartySize >= 4) || SwimCore::$DEBUG || $override) {
            self::selectMapForMode($core, $player, $senderParty, "scrim", false, $otherParty);
          } else {
            if ($senderPartySize < 4) {
              $player->sendMessage(TextFormat::YELLOW . "Your party needs at least 4 people to start a scrim, you only have {$senderPartySize}!");
            } else if ($otherPartySize < 4) {
              $player->sendMessage(TextFormat::YELLOW . $otherParty->getPartyName()
                . " needs at least 4 people to start a scrim, they only have {$otherPartySize} members!");
            }
          }
        }
      } else {
        $player->sendMessage(TextFormat::RED . "Party no longer available to duel");
      }
    });

    $form->setTitle(TextFormat::GREEN . "Select Duel Type");
    $form->addButton(TextFormat::GREEN . "Classic Duels", 0, Boxing::getIcon());
    // $form->addButton(TextFormat::DARK_AQUA . "Scrims Beta Test", 0, BedFight::getIcon());

    $player->sendForm($form);
  }

  private static function sendPartyDuelRequest(SwimCore $core, SwimPlayer $player, Party $senderParty, Party $otherParty): void
  {
    $buttons = []; // index -> modeName

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, $senderParty, $otherParty, &$buttons) {
      if ($data === null) return;

      $mode = $buttons[$data] ?? null;
      if ($mode === null) return;

      if ($otherParty->isInDuel() || $senderParty->isInDuel()) return;

      $rankLevel = $player->getRank()->getRankLevel();
      if ($rankLevel > Rank::DEFAULT_RANK) {
        self::selectMapForMode($core, $player, $senderParty, $mode, false, $otherParty);
      } else {
        $otherParty->duelInvite($player, $senderParty, $mode);
        $player->sendMessage(FormDuelRequests::$adMsg);
      }
    });

    $buttons = FormDuelRequests::buildDuelFormWithButtons($form, $buttons, $player);
  }

  private static function selectMapForMode
  (
    SwimCore   $core,
    SwimPlayer $player,
    Party      $party,
    string     $mode,
    bool       $isSelfDuel,
    ?Party     $otherParty = null
  ): void
  {
    $mapsData = $core->getSystemManager()->getMapsData();
    $names = FormDuelRequests::collectUniqueMapNames($mapsData, $mode);
    if (empty($names)) {
      $player->sendMessage(TextFormat::RED . "No maps available for this mode.");
      return;
    }

    // Guard again at click time using the callbacks (to avoid stale states)
    $preCheck = function () use ($party, $isSelfDuel, $otherParty): bool {
      if ($party->isInDuel()) return false;
      if (!$isSelfDuel && $otherParty && $otherParty->isInDuel()) return false;
      return true;
    };

    FormDuelRequests::sendMapSelectForm(
      $names,
      // onPick
      function (string $base) use ($core, $player, $party, $mode, $isSelfDuel, $otherParty, $preCheck) {
        if (!$preCheck()) return;

        $selectedMap = $core->getSystemManager()->getMapsData()->getFirstInactiveMapByBaseNameFromMode($mode, $base);
        if ($selectedMap !== null) {
          if ($isSelfDuel) {
            $party->startSelfDuel($mode, $base);
          } else {
            $otherParty?->duelInvite($player, $party, $mode, $base);
          }
        } else {
          $player->sendMessage(TextFormat::RED . "ERROR: Try again later. No available map found for " . $base);
        }
      },
      // onRandom
      function () use ($player, $party, $mode, $isSelfDuel, $otherParty, $preCheck) {
        if (!$preCheck()) return;

        if ($isSelfDuel) {
          $party->startSelfDuel($mode); // random
        } else {
          $otherParty?->duelInvite($player, $party, $mode); // random
        }
      },
      $player
    );
  }

  public static function acceptPartyDuelRequests(SwimPlayer $player, Party $party): void
  {
    $isLeader = $party->isPartyLeader($player);
    if (!$isLeader && !$party->getSetting('membersCanAcceptDuel')) {
      $player->sendMessage(TextFormat::RED . "You do not have permission to do this!");
      return;
    }

    $buttons = [];

    $form = new SimpleForm(function (SwimPlayer $player, $data) use (&$buttons, $party) {
      if ($data === null) return;

      $partyNames = array_keys($buttons);
      if (!isset($partyNames[$data])) return;
      $partyName = $partyNames[$data];
      if (!isset($buttons[$partyName])) return;
      $partyData = $buttons[$partyName];

      $otherParty = $partyData['party'];
      $mode = $partyData['mode'];
      $mapName = $partyData['map'] ?? 'random';

      if ($otherParty instanceof Party) {
        if (!$otherParty->isInDuel() && !$party->isInDuel()) {
          if (SwimCoreInstance::getInstance()->getSystemManager()->getMapsData()->modeHasAvailableMap($mode)) {
            $party->startPartyVsPartyDuel($otherParty, $mode, $mapName);
          } else {
            $player->sendMessage(TextFormat::RED . "No map is currently available for that mode, try again later");
          }
        } else {
          $player->sendMessage(TextFormat::RED . "Party no longer available to duel");
        }
      }
    });

    // Add parties to the buttons
    foreach ($party->getDuelRequests() as $text => $partyData) {
      if (!$party->isInDuel()) {
        $buttons[$text] = $partyData; // maybe a todo is to make the party data also include map name on it
        $form->addButton($text . TextFormat::DARK_GRAY . " | " . $partyData['party']->formatSize());
      }
    }

    $form->setTitle(TextFormat::LIGHT_PURPLE . "Party Duel Requests");
    $player->sendForm($form);
  }

}