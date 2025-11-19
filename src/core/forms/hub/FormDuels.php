<?php

namespace core\forms\hub;

use core\scenes\duel\Duel;
use core\scenes\hub\Queue;
use core\SwimCore;
use core\SwimCoreInstance;
use core\systems\player\SwimPlayer;
use core\systems\scene\SceneSystem;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat as TF;

class FormDuels
{

  // for choosing ranked and unranked queue
  public static function duelBaseForm(SwimPlayer $player): void
  {
    if (!SwimCore::$RANKED) {
      self::duelSelectionForm($player); // if ranked is off then only have normal duel selection form
      return;
    }

    $form = new SimpleForm(function (SwimPlayer $player, $data) {
      if ($data === null) {
        return;
      }

      if ($data == 0) {
        self::duelSelectionForm($player);
      } else if ($data == 1) {
        // self::rankedDuelSelectionForm($player);
      }
    });

    $form->setTitle(TF::GREEN . "Join Queue");
    $form->addButton(TF::GREEN . "Duels", 0, "textures/items/diamond");
    $form->addButton(TF::YELLOW . "Ranked Duels", 0, "textures/items/gold_ingot");
    $player->sendForm($form);
  }

  public static function duelSelectionForm(SwimPlayer $player): void
  {
    $sceneSystem = SwimCoreInstance::getInstance()->getSystemManager()->getSceneSystem();
    /** @var Queue $queue */
    $queue = $sceneSystem->getScene("Queue");

    $buttons = []; // index -> modeName

    $form = new SimpleForm(function (SwimPlayer $player, $data) use (&$buttons) {
      if ($data === null) return;

      $mode = $buttons[$data] ?? null;
      if (!$mode) return;

      $sceneHelper = $player->getSceneHelper();
      $sceneHelper->setNewScene('Queue');
      $sceneHelper->getScene()->getTeamManager()->getTeam($mode)?->addPlayer($player);
    });

    $queueCount = TF::GREEN . "Queued: " . TF::YELLOW . $sceneSystem->getQueuedCount();
    $duelCount = TF::GREEN . "In Duels: " . TF::BLUE . $sceneSystem->getInDuelsCount();

    $form->setTitle(TF::GREEN . "Select Game");
    $form->setContent($queueCount . TF::DARK_GRAY . " | " . $duelCount);

    // Build buttons in the same order Duel::$MODES was populated (JSON order)
    foreach (Duel::$MODES as $val) {
      if (!$val->enabled) continue;

      $modeName = $val->modeName;
      $decor = $val->decoratedName ?: ('§4' . ucfirst($modeName));

      $label = $decor . " " . self::formatModePlayerCounts($modeName, $val->classPath, $queue, $sceneSystem);
      $icon  = class_exists($val->classPath) ? $val->classPath::getIcon() : null;

      $form->addButton($label, 0, $icon);
      $buttons[] = $modeName; // maintain index -> mode mapping
    }

    $player->sendForm($form);
  }

  private static function formatModePlayerCounts(string $mode, string $sceneClassPath, Queue $queue, SceneSystem $sceneSystem): string
  {
    $queued = /*TF::GREEN . "Queued: " .*/
      TF::YELLOW . self::getQueuedCountOfMode($mode, $queue);
    $playing = /*TF::GREEN . "In Duel: " .*/
      TF::BLUE . $sceneSystem->getSceneInstanceOfCount($sceneClassPath);
    return TF::DARK_GRAY . "[" . $queued . TF::DARK_GRAY . " | " . $playing . TF::DARK_GRAY . "]";
  }

  private static function getQueuedCountOfMode(string $mode, Queue $queue): int
  {
    $teamPlayers = $queue->getTeamManager()->getTeam($mode)?->getPlayers() ?? null;

    if ($teamPlayers) {
      return count($teamPlayers);
    }

    return 0;
  }

}