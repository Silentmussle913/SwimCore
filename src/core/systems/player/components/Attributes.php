<?php

namespace core\systems\player\components;

use core\database\SwimDB;
use core\SwimCore;
use core\systems\player\Component;
use core\systems\player\SwimPlayer;
use Generator;
use poggit\libasynql\libs\SOFe\AwaitGenerator\Await;
use poggit\libasynql\SqlThread;

class Attributes extends Component
{

  private array $attributes;

  private int $shopMoney = 0;

  // purely for display

  public int $skywarsElo = 0;
  private int $skywarsGamesPlayed = 0;
  private int $skywarsGamesWon = 0;
  private int $skywarsGamesLost = 0;
  private float $skywarsWinRatio = 0;
  private int $skywarsKills = 0;

  public int $bedfightElo = 0;
  private int $bedfightGamesPlayed = 0;
  private int $bedfightGamesWon = 0;
  private int $bedfightGamesLost = 0;
  private float $bedfightWinRatio = 0.0;

  public function __construct(SwimCore $core, SwimPlayer $swimPlayer, bool $doesUpdate = true)
  {
    parent::__construct($core, $swimPlayer, $doesUpdate);
    $this->attributes = [];
  }

  public function load(): Generator
  {
    $xuid = $this->swimPlayer->getXuid();
    $playerName = $this->swimPlayer->getName();

    // Query to load shopMoney and all Elo statistics
    $attributesQuery = "SELECT shopMoney FROM Attributes WHERE xuid = '$xuid'";
    $eloQuery = "SELECT skywars, skywars_games_played, skywars_games_won, skywars_games_lost, skywars_win_ratio, skywars_kills,
       bedfight, bedfight_games_played, bedfight_games_won, bedfight_games_lost, bedfight_win_ratio FROM Elo WHERE xuid = '$xuid'";

    // Fetch shopMoney
    $attributesRows = yield from Await::promise(
      fn($resolve, $reject) => SwimDB::getDatabase()->executeImplRaw(
        [0 => $attributesQuery],
        [0 => []],
        [0 => SqlThread::MODE_SELECT],
        $resolve,
        $reject
      )
    );

    // Fetch Elo statistics
    $eloRows = yield from Await::promise(
      fn($resolve, $reject) => SwimDB::getDatabase()->executeImplRaw(
        [0 => $eloQuery],
        [0 => []],
        [0 => SqlThread::MODE_SELECT],
        $resolve,
        $reject
      )
    );

    // Ensure player is connected to load data
    if ($this->swimPlayer->isConnected()) {
      // Load shopMoney if present
      if (isset($attributesRows[0]->getRows()[0])) {
        $attributesRow = $attributesRows[0]->getRows()[0];
        $this->shopMoney = (int)($attributesRow['shopMoney'] ?? 0);
      } else {
        $this->shopMoney = 0;
      }

      // Load Elo and statistics or initialize defaults
      if (isset($eloRows[0]->getRows()[0])) {
        $eloRow = $eloRows[0]->getRows()[0];
        // Skywars
        $this->skywarsElo = (int)($eloRow['skywars'] ?? 0);
        $this->skywarsGamesPlayed = (int)($eloRow['skywars_games_played'] ?? 0);
        $this->skywarsGamesWon = (int)($eloRow['skywars_games_won'] ?? 0);
        $this->skywarsGamesLost = (int)($eloRow['skywars_games_lost'] ?? 0);
        $this->skywarsWinRatio = (float)($eloRow['skywars_win_ratio'] ?? 0);
        $this->skywarsKills = (int)($eloRow['skywars_kills'] ?? 0);

        // Bedfight
        $this->bedfightElo = (int)($eloRow['bedfight'] ?? 1000);
        $this->bedfightGamesPlayed = (int)($eloRow['bedfight_games_played'] ?? 0);
        $this->bedfightGamesWon = (int)($eloRow['bedfight_games_won'] ?? 0);
        $this->bedfightGamesLost = (int)($eloRow['bedfight_games_lost'] ?? 0);
        $this->bedfightWinRatio = (float)($eloRow['bedfight_win_ratio'] ?? 0);
      } else {
        // Initialize to default values
        $this->skywarsElo = $this->skywarsGamesPlayed = $this->skywarsGamesWon = $this->skywarsGamesLost = $this->skywarsKills = 0;
        $this->skywarsWinRatio = 0.0;

        $this->bedfightGamesPlayed = $this->bedfightGamesWon = $this->bedfightGamesLost = 0;
        $this->bedfightElo = 1000; // 1k default;
        $this->bedfightWinRatio = 0.0;
      }

      if (SwimCore::$DEBUG) {
        echo("Money Loaded: $this->shopMoney | SW Elo: $this->skywarsElo | SW Games Played: $this->skywarsGamesPlayed | SW Games Won: $this->skywarsGamesWon | SW Games Lost: $this->skywarsGamesLost | SW Win Ratio: $this->skywarsWinRatio | SW Kills: $this->skywarsKills\n");
        echo("BF Elo: $this->bedfightElo | BF Games Played: $this->bedfightGamesPlayed | BF Games Won: $this->bedfightGamesWon | BF Games Lost: $this->bedfightGamesLost | BF Win Ratio: $this->bedfightWinRatio\n");
      }
    }
  }

  public function getEloFromGame(string $mode): int
  {
    return match ($mode) {
      "bedfight" => $this->bedfightElo,
      "skywars" => $this->skywarsElo,
      default => 1000,
    };
  }

  public function saveAttributes(): void
  {
    $xuid = $this->swimPlayer->getXuid();
    $query = "
        INSERT INTO Attributes (xuid, shopMoney) 
        VALUES ('$xuid', '$this->shopMoney')
        ON DUPLICATE KEY UPDATE 
            xuid = '$xuid', 
            shopMoney = '$this->shopMoney'
        ";

    SwimDB::getDatabase()->executeImplRaw(
      [0 => $query],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );
  }

  /**
   * @param int $shopMoney
   */
  public function setShopMoney(int $shopMoney): void
  {
    $this->shopMoney = $shopMoney;
  }

  /**
   * @return int
   */
  public function getShopMoney(): int
  {
    return $this->shopMoney;
  }

  public function subtractMoney(int $amount): void
  {
    $this->shopMoney -= $amount;
    if ($this->shopMoney < 0) {
      $this->shopMoney = 0;
    }
  }

  public function addMoney(int $amount): void
  {
    $this->shopMoney += $amount;
  }

  private int $secondsSinceLastSave = 0;
  private int $secondsSaveInterval = 300;

  public function updateSecond(): void
  {
    $this->secondsSinceLastSave++;
    if ($this->secondsSinceLastSave >= $this->secondsSaveInterval) {
      $this->secondsSinceLastSave = 0;
      $this->saveAttributes();
    }
  }

  public function getAttribute(string $attribute)
  {
    if (isset($this->attributes[$attribute])) {
      return $this->attributes[$attribute];
    }
    return null;
  }

  public function hasAttribute(string $attribute): bool
  {
    return isset($this->attributes[$attribute]);
  }

  public function setAttribute(string $attribute, $value): void
  {
    $this->attributes[$attribute] = $value;
  }

  // Shortcut for incrementing or decrementing an integer attribute.
  // Will set it to 1 or -1 if it does not exist yet depending on the subtraction params value.
  public function emplaceIncrementIntegerAttribute(string $attribute, bool $subtract = false): int
  {
    if (isset($this->attributes[$attribute])) {
      if (!$subtract) {
        $this->attributes[$attribute]++;
      } else {
        $this->attributes[$attribute]--;
      }
    } else {
      $this->attributes[$attribute] = $subtract ? -1 : 1;
    }
    // returns the amount this attribute is currently at
    return $this->attributes[$attribute];
  }

  public function clear(): void
  {
    $this->attributes = [];
  }

  public function removeAttribute(string $attribute): void
  {
    unset($this->attributes[$attribute]);
  }

}