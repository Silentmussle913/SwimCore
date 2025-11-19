<?php

namespace core\forms\parties;

use core\SwimCore;
use core\systems\party\Party;
use core\systems\player\SwimPlayer;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormPartyExit
{

  public static function formPartyDisband(SwimCore $core, SwimPlayer $player, Party $party): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, $party) {
      if ($data === null) return;

      if ($data == 0 && $party) {
        $core->getSystemManager()->getPartySystem()->disbandParty($party);
      }
    });

    $form->setTitle(TextFormat::RED . "Disband Party");
    $form->setContent(TextFormat::RED . "Are you sure you want to disband the party?");
    $form->addButton("Yes");
    $form->addButton("No");
    $player->sendForm($form);
  }

  public static function formPartyLeave(SwimCore $core, SwimPlayer $player, Party $party): void
  {
    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, $party) {
      if ($data === null) return;

      if ($data == 0 && $party) {
        $party->removePlayerFromParty($player);
        $party->partyMessage(TextFormat::YELLOW . $player->getNicks()->getNick() . " has left the party. " . $party->formatSize());
      }
    });

    $msg = "Are you sure you want to leave the party? If you are the leader, a new leader will be selected. If the party becomes empty, it will be disbanded.";

    $form->setTitle(TextFormat::DARK_RED . "Leave Party");
    $form->setContent(TextFormat::DARK_RED . $msg);
    $form->addButton("Yes");
    $form->addButton("No");
    $player->sendForm($form);
  }

}