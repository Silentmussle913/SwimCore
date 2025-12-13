<?php

namespace core\database;

use core\SwimCore;
use core\utils\cordhook\CordHook;
use core\utils\TimeHelper;
use pocketmine\scheduler\Task;
use poggit\libasynql\DataConnector;
use poggit\libasynql\SqlThread;

class KeepAlive extends Task
{

  private DataConnector $DBC;
  private SwimCore $core;

  public function __construct(DataConnector $DBC, SwimCore $core)
  {
    $this->DBC = $DBC;
    $this->core = $core; // Pass the core for reinitialization
  }

  /*
  * @brief Called in a task every minute to ping the database to keep the connection alive
  */
  public function onRun(): void
  {
    /* We don't need this anymore
    if ((time() - CordHook::$lastMessageTime) > TimeHelper::minutesToSeconds(10)) {
      if (SwimCore::$DEBUG) echo("Sending keep alive to discord\n");
      CordHook::sendEmbed("Keep alive ping sent due to minimal connection activity", "Keep alive");
    } else if (SwimCore::$DEBUG) {
      echo("Keep alive ping not needed to be sent to discord\n");
    }
    */

    // No need for try-catch, use onError callback instead
    $this->DBC->executeImplRaw(
      [
        0 => "SELECT 1"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
        // Query succeeded
      },
      function (string $error) {
        // Handle database errors here
        // this does not seem to work or get hit ever, possibly because if there is no database connection, there is no error to be returned
        echo("DB ERROR: " . $error . "\n");
        if (str_contains(strtolower($error), 'mysql server has gone away') ||
          str_contains($error, "disconnect") ||
          str_contains($error, "503")) {
          $this->getHandler()->cancel(); // remove this task now that we will make a new one via reconnect() which calls initialize()
          $this->reconnect();
        }
      }
    );
  }

  private function reconnect(): void
  {
    // Close the current connection
    SwimDB::close();

    // Attempt to reinitialize the connection
    SwimDB::initialize($this->core);

    echo("Reconnected to the database after a disconnect.\n");
  }

}