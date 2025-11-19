<?php

namespace core\forms\parties;

use core\SwimCore;
use core\systems\party\Party;
use core\systems\player\SwimPlayer;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class CombinedPartyForms
{

  public static function combinedJoinInviteRequestForm(SwimCore $core, SwimPlayer $player, Party $party): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, int $data = null) use ($core, $party) {
      if ($data === null) return;

      switch ($data) {
        case 0:
          FormPartyInvite::formPartyInvite($core, $player, $party);
          break;

        case 1:
          FormPartyInvite::formPartyRequests($core, $player, $party);
          break;
      }
    });

    $c = count($party->getJoinRequests());
    $txt = TextFormat::DARK_GRAY . "(" . TextFormat::YELLOW . $c . TextFormat::DARK_GRAY . ")";

    $form->setTitle(TextFormat::DARK_GREEN . "Invite & Joins");
    $form->addButton(TextFormat::DARK_GREEN . "Invite Players", 0, "textures/items/cookie");
    $form->addButton(TextFormat::DARK_AQUA . "Party Join Requests $txt", 0, "textures/items/carrot");

    $player->sendForm($form);
  }

  public static function combinedDuelRequestForm(SwimCore $core, SwimPlayer $player, Party $party): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, int $data = null) use ($core, $party) {
      if ($data === null) return;

      switch ($data) {
        case 0:
          FormPartyDuels::pickOtherPartyToDuel($core, $player, $party);
          break;

        case 1:
          FormPartyDuels::acceptPartyDuelRequests($player, $party);
          break;
      }
    });

    $c = count($party->getDuelRequests());
    $txt = TextFormat::DARK_GRAY . "(" . TextFormat::YELLOW . $c . TextFormat::DARK_GRAY . ")";

    $form->setTitle(TextFormat::DARK_GREEN . "Duel Requests");
    $form->addButton(TextFormat::DARK_GREEN . "Send Duel Request", 0, "textures/items/emerald");
    $form->addButton(TextFormat::DARK_AQUA . "View Duel Requests $txt",0, "textures/items/diamond");

    $player->sendForm($form);
  }

  public static function combinedPartyManagementForm(SwimCore $core, SwimPlayer $player, Party $party): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, int $data = null) use ($core, $party) {
      if ($data === null) return;

      switch ($data) {
        case 0:
          FormPartySettings::baseSelection($core, $player, $party);
          break;

        case 1:
          FormPartyManagePlayers::listPlayers($core, $player, $party);
          break;

        case 2:
          FormPartyExit::formPartyLeave($core, $player, $party);
          break;
      }
    });

    $c = count($party->getPlayers());
    $txt = TextFormat::DARK_GRAY . "(" . TextFormat::YELLOW . $c . TextFormat::DARK_GRAY . ")";

    $form->setTitle(TextFormat::DARK_GREEN . "Manage Party");
    $form->addButton(TextFormat::DARK_GREEN . "Party Settings");
    $form->addButton(TextFormat::DARK_AQUA . "Manage Players $txt");
    $form->addButton(TextFormat::DARK_RED . "Leave Party");

    $player->sendForm($form);
  }

}