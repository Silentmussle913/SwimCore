<?php

namespace core\systems\scene\replay;

use core\systems\player\SwimPlayer;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class ReplaySelectionDebugUI
{

  public static function replaySelectionDebugUI(SwimPlayer $swimPlayer): void
  {
    $buttons = [];

    $form = new SimpleForm(function (SwimPlayer $swimPlayer, $data) use (&$buttons) {
      if ($data === null) return;

      $replayNames = array_keys($buttons);
      if (isset($replayNames[$data])) {
        $replayName = $replayNames[$data];
        // Now fetch the corresponding replay using the replay name
        if (isset($buttons[$replayName])) {
          $replay = $buttons[$replayName];
          if ($replay instanceof SceneReplay) {
            // now we start the replay, which means making a whole scene for this
            MovieScene::makeMovieScene($replay, [$swimPlayer]);
          }
        }
      }
    });

    $form->setTitle(TextFormat::YELLOW . 'Replay Selection');

    foreach (SceneReplay::$replays as $replay) {
      $buttons[$replay->replayName] = $replay;
      $form->addButton($replay->replayName);
    }

    $swimPlayer->sendForm($form);
  }

}