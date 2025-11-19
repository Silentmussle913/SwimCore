<?php

namespace core\forms\hub;

use core\scenes\duel\Duel;
use core\scenes\duel\IconHelper;
use core\scenes\hub\Queue;
use core\SwimCore;
use core\systems\map\MapsData;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use jackmd\scorefactory\ScoreFactoryException;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\utils\TextFormat;

class FormDuelRequests
{

  public static string $adMsg = TextFormat::DARK_AQUA . "Buy a rank on " .
  TextFormat::AQUA . "swim.tebex.io" .
  TextFormat::DARK_AQUA . " or boost " .
  TextFormat::LIGHT_PURPLE . "discord.gg/swim" .
  TextFormat::DARK_AQUA . " to pick duel maps!";

  public static function duelSelectionBase(SwimCore $core, SwimPlayer $swimPlayer): void
  {
    if (!$swimPlayer->isInScene("Hub")) return;

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core) {
      if ($data === null) {
        return;
      }

      if (!$player->isInScene("Hub")) return;

      if ($data == 0) {
        self::viewDuelRequests($core, $player);
      } elseif ($data == 1) {
        self::viewPossibleOpponents($core, $player);
      } else {
        $player->sendMessage(TextFormat::RED . "Error");
      }
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Duel Manager");

    // make buttons
    $form->addButton(TextFormat::RED . "View Duel Requests " . TextFormat::DARK_GRAY . "["
      . TextFormat::AQUA . count($swimPlayer->getInvites()->getDuelInvites()) . TextFormat::DARK_GRAY . "]");
    $form->addButton(TextFormat::DARK_GREEN . "Send a Duel Request");

    $swimPlayer->sendForm($form);
  }

  private static function viewDuelRequests(SwimCore $core, SwimPlayer $swimPlayer): void
  {
    if (!$swimPlayer->isInScene("Hub")) return;

    $buttons = [];

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, &$buttons) {
      if ($data === null) return;

      if (!$player->isInScene("Hub")) return;

      // First fetch sender name
      $senders = array_keys($buttons);
      if (isset($senders[$data])) {
        // get as player
        $sender = $senders[$data];
        $senderPlayer = $core->getServer()->getPlayerExact($sender);
        if ($senderPlayer instanceof SwimPlayer) {
          // check if this sender is in the hub and the mode has an available map
          $inviteData = $buttons[$sender];
          if ($senderPlayer->isInScene("Hub")) {
            if ($core->getSystemManager()->getMapsData()->modeHasAvailableMap($inviteData['mode'])) {
              self::startDuel($core, $senderPlayer, $player, $inviteData);
            } else {
              $player->sendMessage(TextFormat::RED . "No map is currently available for that mode, try again later");
            }
            return;
          }
        }
      }

      $player->sendMessage(TextFormat::RED . "Duel Expired");
    });

    $form->setTitle("Duel Requests");

    // make buttons from requests
    $requests = $swimPlayer->getInvites()->getDuelInvites();
    foreach ($requests as $sender => $inviteData) {
      $buttons[$sender] = $inviteData;
      $mode = $inviteData['mode'];
      $map = $inviteData['map'];
      $text = TextFormat::DARK_GREEN . $sender . TextFormat::GRAY . " | " . TextFormat::RED . ucfirst($mode) . TextFormat::GRAY . " | " . TextFormat::YELLOW . "Map: " . ucfirst($map);
      $form->addButton($text, 0, IconHelper::getIcon($mode));
    }

    $swimPlayer->sendForm($form);
  }

  /**
   * @throws ScoreFactoryException
   */
  private static function startDuel(SwimCore $core, SwimPlayer $user, SwimPlayer $inviter, $inviteData): void
  {
    // insanely based method to get the queue scene and use one of its functions to start a duel that way
    $queue = $core->getSystemManager()->getSceneSystem()->getScene('Queue');
    if ($queue instanceof Queue) {
      $queue->publicDuelStart($user, $inviter, $inviteData['mode'], $inviteData['map']);
    }
  }

  // get all players in hub scene with duel invites on
  private static function viewPossibleOpponents(SwimCore $core, SwimPlayer $swimPlayer): void
  {
    if (!$swimPlayer->isInScene("Hub")) return;

    $buttons = [];

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, &$buttons) {
      if ($data === null) return;

      if (!$player->isInScene("Hub")) return;

      // Fetch Swim Player from button
      if (isset($buttons[$data])) {
        $playerToDuel = $buttons[$data];
        if ($playerToDuel instanceof SwimPlayer) {
          self::duelSelection($core, $player, $playerToDuel);
          return;
        }
      }

      $player->sendMessage(TextFormat::RED . "Error");
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Choose an Opponent");

    // get the array of swim players in the hub
    $players = $core->getSystemManager()->getSceneSystem()->getScene("Hub")->getPlayers();

    $id = $swimPlayer->getId();
    foreach ($players as $plr) {
      if ($plr instanceof SwimPlayer) {
        // skip self if not in debug mode
        if ($plr->getId() != $id || SwimCore::$DEBUG) {
          if ($plr->getSettings()->getToggle('duelInvites')) {
            $buttons[] = $plr;
            $form->addButton($plr->getRank()->rankString());
          }
        }
      }
    }

    $swimPlayer->sendForm($form);
  }

  private static function duelSelection(SwimCore $core, SwimPlayer $user, SwimPlayer $invited): void
  {
    if (!$user->isInScene("Hub")) return;

    $buttons = []; // index -> modeName

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($core, $invited, $user, &$buttons) {
      if ($data === null) return;
      if (!$player->isInScene("Hub")) return;

      // attempt to fix stale invite crash
      if (!(isset($invited) && isset($user) && $invited->isOnline() && $user->isOnline())) return;

      $mode = $buttons[$data] ?? null;
      if ($mode === null) {
        $player->sendMessage(TextFormat::RED . "Error: Invalid game mode selected.");
        return;
      }

      // Check the rank of the user and proceed accordingly
      $rankLevel = $user->getRank()->getRankLevel();
      if ($rankLevel > Rank::DEFAULT_RANK) {
        // Higher-ranked users get to select a map from the mode
        self::selectMapForMode($core, $user, $invited, $mode);
      } else {
        // Default rank users proceed with a random map
        $invited->getInvites()?->duelInvitePlayer($player, $mode);
        $player->sendMessage(self::$adMsg);
      }
    });

    $buttons = self::buildDuelFormWithButtons($form, $buttons, $user);

    // Send the form to the user
    $user->sendForm($form);
  }

  private static function selectMapForMode(SwimCore $core, SwimPlayer $user, SwimPlayer $invited, string $mode): void
  {
    $mapsData = $core->getSystemManager()->getMapsData();
    $names = self::collectUniqueMapNames($mapsData, $mode);
    if (empty($names)) {
      $user->sendMessage(TextFormat::RED . "No maps available for this mode.");
      return;
    }

    // Cache the pool once so we don’t search twice
    $mapPool = $mapsData->getMapPoolFromMode($mode);
    if ($mapPool === null) {
      $user->sendMessage(TextFormat::RED . "No maps available for this mode.");
      return;
    }

    self::sendMapSelectForm
    (
      $names,
      // onPick
      function (string $base) use ($user, $invited, $mode, $mapPool) {
        $selectedMap = $mapPool->getFirstInactiveMapByBaseName($base);
        if ($selectedMap !== null) {
          $invited->getInvites()?->duelInvitePlayer($user, $mode, $base);
        } else {
          $user->sendMessage(TextFormat::RED . "ERROR: Try again later. No available map found for " . $base);
        }
      },
      // onRandom
      function () use ($user, $invited, $mode) {
        $invited->getInvites()?->duelInvitePlayer($user, $mode);
      },
      $user
    );
  }

  /** Merge unique map base names for a mode (adds misc when using basic pool). */
  public static function collectUniqueMapNames(MapsData $mapsData, string $mode): array
  {
    $mapPool = $mapsData->getMapPoolFromMode($mode);
    if ($mapPool === null) {
      return [];
    }

    // Base names from the mode's pool
    $unique = $mapPool->getUniqueMapBaseNames();

    // If using basic pool, append misc pool names
    if ($mapPool === $mapsData->getBasicDuelMaps()) {
      $misc = $mapsData->getMiscDuelMaps();
      foreach ($misc->getUniqueMapBaseNames() as $name) {
        $unique[] = $name;
      }
    }

    return $unique;
  }

  /**
   * Build and send a "Select a Map" form.
   * - $names: list of base names in button order
   * - $onPick(string $baseName): void              // user picked a specific map
   * - $onRandom(): void                            // user chose Random (or invalid index)
   * - $to: SwimPlayer who receives the form
   */
  public static function sendMapSelectForm(array $names, callable $onPick, callable $onRandom, SwimPlayer $to): void
  {
    if (empty($names)) {
      $to->sendMessage(TextFormat::RED . "No maps available for this mode.");
      return;
    }

    $form = new SimpleForm(function (SwimPlayer $player, $data) use ($onPick, $onRandom) {
      if ($data === null) return; // closed

      // $data is the label we set below (string), thanks to processData()
      if ($data === 'random') {
        $onRandom();
        return;
      }

      // otherwise it's a base name
      $onPick((string)$data);
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Select a Map");
    // Random first
    $form->addButton(TextFormat::DARK_GREEN . "Random", 0, "", "random"); // you can label buttons as strings

    foreach ($names as $baseName) {
      $label = TextFormat::DARK_RED . ucfirst($baseName);
      $form->addButton($label, 0, "", $baseName);
    }

    $to->sendForm($form);
  }

  /**
   * @param SimpleForm $form
   * @param array $buttons
   * @param SwimPlayer $player
   * @return array
   */
  public static function buildDuelFormWithButtons(SimpleForm $form, array $buttons, SwimPlayer $player): array
  {
    $form->setTitle(TextFormat::GREEN . "Select Game");

    // Build buttons from Duel::$MODES (assoc: mode => DuelInfo) in JSON order
    foreach (Duel::$MODES as $val) {
      if (!$val->enabled) continue;

      $modeName = $val->modeName;
      $decor = $val->decoratedName ?: ('§4' . ucfirst($modeName));
      $icon = class_exists($val->classPath) ? $val->classPath::getIcon() : null;

      $form->addButton($decor, 0, $icon);
      $buttons[] = $modeName; // index -> mode
    }

    $player->sendForm($form);
    return $buttons;
  }

}