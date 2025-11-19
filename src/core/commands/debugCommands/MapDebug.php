<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\map\MapInfo;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\utils\PositionHelper;
use jackmd\scorefactory\ScoreFactoryException;
use jojoe77777\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\world\World;

class MapDebug extends Command
{

  private SwimCore $core;

  private ?World $duelWorld;
  private ?World $miscWorld;
  private ?World $skywarsWorld;

  public function __construct(SwimCore $core)
  {
    parent::__construct("mapdebug", "Debug and teleport to maps", null, []);
    $this->core = $core;
    $this->setPermission("use.op");
    $worldManager = $this->core->getServer()->getWorldManager();
    $this->duelWorld = $worldManager->getWorldByName('duels');
    $this->miscWorld = $worldManager->getWorldByName('miscDuels');
    $this->skywarsWorld = $worldManager->getWorldByName('rankedSkywars');
  }

  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank == Rank::OWNER_RANK) {
        $this->openMapTypesForm($sender);
      } else {
        $sender->sendMessage(TextFormat::RED . "You do not have permission to use this.");
      }
    }
    return true;
  }

  /**
   * Open the initial form to select a map type.
   */
  private function openMapTypesForm(SwimPlayer $player): void
  {
    $form = new SimpleForm(function (SwimPlayer $plr, $data) {
      if ($data === null) return; // Form closed or no input

      // Get the MapsData system
      // $mapsData = $this->core->getSystemManager()->getMapsData();

      $mapPools = [
        'basic' => 'Basic Duel Maps',
        'misc' => 'Misc Maps',
        'battlerush' => 'Battle Rush Maps',
        'skywars' => 'Skywars Maps',
        'bedfight' => 'Bed Fight Maps',
        'fireball fight' => 'Fireball Fight Maps',
        'bridge' => 'Bridge Maps',
        'ranked skywars' => 'Ranked Skywars Maps',
      ];

      if (isset($mapPools[$data])) {
        $this->openMapListForm($plr, $data, $mapPools[$data]);
      }
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Select Map Type");

    // Add buttons for each map pool
    $form->addButton(TextFormat::GOLD . "Basic Duel Maps", 0, "", "basic");
    $form->addButton(TextFormat::GREEN . "Misc Maps", 0, "", "misc");
    $form->addButton(TextFormat::AQUA . "Battle Rush Maps", 0, "", "battlerush");
    $form->addButton(TextFormat::LIGHT_PURPLE . "Skywars Maps", 0, "", "skywars");
    $form->addButton(TextFormat::RED . "Bed Fight Maps", 0, "", "bedfight");
    $form->addButton(TextFormat::DARK_RED . "Fireball Fight Maps", 0, "", "fireball fight");
    $form->addButton(TextFormat::BLUE . "Bridge Maps", 0, "", "bridge");
    $form->addButton(TextFormat::AQUA . "Ranked Skywars Maps", 0, "", "ranked skywars");

    $player->sendForm($form);
  }

  /**
   * Open the form that lists all maps from the selected map pool.
   */
  private function openMapListForm(SwimPlayer $player, string $mapPoolKey, string $mapPoolName): void
  {
    $mapsData = $this->core->getSystemManager()->getMapsData();

    // Fetch the map pool based on the mode
    $mapPool = $mapsData->getMapPoolFromMode($mapPoolKey);

    if ($mapPool === null) {
      $player->sendMessage(TextFormat::RED . "No maps available for this mode.");
      return;
    }

    // Assuming map pool classes have a method like `getMaps()` to get all maps
    $maps = $mapPool->getMaps();

    if (empty($maps)) {
      $player->sendMessage(TextFormat::RED . "No maps available for this mode.");
      return;
    }

    $form = new SimpleForm(function (SwimPlayer $plr, $data) use ($maps, $mapPoolKey) {
      if ($data === null) return; // Form closed or no input

      if (isset($maps[$data])) {
        $this->teleportPlayerToMap($plr, $mapPoolKey, $maps[$data]);
      }
    });

    $form->setTitle(TextFormat::DARK_GREEN . "Pick a Map from " . $mapPoolName);

    foreach ($maps as $index => $map) {
      $form->addButton(TextFormat::YELLOW . $map->getMapName(), 0, "", $index);
    }

    $player->sendForm($form);
  }

  /**
   * Teleports the player to the spawn position of the selected map.
   * @throws ScoreFactoryException
   */
  private function teleportPlayerToMap(SwimPlayer $player, string $mode, MapInfo $map): void
  {
    $world = $this->getWorldBasedOnMode($mode);
    $spawnPosition = $map->getSpawnPos1();
    $sceneSystem = $this->core->getSystemManager()->getSceneSystem();
    $sceneSystem->setScene($player, $sceneSystem->getScene('GodMode'));
    $player->teleport(PositionHelper::vecToPos($spawnPosition, $world)); // $world->getSafeSpawn($spawnPosition)
    $player->sendMessage(TextFormat::GREEN . "Teleported to map " . $map->getMapName());
  }

  /**
   * Get the world based on the mode.
   */
  private function getWorldBasedOnMode(string $mode): World
  {
    return match ($mode) {
      'misc', 'bridge', 'bedfight', 'battlerush', 'skywars' => $this->miscWorld,
      'ranked skywars' => $this->skywarsWorld,
      default => $this->duelWorld, // fireball fight as well
    };
  }

}
