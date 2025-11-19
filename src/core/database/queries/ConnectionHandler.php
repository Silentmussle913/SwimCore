<?php

namespace core\database\queries;

use core\database\SwimDB;
use core\systems\player\components\detections\Detection;
use core\systems\player\SwimPlayer;
use core\utils\cordhook\CordHook;
use core\utils\PlayerInfoHelper;
use core\utils\TimeHelper;
use Generator;
use pocketmine\utils\TextFormat as TF;
use poggit\libasynql\libs\SOFe\AwaitGenerator\Await;
use poggit\libasynql\SqlThread;

class ConnectionHandler
{

  public static function handlePlayerJoin(SwimPlayer $player): void
  {
    // Get needed info
    $name = $player->getName();
    $xuid = $player->getXuid();

    // Update the player connection info in the database
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "
            INSERT INTO Connections (xuid, name) 
            VALUES ('$xuid', '$name') 
            ON DUPLICATE KEY UPDATE 
            xuid = '$xuid', 
            name = '$name'
            "
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () use ($xuid, $name) { // closure on complete:
        // Could update the Alts' table after the Connections' table is updated
      },
      null
    );

    // check for punishments
    self::checkPunishments($player, $xuid);
  }

  public static function updateDiscordLink(string $xuid, string $discordId): void
  {
        SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "INSERT INTO Discord (xuid, id)
        VALUES (?, ?)
        ON DUPLICATE KEY UPDATE
        xuid = VALUES(xuid),
        id = VALUES(id);
        "
      ],
      [0 => [$xuid, $discordId]],
      [0 => SqlThread::MODE_GENERIC],
      function() {
      },
      function($msg, $bt) {
        var_dump($msg);
      }
    );
  }

  public static function removeDiscordLink(string $xuid): void
  {
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "DELETE FROM Discord WHERE xuid = ?;"
      ],
      [0 => [$xuid]],
      [0 => SqlThread::MODE_CHANGE],
      function () {
      },
      function ($msg, $bt) {
        var_dump($msg);
      }
    );
  }

  public static function getDiscordLink(string $xuid, callable $cb): void
  {
    $query = "SELECT * FROM Discord WHERE (xuid = ?)";
    SwimDB::getDatabase()->executeImplRaw([0 => $query], [0 => [$xuid]], [0 => SqlThread::MODE_SELECT], function(array $rows) use($cb) {
      if (isset($rows[0]) && isset($rows[0]->getRows()[0]["id"])) {
        $cb($rows[0]->getRows()[0]["id"]);
      } else {
        $cb("");
      }
    }, null);
  }

  private static function checkPunishments(SwimPlayer $swimPlayer, string $xuid): void
  {
    Await::f2c(function () use ($swimPlayer, $xuid): Generator {
      // set up query
      $query = "SELECT * FROM Punishments WHERE (xuid = ?) AND (muted = 1 OR banned = 1)";

      // check if they have a punishment (this should return a single row of rows)
      $rowsResult = yield from Await::promise(fn($resolve, $reject) => SwimDB::getDatabase()->executeImplRaw([0 => $query], [0 => [$xuid]], [0 => SqlThread::MODE_SELECT], $resolve, $reject));
      // Get the rows and needed data
      $rows = $rowsResult[0]->getRows();
      $hasBeenMuted = false;
      $xuidFound = false;
      // Iterate through the rows and deal with any of the punishments
      if (!empty($rows)) {
        foreach ($rows as $row) {
          // check if it has banned account
          $banned = self::checkBan($row);
          if ($banned) {

            // Could log that they tried logging in
            if (isset($row['name'])) {
              // self::altMessage($swimPlayer, $row);
            }

            $timeString = TimeHelper::formatTime($row['unbanTime'] - time());
            $money = "\n" . TF::BLUE . "Purchase Unban at " . TF::AQUA . "swim.tebex.io" . TF::GRAY . " | " . TF::BLUE . "Support: " . TF::AQUA . "discord.gg/swim";
            $banMessage = TF::RED . "You are Banned for: " . TF::YELLOW . $row['banReason'] . "\n" . TF::GOLD . "Ban expires in " . $timeString . $money;
            $swimPlayer->kick("banned player connection rejected", null, $banMessage);
            return; // if they are banned we can crash out of the entire function from here
          }
          // check if it has muted account
          $muted = self::checkMute($row);
          if ($muted && !$hasBeenMuted) {
            $hasBeenMuted = true; // so we know there is no point to mute them again
            $swimPlayer?->getChatHandler()->setMute($row['muteReason'], $row['unmuteTime']);
          }
          // confirms we found the account that is currently logging in
          if ($row['xuid'] === $xuid) {
            $xuidFound = true;
          }
        }
        // by here it has been evaluated they are not banned or alting,
        // so we can delete the entire punishment log row if the specific player is in there, which is told by xuidFound
        if (!$hasBeenMuted && $xuidFound) {
          $query = "DELETE FROM Punishments WHERE xuid = ?";
          SwimDB::getDatabase()->executeImplRaw([0 => $query], [0 => [$xuid]], [0 => SqlThread::MODE_CHANGE], function () {
          }, null);
        }
      }
      // finally load their data in if still online after checks
      if ($swimPlayer->isOnline()) {
        $server = $swimPlayer->getServer();
        $onlineCount = count($server->getOnlinePlayers());
        $msg = $swimPlayer->getName() . " Logged in! (" . $onlineCount . "/" . $server->getMaxPlayers() . ")";
        CordHook::sendEmbed($msg, "Microsoft Telemetry", "Made by Swim Services", 0x66CC66); // green
        $swimPlayer->loadData();
      }
    });
  }

  private static function checkMute($row): bool
  {
    $muted = $row['muted'];
    if ($muted) {
      $muteTime = $row['unmuteTime'];
      if ($muteTime > time()) {
        return true;
      } else {
        $xuid = $row['xuid'];
        // Unmute the specific account by setting muted and unmuteTime equal to null
        SwimDB::getDatabase()->executeImplRaw(
          [0 => "UPDATE Punishments SET muted = NULL, unmuteTime = NULL WHERE xuid = ?"],
          [0 => [$xuid]],
          [0 => SqlThread::MODE_GENERIC],
          function () {
          },
          null
        );
      }
    }
    return false;
  }

  private static function checkBan($row): bool
  {
    $banned = $row['banned'];
    if ($banned) {
      $banTime = $row['unbanTime'];
      if ($banTime > time()) {
        return true;
      } else {
        $xuid = $row['xuid'];
        // Unban the specific account by setting banned and unbanTime equal to null
        SwimDB::getDatabase()->executeImplRaw(
          [0 => "UPDATE Punishments SET banned = NULL, unbanTime = NULL WHERE xuid = ?"],
          [0 => [$xuid]],
          [0 => SqlThread::MODE_GENERIC],
          function () {
          },
          null
        );
      }
    }
    return false;
  }

}