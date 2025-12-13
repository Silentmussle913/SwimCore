<?php

namespace core\database;

use core\database\queries\TableManager;
use core\SwimCore;
use core\utils\TimeHelper;
use poggit\libasynql\DataConnector;
use poggit\libasynql\libasynql;

class SwimDB
{

  private static DataConnector $DBC;

  public static function initialize(SwimCore $core): void
  {
    $databaseConf = $core->getSwimConfig()->database;

    // Establish the database connection
    self::$DBC = libasynql::create($core, [
      "type" => "mysql",
      "mysql" => [
        "host" => $databaseConf->host,
        "username" => $databaseConf->username,
        "password" => $databaseConf->password,
        "schema" => $databaseConf->schema,
        "port" => $databaseConf->port,
        "worker-limit" => $databaseConf->workerLimit
      ]
    ], ["mysql" => "mysql.sql"]);

    // Create tables if needed
    TableManager::createTables();

    // Start the keep-alive task
    $core->getScheduler()->scheduleRepeatingTask(new KeepAlive(self::$DBC, $core), TimeHelper::minutesToTicks(1));
  }

  public static function getDatabase(): DataConnector
  {
    return self::$DBC;
  }

  public static function close(): void
  {
    self::$DBC->close();
  }

}
