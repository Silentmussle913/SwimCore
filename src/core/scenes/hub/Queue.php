<?php

namespace core\scenes\hub;

use core\custom\behaviors\player_event_behaviors\MaxDistance;
use core\custom\prefabs\hub\HubEntities;
use core\scenes\duel\Duel;
use core\SwimCore;
use core\systems\map\MapsData;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\systems\scene\DuelInfo;
use core\systems\scene\misc\Team;
use core\systems\scene\Scene;
use core\utils\BehaviorEventEnum;
use core\utils\PositionHelper;
use core\utils\TimeHelper;
use FilesystemIterator;
use jackmd\scorefactory\ScoreFactory;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\block\utils\DyeColor;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\world\World;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use ReflectionException;
use SplFileInfo;
use Symfony\Component\Filesystem\Path;

class Queue extends Scene
{

  /** @var array<string, DuelInfo> mode => DuelInfo */
  private array $modeRegistry = [];

  protected MapsData $mapsData;
  protected ?World $duelWorld;
  protected ?World $miscWorld; // bridge, bed fight, battle rush

  public static function AutoLoad(): bool
  {
    return true;
  }

  /**
   * @throws ReflectionException
   */
  public function init(): void
  {
    $this->registerCanceledEvents([
      BehaviorEventEnum::ENTITY_DAMAGE_EVENT,
      BehaviorEventEnum::ENTITY_DAMAGE_BY_ENTITY_EVENT,
      BehaviorEventEnum::ENTITY_DAMAGE_BY_CHILD_ENTITY_EVENT,
      BehaviorEventEnum::PLAYER_DROP_ITEM_EVENT,
      BehaviorEventEnum::PROJECTILE_LAUNCH_EVENT,
      BehaviorEventEnum::BLOCK_BREAK_EVENT,
      BehaviorEventEnum::BLOCK_PLACE_EVENT,
      BehaviorEventEnum::PLAYER_ITEM_CONSUME_EVENT
    ]);

    // set up worlds
    $worldManager = $this->core->getServer()->getWorldManager();
    $this->duelWorld = $worldManager->getWorldByName('duels');
    $this->miscWorld = $worldManager->getWorldByName('miscDuels');

    // spawn hub entities
    HubEntities::spawnToScene($this);

    // get maps data system
    $this->mapsData = $this->core->getSystemManager()->getMapsData();

    // load the queue
    $this->deserialize();

    // we need to make teams
    $this->initTeams();
  }

  protected function deserialize(): void
  {
    $scenesRoot = Path::canonicalize(Path::join(__DIR__, '..')); // core/scenes
    $duelsConfig = Path::canonicalize(Path::join($this->core::$customDataFolder, 'duels.json'));

    echo("Loading duels from $duelsConfig \n");
    echo("Scanning scenes from $scenesRoot \n");

    if (!is_file($duelsConfig)) {
      echo("WARN: duels.json not found; registry remains empty.\n");
      return;
    }

    $raw = file_get_contents($duelsConfig);
    if ($raw === false) {
      echo("ERROR: failed to read duels.json\n");
      return;
    }

    $rows = json_decode($raw, true);
    if (!is_array($rows)) {
      echo("ERROR: duels.json invalid JSON\n");
      return;
    }

    // Reflective index of non-abstract Duel subclasses
    $classIndex = $this->buildScenesClassIndex($scenesRoot);

    // Clear previous (hot-reload safety)
    $this->modeRegistry = [];

    foreach ($rows as $row) {
      if (!is_array($row)) continue;

      $mode = (string)($row['modeName'] ?? '');
      if ($mode === '') continue;

      $modeLc = strtolower($mode);
      $enabled = (bool)($row['enabled'] ?? false);

      // We still want it in our data, as we just use the enabled as flag as a filter for if they are queueable,
      // or only from special entry points, like block in practice for example.
      // if (!$enabled) continue;

      // Loose lookup by normalized ("fireballfight") then plain lc ("bedfight")
      $normKey = MapsData::normalizeKey($mode);
      $fqcn = $classIndex[$normKey] ?? $classIndex[$modeLc] ?? null;

      if ($fqcn === null || !class_exists($fqcn)) {
        echo("WARN: could not resolve classPath for mode '$mode' (tried '$normKey'/'$modeLc')\n");
        continue;
      }

      $decoratedName = (string)($row['decoratedName'] ?? ucfirst($modeLc));
      $worldFolderName = (string)($row['worldFolderName'] ?? 'duels');
      $isMisc = (bool)($row['isMisc'] ?? false);
      $isRanked = (bool)($row['isRanked'] ?? false);

      echo("Registering duel mode: $modeLc \n");

      $this->modeRegistry[$modeLc] = new DuelInfo(
        modeName: $modeLc,
        decoratedName: $decoratedName,
        classPath: $fqcn,              // resolved by scan (NOT from JSON)
        worldFolderName: $worldFolderName,
        isMisc: $isMisc,
        isRanked: $isRanked,
        enabled: $enabled
      );
    }

    // Associate modes directly (keys = mode, values = DuelInfo)
    if (!empty($this->modeRegistry)) {
      Duel::$MODES = $this->modeRegistry;
    }

    // print safe list of mode keys (values are objects)
    echo("Registered modes: " . implode(', ', array_keys(Duel::$MODES)) . "\n");
  }

  private function buildScenesClassIndex(string $scenesRoot): array
  {
    $duelRoot = $scenesRoot . DIRECTORY_SEPARATOR . 'duel';
    $idx = [];

    if (!is_dir($duelRoot)) {
      echo("WARN: duel folder not found at $duelRoot\n");
      return $idx;
    }

    $rii = new RecursiveIteratorIterator(
      new RecursiveDirectoryIterator($duelRoot, FilesystemIterator::SKIP_DOTS)
    );

    /** @var SplFileInfo $file */
    foreach ($rii as $file) {
      if (!$file->isFile() || strtolower($file->getExtension()) !== 'php') continue;

      // Get path relative to scenes root using Path::makeRelative (handles Windows)
      $relative = Path::makeRelative($file->getPathname(), $scenesRoot);
      // Normalize to namespace separators and drop .php
      $relative = str_replace(['/', '\\'], '\\', $relative);
      $relative = preg_replace('/\.php$/i', '', $relative);

      // FQCN like core\scenes\duel\FireballFight
      $fqcn = 'core\\scenes\\' . $relative;

      // Make sure the class exists via autoloader
      if (!class_exists($fqcn)) {
        echo("WARN: class not found (skipping): {$fqcn}\n");
        continue;
      }

      $rc = new ReflectionClass($fqcn);
      if ($rc->isAbstract()) continue;
      if (!$rc->isSubclassOf(Duel::class)) continue;

      $short = $rc->getShortName();           // e.g., FireballFight
      $keyLc = strtolower($short);            // "fireballfight" or "bedfight"
      $keyNZ = MapsData::normalizeKey($short);   // "fireballfight"

      // Index by both loose keys
      $idx[$keyLc] = $fqcn;
      $idx[$keyNZ] = $fqcn;
    }

    return $idx;
  }

  protected function initTeams(): void
  {
    foreach (Duel::$MODES as $mode => $data) {
      if (!$data->enabled) continue;
      $team = $this->teamManager->makeTeam($mode, TextFormat::RESET, true);
      $team->setScore(2); // score is to represent how many players is required for this game to start
    }
  }

  /**
   * @throws ScoreFactoryException
   */
  protected function checkQueues(): void
  {
    foreach ($this->teamManager->getTeams() as $team) {
      $team->pruneOffline(); // prune it first for safety
      $size = $team->getTeamSize();
      $requiredSize = $team->getScore();
      if ($requiredSize > 2) continue; // avoid queuing games that need a team size of over 2 as we need more special queue logic for that
      if ($size >= $requiredSize || (SwimCore::$DEBUG && $size >= 1)) { // can self queue in debug mode
        // we can start the duel if the mode has an available map
        if ($this->mapsData->modeHasAvailableMap(strtolower($team->getTeamName()))) {
          $this->startDuel($team);
          break; // to prevent a weird bug that was caused when players join the queue in the same tick. This is shoving the problem under the bed, but it should be fine now.
        }
      }
    }
  }

  /* Legacy just to show how modes share some of the same maps due to them being basic duels that work on the same maps
  public function getWorldBasedOnMode(string $mode): World
  {
    return match ($mode) {
      default => $this->duelWorld, // fireball fight as well uses duelWorld
      'bridge', 'bedfight', 'battlerush', 'skywars' => $this->miscWorld,
      'scrim', 'blockin' => $this->scrimWorld
    };
  }
  */

  public function getWorldBasedOnMode(string $mode): World
  {
    $entry = $this->modeRegistry[strtolower($mode)] ?? null;

    if ($entry === null) {
      // fallback
      return $this->duelWorld ?? $this->core->getServer()->getWorldManager()->getDefaultWorld();
    }

    return $this->core->getServer()->getWorldManager()->getWorldByName($entry->worldFolderName) ?? $this->duelWorld;
  }

  /**
   * @throws ScoreFactoryException
   */
  private function startDuel(Team $team): void
  {
    $players = $team->getFirstTwoPlayers();

    if (SwimCore::$DEBUG && isset($players[0])) { // in debug, you can queue your self to solo test games
      $this->publicDuelStart($players[0], $players[0], $team->getTeamName());
    } elseif (isset($players[0]) && isset($players[1])) {
      // stupid fix to make sure they are online before doing a queue
      if ($players[0]->isOnline() && $players[1]->isOnline()) {
        $this->publicDuelStart($players[0], $players[1], $team->getTeamName());
      }
    }
  }

  // party also uses this method when it is making a party duel
  public function makeDuelSceneFromMode(string $mode, string $duelName, string $mapName): ?Duel
  {
    $mode = strtolower($mode);
    $entry = $this->modeRegistry[$mode] ?? null;

    if ($entry === null) {
      echo("ERROR: unknown duel mode '$mode'\n");
      return null;
    }

    $world = $this->getWorldBasedOnMode($mode);
    $this->worldFix($world, $mode, $mapName); // Specific to swim.gg jank

    return new $entry->classPath($this->core, $duelName, $world, $mode);
  }

  // in place sets the world to misc world if needed
  public function worldFix(World &$world, string $mode, string $mapName): void
  {
    if ($this->mapsData->modeUsesBasicMaps($mode)) {
      if ($this->mapsData->needsToUseMiscWorld($mapName)) {
        $world = $this->miscWorld;
        if (SwimCore::$DEBUG) {
          echo($mode . " Duel on map " . $mapName . " is in the misc world\n");
        }
      }
    }
  }

  /**
   * @throws ScoreFactoryException
   */
  public function publicDuelStart(SwimPlayer $playerOne, SwimPlayer $playerTwo, string $mode, string $mapName = 'random'): void
  {
    // get a map
    if ($mapName === 'random') {
      $map = $this->mapsData->getRandomMapFromMode($mode);
    } else {
      $map = $this->mapsData->getFirstInactiveMapByBaseNameFromMode($mode, $mapName);
      // make sure not in use
      if ($map->mapIsActive()) {
        // if was in use, we have to randomize it instead
        $map = $this->mapsData->getRandomMapFromMode($mode);
        $msg = TextFormat::YELLOW . "The selected map is in use, had to pick a random map instead";
        $playerOne->sendMessage($msg);
        $playerTwo->sendMessage($msg);
      }
    }

    // this is awful if this happens
    if ($map == null) {
      $msg = TextFormat::RED . "ERROR: no map in available at this time";
      $playerOne->sendMessage($msg);
      $playerTwo->sendMessage($msg);
      return;
    }

    // make duel name of player nicks
    $nameOne = $playerOne->getNicks()->getNick();
    $nameTwo = $playerTwo->getNicks()->getNick();
    $duelName = $mode . ': ' . $nameOne . ' vs ' . $nameTwo;

    // unique team 2 name when in debug
    if (SwimCore::$DEBUG) {
      $nameTwo .= " Debug";
    }

    // make the correct duel type
    $duel = $this->makeDuelSceneFromMode($mode, $duelName, $map->getMapName());

    // just in case
    if ($duel == null) {
      $msg = TextFormat::RED . "ERROR: failed to register new duel scene: " . $duelName;
      $playerOne->sendMessage($msg);
      $playerTwo->sendMessage($msg);
      return;
    }

    $map->setActive(true);
    $duel->setMap($map);

    // make the teams and register the scene
    $teamOne = $duel->teamManager->makeTeam($nameOne, TextFormat::RED, false, 3);
    $teamTwo = $duel->teamManager->makeTeam($nameTwo, TextFormat::BLUE, false, 3);
    $this->sceneSystem->registerScene($duel, $duelName, false);

    // set spawn points to correct world
    $world = $duel->getWorld();

    $teamOne->addSpawnPoint(0, PositionHelper::vecToPos($map->getSpawnPos1(), $world));
    $teamTwo->addSpawnPoint(0, PositionHelper::vecToPos($map->getSpawnPos2(), $world));

    // now move the players into the duel
    $playerOne->getSceneHelper()->setNewScene($duelName);
    $playerTwo->getSceneHelper()->setNewScene($duelName);

    // set teams
    $teamOne->addPlayer($playerOne);
    $teamTwo->addPlayer($playerTwo);

    // init the duel now that we set all this data
    $duel->init();

    // say map the match is on and the opponent
    $duel->sceneAnnouncement(TextFormat::GREEN . "Found Match on: " . TextFormat::YELLOW . $map->getMapName());

    // Elo messaging if applicable
    $msgOne = TextFormat::GREEN . "Opponent: " . $playerTwo->getRank()->rankString();
    $msgTwo = TextFormat::GREEN . "Opponent: " . $playerOne->getRank()->rankString();
    if ($duel->isRanked()) {
      $pOneElo = $playerOne->getAttributes()?->getEloFromGame($mode) ?? 1000;
      $pTwoElo = $playerTwo->getAttributes()?->getEloFromGame($mode) ?? 1000;
      $msgOne .= TextFormat::RESET . TextFormat::DARK_GRAY . " (" . TextFormat::YELLOW . $pTwoElo . " Elo" . TextFormat::DARK_GRAY . ")";
      $msgTwo .= TextFormat::RESET . TextFormat::DARK_GRAY . " (" . TextFormat::YELLOW . $pOneElo . " Elo" . TextFormat::DARK_GRAY . ")";
      $pOneSelfMessage = TextFormat::YELLOW . "Your Elo: " . TextFormat::GREEN . $pOneElo;
      $pTwoSelfMessage = TextFormat::YELLOW . "Your Elo: " . TextFormat::GREEN . $pTwoElo;
      // show the opponent first
      $playerOne->sendMessage($msgOne);
      $playerTwo->sendMessage($msgTwo);
      // then your elo
      $playerOne->sendMessage($pOneSelfMessage);
      $playerTwo->sendMessage($pTwoSelfMessage);
    } else {
      // otherwise just show the opponent but with no elo appended
      $playerOne->sendMessage($msgOne);
      $playerTwo->sendMessage($msgTwo);
    }

    // warp in physically
    $duel->warpPlayersIn();
    if (SwimCore::$DEBUG) $duel->dumpDuel();
  }

  /**
   * @throws ScoreFactoryException
   */
  public function updateSecond(): void
  {
    if (!empty($this->players)) {
      $this->checkQueues();
      foreach ($this->teamManager->getTeams() as $team) {
        $teamName = $team->getTeamName();
        foreach ($team->getPlayers() as $player) {
          $this->queueTag($player);
          $this->queueBoard($player, $teamName);
        }
      }
    }
  }

  /**
   * @throws ScoreFactoryException
   */
  private function queueBoard(SwimPlayer $swimPlayer, string $mode): void
  {
    $attributes = $swimPlayer->getAttributes();
    $time = $attributes->getAttribute('seconds') + 1;
    $attributes->setAttribute('seconds', $time);

    if ($swimPlayer->isScoreboardEnabled()) {
      try {
        $swimPlayer->refreshScoreboard(TextFormat::AQUA . "Swimgg.club");
        ScoreFactory::sendObjective($swimPlayer);
        // variables needed
        $onlineCount = count($swimPlayer->getServer()->getOnlinePlayers());
        $maxPlayers = $swimPlayer->getServer()->getMaxPlayers();
        $ping = $swimPlayer->getNslHandler()->getPing();
        $time = TimeHelper::digitalClockFormatter($time);
        $line = 0;
        ScoreFactory::setScoreLine($swimPlayer, ++$line, " §bOnline: §f" . $onlineCount . "§7 / §3" . $maxPlayers);
        ScoreFactory::setScoreLine($swimPlayer, ++$line, " §bPing: §3" . $ping);
        ScoreFactory::setScoreLine($swimPlayer, ++$line, " §bQueued: §3" . $this->sceneSystem->getQueuedCount());
        ScoreFactory::setScoreLine($swimPlayer, ++$line, " §bIn Duel: §3" . $this->sceneSystem->getInDuelsCount());
        ScoreFactory::setScoreLine($swimPlayer, ++$line, " §bQueuing: §3" . ucfirst($mode));
        ScoreFactory::setScoreLine($swimPlayer, ++$line, " §b" . $time);
        // send lines
        ScoreFactory::sendLines($swimPlayer);
      } catch (ScoreFactoryException $e) {
        Server::getInstance()->getLogger()->info($e->getMessage());
      }
    }
  }

  public function playerAdded(SwimPlayer $player): void
  {
    $player->getEventBehaviorComponentManager()->registerComponent(new MaxDistance("max", $this->core, $player));
    $player->getAttributes()->setAttribute('seconds', 0);
    $player->getCosmetics()->refresh();
    $this->queueKit($player);
    if ($player->getRank()?->getRankLevel() ?? 0 >= Rank::BOOSTER_RANK) $player->setAllowFlight(true);
  }

  private function queueKit(Player $player): void
  {
    $player->setGamemode(GameMode::ADVENTURE);
    $player->getInventory()->setItem(0, VanillaItems::DYE()->setColor(DyeColor::RED())->setCustomName(TextFormat::RED . "Leave Queue"));
  }

  /**
   * @throws ScoreFactoryException
   */
  function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void
  {
    if ($event->getItem()->getName() == TextFormat::RED . "Leave Queue") {
      $swimPlayer->sendMessage(TextFormat::YELLOW . "Left the Queue");
      $swimPlayer->getSceneHelper()->setNewScene('Hub');
    }
  }

  protected function queueTag(SwimPlayer $swimPlayer): void
  {
    // $swimPlayer->genericNameTagHandling();
    $swimPlayer->getCosmetics()->tagNameTag();
    $teamName = $this->getPlayerTeam($swimPlayer)?->getTeamName();
    if (!$teamName) return;
    $swimPlayer->setScoreTag(TextFormat::GREEN . "Queuing " . TextFormat::YELLOW . ucfirst($teamName));
  }

}
