<?php

namespace core\database\queries;

use core\database\SwimDB;
use poggit\libasynql\SqlThread;

class TableManager
{

  // creates the needed tables (this only does the essential ones for the lightweight engine)
  public static function createTables(): void
  {

    // make the Connections table, which holds the player's xuid as the key, and the player's name as a value
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "CREATE TABLE IF NOT EXISTS Connections
              (
                  xuid VARCHAR(16) NOT NULL UNIQUE, 
                  name TEXT
              )"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    // Make the discord table which holds xuid for player and their ign and BIGINT for discord account id
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "CREATE TABLE IF NOT EXISTS Discord 
            (
                xuid VARCHAR(16) NOT NULL PRIMARY KEY, 
                id VARCHAR(20) NOT NULL
            )"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    // make the Settings table, which holds the player's xuid as the key, and booleans for cps, scoreboard, duel invites, and cords
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "CREATE TABLE IF NOT EXISTS Settings 
             (
                xuid VARCHAR(16) NOT NULL UNIQUE, 
                showCPS int, 
                showScoreboard int, 
                fullBright int,
                duelInvites int, 
                partyInvites int,
                showCords int,
                showScoreTags int,
                msg int,
                pearl int,
                nhc int,
                dc int,
                sprint int,
                personalTime int,
                shopType int,
                scrimRole int
             )"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "CREATE TABLE IF NOT EXISTS Attributes 
             (
                xuid VARCHAR(16) NOT NULL UNIQUE, 
                shopMoney int 
             )"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    // make the Ranks table, which holds the player's xuid as the key, and the player's name and rank
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "CREATE TABLE IF NOT EXISTS Ranks 
             (
                xuid VARCHAR(16) NOT NULL UNIQUE, 
                name TEXT, 
                playerRank int
             )"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    // create the Punishments table, which holds the player's xuid as the key, and if they are banned or muted and the times to be unpunished at
    SwimDB::getDatabase()->executeImplRaw(
      [0 => "CREATE TABLE IF NOT EXISTS Punishments 
            (
                xuid VARCHAR(16) NOT NULL UNIQUE, 
                name TEXT, 
                banned int, 
                muted int,
                unbanTime BIGINT, 
                unmuteTime BIGINT, 
                banReason TEXT, 
                muteReason TEXT
            )"],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    // create the kits table (naive example using json for stuff, binary might be better)
    SwimDB::getDatabase()->executeImplRaw(
      [0 => "CREATE TABLE IF NOT EXISTS Kits
            (
                xuid VARCHAR(16) NOT NULL UNIQUE, 
                bedfight JSON,
                skywars JSON,
                bridge JSON,
                buhc JSON,
                fireball JSON,
                sg JSON
            )"],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

    // create the cosmetics table, again pretty naive and simple and not expected for large prod networks
    SwimDB::getDatabase()->executeImplRaw(
      [
        0 => "
            CREATE TABLE IF NOT EXISTS Cosmetics (
                xuid VARCHAR(16) NOT NULL PRIMARY KEY,
                name TEXT NOT NULL,
                chatFormat TEXT,
                tag TEXT,
                killMessage TEXT,
                hubParticleEffect TEXT,
                selectedPet TEXT,
                selectedHat TEXT,
                selectedBackBling TEXT,
                pets JSON,
                hats JSON,
                backBlings JSON
            )"
      ],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );

  }

} // TableManager