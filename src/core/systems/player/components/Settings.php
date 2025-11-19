<?php

namespace core\systems\player\components;

use core\database\SwimDB;
use core\SwimCore;
use core\systems\player\Component;
use core\systems\player\SwimPlayer;
use core\utils\TimeHelper;
use Generator;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\network\mcpe\protocol\CameraShakePacket;
use pocketmine\network\mcpe\protocol\GameRulesChangedPacket;
use pocketmine\network\mcpe\protocol\SetTimePacket;
use pocketmine\network\mcpe\protocol\types\BoolGameRule;
use poggit\libasynql\libs\SOFe\AwaitGenerator\Await;
use poggit\libasynql\SqlThread;

class Settings extends Component
{

  private array $toggles;

  // these are class fields because much faster to look up as they are called on every tick almost
  private bool $dc = false;
  private bool $sprint = false;
  private int $scrimRole = 0;
  private int $shopType = 0;

  // Centralized definition of settings and their default values
  private const DEFAULTS = [
    'showCPS' => true,
    'showScoreboard' => true,
    'fullBright' => false,
    'duelInvites' => true,
    'partyInvites' => true,
    'showCords' => false,
    'showScoreTags' => true,
    'msg' => true,
    'pearl' => false, // animated pearl teleport animation
    'nhc' => false, // no hurt cam
    'dc' => false,
    'sprint' => false,
    'personalTime' => 1000, // default day time
    // scrim settings from here:
    'shopType' => 0, // default 0 for forms, 1 for chest UI style
    'scrimRole' => 0, // enum for scrim role for matchmaking (Banker, Staller, Rusher, Bower)
  ];

  public function __construct(SwimCore $core, SwimPlayer $swimPlayer)
  {
    parent::__construct($core, $swimPlayer);
    $this->toggles = self::DEFAULTS;
  }

  /**
   * @throws ScoreFactoryException
   */
  public function updateSettings(): void
  {
    // toggle viewable score tag cps for that player
    $this->swimPlayer->getClickHandler()->showCPS($this->getToggle('showCPS'));
    // turn on cords for that player
    $pk = new GameRulesChangedPacket();
    $pk->gameRules = ["showCoordinates" => new BoolGameRule($this->getToggle('showCords'), false)];
    $this->swimPlayer->getNetworkSession()->sendDataPacket($pk);
    // remove scoreboard if toggled on
    if (!$this->getToggle('showScoreboard')) {
      $this->swimPlayer->removeScoreboard();
    }
    $this->swimPlayer->getNetworkSession()->sendDataPacket(CameraShakePacket::create(0.00001, 3000000000000000000, CameraShakePacket::TYPE_ROTATIONAL, CameraShakePacket::ACTION_STOP)); // stop existing shake if present
    if ($this->getToggle('nhc')) {
      $this->swimPlayer->getNetworkSession()->sendDataPacket(CameraShakePacket::create(0.00001, 3000000000000000000, CameraShakePacket::TYPE_ROTATIONAL, CameraShakePacket::ACTION_ADD)); // hack to suppress hurt cam
    }
    // set time
    if ($this->getToggleInt('personalTime')) {
      $this->swimPlayer->getNetworkSession()->sendDataPacket(SetTimePacket::create($this->getToggleInt('personalTime') + 2000000000));
    }

    // set our quick booleans and integers
    $this->dc = $this->getToggle('dc');
    $this->sprint = $this->getToggle('sprint');
    $this->shopType = $this->getToggleInt('shopType');
    $this->scrimRole = $this->getToggleInt('scrimRole');

    // full bright is just night vision
    $this->refreshFullBright();
  }

  public function refreshFullBright(): void
  {
    if ($this->getToggle('fullBright')) {
      $this->swimPlayer->getEffects()->add(new EffectInstance(VanillaEffects::NIGHT_VISION(), TimeHelper::minutesToTicks(900), 1, false));
    } else {
      $this->swimPlayer->getEffects()->clear();
    }
  }

  public function dcPreventOn(): bool
  {
    return $this->dc;
  }

  public function isAutoSprint(): bool
  {
    return $this->sprint;
  }

  public function getShopType(): int
  {
    return $this->shopType;
  }

  public function getScrimRole(): int
  {
    return $this->scrimRole;
  }

  public function setToggle(string $setting, bool $state): void
  {
    if (isset($this->toggles[$setting])) {
      $this->toggles[$setting] = $state;
    }
  }

  public function setToggleInt(string $setting, int $state): void
  {
    if (isset($this->toggles[$setting])) {
      $this->toggles[$setting] = $state;
    }
  }

  public function getToggle(string $setting): ?bool
  {
    return $this->toggles[$setting] ?? null;
  }

  public function getToggleInt(string $setting): ?int
  {
    if (!isset($this->toggles[$setting])) return null;
    return (int)$this->toggles[$setting] ?? null;
  }

  /**
   * Save settings to the database (upsert).
   */
  public function saveSettings(): void
  {
    $xuid = $this->swimPlayer->getXuid();

    // Build column/value arrays dynamically
    $columns = array_keys(self::DEFAULTS);
    $values = [];
    foreach ($columns as $col) {
      // Force everything to int for saving
      $values[$col] = (int)($this->toggles[$col] ?? self::DEFAULTS[$col]);
    }

    // Build INSERT part
    $insertCols = implode(", ", array_merge(['xuid'], $columns));
    $insertVals = implode(", ", array_merge(
      ["'$xuid'"],                 // quote xuid (string)
      array_map(fn($v) => $v, $values) // leave integers unquoted
    ));

    // Build UPDATE part
    $updateStr = implode(", ", array_map(
      fn($c) => "$c = {$values[$c]}",
      $columns
    ));

    // Final query
    $query = "
        INSERT INTO Settings ($insertCols) 
        VALUES ($insertVals)
        ON DUPLICATE KEY UPDATE 
            xuid = '$xuid', 
            $updateStr
    ";

    if (SwimCore::$DEBUG) {
      echo("Generated save settings query: $query\n");
    }

    SwimDB::getDatabase()->executeImplRaw(
      [0 => $query],
      [0 => []],
      [0 => SqlThread::MODE_GENERIC],
      fn() => null,
      null
    );
  }

  /**
   * Load settings from the database (or insert defaults if missing).
   * @throws ScoreFactoryException
   */
  public function load(): Generator
  {
    $xuid = $this->swimPlayer->getXuid();
    $query = "SELECT * FROM Settings WHERE xuid = '$xuid'";

    $rows = yield from Await::promise(fn($resolve, $reject) => SwimDB::getDatabase()->executeImplRaw(
      [0 => $query],
      [0 => []],
      [0 => SqlThread::MODE_SELECT],
      $resolve,
      $reject
    )
    );

    if ($this->swimPlayer->isConnected() && $this->swimPlayer->isOnline()) {
      if (isset($rows[0]->getRows()[0])) {
        $data = $rows[0]->getRows()[0];

        // Merge DB values with defaults
        foreach (self::DEFAULTS as $key => $default) {
          if (isset($data[$key])) {
            // Cast back to bool or int depending on default type
            $this->toggles[$key] = is_bool($default)
              ? (bool)$data[$key]
              : (int)$data[$key];
          } else {
            $this->toggles[$key] = $default;
          }
        }
      } else {
        // Insert defaults for new players
        $this->saveSettings();
      }

      // Apply loaded settings for their in game properties
      $this->updateSettings();
    }
  }

  public function getToggles(): array
  {
    return $this->toggles;
  }

}