<?php

namespace core\systems\player\components;

use core\database\SwimDB;
use core\SwimCore;
use core\systems\player\Component;
use core\systems\player\SwimPlayer;
use Generator;
use poggit\libasynql\libs\SOFe\AwaitGenerator\Await;
use poggit\libasynql\SqlThread;

class Kits extends Component
{

  private array $bedFight;
  private array $skywars;
  private array $bridge;
  private array $buhc;
  private array $fireball;
  private array $sg;

  public function __construct(SwimCore $core, SwimPlayer $swimPlayer)
  {
    parent::__construct($core, $swimPlayer);

    // make the bedfight array default kit
    $this->bedFight = [
      'sword' => 0,
      'wool' => 1,
      'pickaxe' => 2,
      'axe' => 3,
      'shears' => 4
    ];

    // make the skywars array default kit
    $this->skywars = [
      'sword' => 0,
      'blocks' => 1,
      'bow' => 2,
      'pearl' => 3,
      'snowball' => 4,
      'gap' => 5,
      'pickaxe' => 6,
      'arrow' => 10,
      'knock' => 7,
      'throwing' => 8
    ];

    // bridge default kit
    $this->bridge = [
      'sword' => 0,
      'blocks1' => 1,
      'bow' => 2,
      'pickaxe' => 3,
      'blocks2' => 4,
      'apple' => 5,
      'arrow' => 6
    ];

    // buhc default kit
    $this->buhc = [
      'sword' => 0,
      'rod' => 1,
      'bow' => 2,
      'water1' => 3,
      'lava1' => 4,
      'wood1' => 5,
      'cobble1' => 6,
      'apple' => 7,
      'head' => 8,
      'water2' => 9,
      'lava2' => 10,
      'wood2' => 11,
      'cobble2' => 12,
      'axe' => 13,
      'pick' => 14,
      'arrow' => 15
    ];

    // make the fireball array default kit
    $this->fireball = [
      'sword' => 0,
      'wool' => 1,
      'pickaxe' => 2,
      'axe' => 3,
      'shears' => 4,
      'fireballs' => 5,
      'endstone' => 6,
      'ladder' => 7,
      'tnt' => 8,
    ];

    // make the sg array default kit
    $this->sg = [
      'sword' => 0,
      'bow' => 1,
      'web' => 2,
      'snowball' => 3,
      'arrow' => 4,
    ];
  }

  public function setKitDataRaw(string $mode, array $data): void
  {
    match ($mode) {
      'bedfight' => $this->bedFight = $data,
      'skywars' => $this->skywars = $data,
      'bridge' => $this->bridge = $data,
      'buhc' => $this->buhc = $data,
      'fireball' => $this->fireball = $data,
      'sg' => $this->sg = $data,
    };
  }

  public function setKitSlotData(string $mode, string $item, int $slot): void
  {
    match ($mode) {
      'bedfight' => $this->bedFight[$item] = $slot,
      'skywars' => $this->skywars[$item] = $slot,
      'bridge' => $this->bridge[$item] = $slot,
      'buhc' => $this->buhc[$item] = $slot,
      'fireball' => $this->fireball[$item] = $slot,
      'sg' => $this->sg[$item] = $slot,
      default => null
    };
  }

  public function getKitData(string $mode): ?array
  {
    return match ($mode) {
      'bedfight' => $this->bedFight,
      'skywars' => $this->skywars,
      'bridge' => $this->bridge,
      'buhc' => $this->buhc,
      'fireball' => $this->fireball,
      'sg' => $this->sg,
      default => null
    };
  }

  // Feels dumb to do this everytime a player logs off instead of just when they edit a kit.
  // Maybe a dirty flag for the play session would be better.
  public function saveKits(): void
  {
    $xuid = $this->swimPlayer->getXuid();
    $bedFightJson = json_encode($this->bedFight);
    $skywarsJson = json_encode($this->skywars);
    $bridgeJson = json_encode($this->bridge);
    $buhcJson = json_encode($this->buhc);
    $fireJson = json_encode($this->fireball);
    $sg = json_encode($this->sg);

    $query = "
        INSERT INTO Kits (xuid, bedfight, skywars, bridge, buhc, fireball, sg)
        VALUES (?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE
            bedfight = VALUES(bedfight),
            skywars = VALUES(skywars),
            bridge = VALUES(bridge),
            buhc = VALUES(buhc),
            fireball = VALUES(fireball),
            sg = VALUES(sg)
    ";

    $params = [
      $xuid,
      $bedFightJson,
      $skywarsJson,
      $bridgeJson,
      $buhcJson,
      $fireJson,
      $sg
    ];

    SwimDB::getDatabase()->executeImplRaw(
      [0 => $query],
      [0 => $params],
      [0 => SqlThread::MODE_GENERIC],
      function () {
      },
      null
    );
  }

  // this is probably awful on database performance, this is all json so save kits is probably even worse
  public function load(): Generator
  {
    $xuid = $this->swimPlayer->getXuid();
    $query = "SELECT bedfight, skywars, bridge, buhc, fireball, sg FROM Kits WHERE xuid = '$xuid'";

    $rows = yield from Await::promise(fn($resolve, $reject) => SwimDB::getDatabase()->executeImplRaw([0 => $query], [0 => []], [0 => SqlThread::MODE_SELECT], $resolve, $reject));

    // player must be connected to load data
    if ($this->swimPlayer->isConnected()) {
      if (isset($rows[0]->getRows()[0])) {
        $row = $rows[0]->getRows()[0];
        $bf = json_decode($row['bedfight'] ?? null, true);
        $sw = json_decode($row['skywars'] ?? null, true);
        $br = json_decode($row['bridge'] ?? null, true);
        $buhc = json_decode($row['buhc'] ?? null, true);
        $fire = json_decode($row['fireball'] ?? null, true);
        $sg = json_decode($row['sg'] ?? null, true);

        if ($this->swimPlayer->isConnected() && $this->swimPlayer->isOnline()) {
          $this->bedFight = $bf ?? $this->bedFight;
          $this->skywars = $sw ?? $this->skywars;
          $this->bridge = $br ?? $this->bridge;
          $this->buhc = $buhc ?? $this->buhc;
          $this->fireball = $fire ?? $this->fireball;
          $this->sg = $sg ?? $this->sg;
        }
      } else {
        $this->saveKits(); // Save default kits if not present in DB
      }
    }
  }

}
