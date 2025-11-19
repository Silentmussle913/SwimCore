<?php

namespace core\systems\scene\replay;

use core\custom\prefabs\pot\SwimDrinkPot;
use core\custom\prefabs\pot\SwimPotItem;
use core\custom\prefabs\props\MovieActor;
use core\SwimCore;
use core\SwimCoreInstance;
use core\systems\map\MapInfo;
use core\systems\player\SwimPlayer;
use core\systems\scene\Scene;
use core\utils\PositionHelper;
use jackmd\scorefactory\ScoreFactory;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\Concrete;
use pocketmine\block\StainedGlass;
use pocketmine\block\utils\DyeColor;
use pocketmine\block\Wool;
use pocketmine\color\Color;
use pocketmine\entity\Location;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Armor;
use pocketmine\item\ArmorTypeInfo;
use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\VanillaEnchantments;
use pocketmine\item\Item;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\VanillaItems;
use pocketmine\math\Vector3;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;
use ReflectionException;

class MovieScene extends Scene
{

  // A movie scene plays the scene replay
  // Reference to the replay recording.
  private SceneReplay $replay;
  private MapInfo $map;

  // The origin used for converting relative positions.
  private Vector3 $replayOrigin;

  /** @var MovieActor[] $movieActors */
  private array $movieActors = [];

  // Playback timing.
  private float $playbackStartTime;

  // Full recordings from the replay.
  private array $fullMovements = [];
  private array $fullInventory = [];
  private array $fullBlockAdds = [];
  private array $fullBlockRemoves = [];
  private array $playerLookUpTable = [];

  // Tick tracking.
  private int $lastProcessedTick = -1;
  private int $timeOffset = 0;
  private float $pauseStart = 0;
  private bool $paused = false;

  public function __construct(SceneReplay $replay, MapInfo $map)
  {
    parent::__construct(SwimCoreInstance::$core, $replay->replayName);
    $this->replay = $replay;
    $this->map = $map;
    $this->replayOrigin = $this->map->getSpawnPos1(); // always uses spawnPos1 as the origin
  }

  /**
   * Initialize the movie scene.
   *
   * Copies full recordings for playback and sets up actors and chunk loaders.
   *
   * @throws ReflectionException
   */
  public function init(): void
  {
    // Copy recordings from the replay.
    $this->fullMovements = $this->replay->recording[SceneReplay::MOVEMENT] ?? [];
    $this->fullInventory = $this->replay->recording[SceneReplay::INVENTORY] ?? [];
    $this->fullBlockAdds = $this->replay->recording[SceneReplay::BLOCK_ADDS] ?? [];
    $this->fullBlockRemoves = $this->replay->recording[SceneReplay::BLOCK_REMOVES] ?? [];
    $this->playerLookUpTable = $this->replay->recording[SceneReplay::PLAYER_NAME_LOOKUP] ?? [];

    $this->playbackStartTime = microtime(true);
    $this->lastProcessedTick = 0;
    $this->timeOffset = 0;

    // Set up chunk loaders and spawn fake players (movie actors).
    $this->setUpChunkLoaders();
    $this->spawnFakePlayers();
  }

  private function setUpChunkLoaders(): void
  {
    foreach ($this->replay->recording[SceneReplay::CHUNK_LOADERS] as $loader) {
      $absolutePos = $this->replayOrigin->add($loader[0], $loader[1], $loader[2]);
      if (SwimCore::$DEBUG) echo "Adding chunk loader $absolutePos \n";
      $this->blocksManager->addChunkLoader($absolutePos);
    }
  }

  /**
   * @throws ReflectionException
   * this only works if all players in the scene are there to start at init time, which is fine for duels
   * this won't work well for FFAs
   */
  private function spawnFakePlayers(): void
  {
    $server = $this->core->getServer();

    // fetch a skin we can use (temporary for now)
    $skin = null;
    if (isset($this->players[0])) {
      $this->players[0]?->sendMessage(TextFormat::YELLOW . "Any offline players in this replay will use your skin and geometry");
      $skin = $this->getPlayers()[0]?->getSkin() ?? null; // this is bad if this is somehow null
    }

    // this is kind of flawed, we only want to spawn players on the tick they first appear with movements
    foreach ($this->fullMovements as $movements) {
      foreach ($movements as $movement) {
        $id = $movement[SceneReplay::PLAYER_NAME_ID] ?? null;

        if ($id === null) {
          continue;
        }

        if (isset($this->movieActors[$id])) {
          continue; // Already spawned.
        }

        $playerName = $this->playerLookUpTable[$id] ?? null;
        if ($playerName === null) {
          continue;
        }

        $relativePos = $movement[SceneReplay::RELATIVE_POS];
        $spawnPos = $this->replayOrigin->add($relativePos[0], $relativePos[1], $relativePos[2]);
        $player = $server->getPlayerExact($playerName);

        if ($player !== null && $player->isOnline()) {
          $sk = $player->getSkin() ?? $skin;
        } else {
          $sk = $skin;
        }

        // Create the MovieActor instance.
        $movieActor = new MovieActor(
          $playerName,
          Location::fromObject($spawnPos, $this->getWorld()),
          $this,
          null,
          $sk
        );

        if (SwimCore::$DEBUG) {
          $str = PositionHelper::toString($spawnPos);
          echo("Spawning movie actor at $str \n");
        }

        $this->movieActors[$id] = $movieActor;
      }
    }
  }

  /**
   * Updates the scene tick.
   * Does not increase ticks once the end of the replay is reached.
   *
   * @throws ScoreFactoryException
   */
  public function updateTick(): void
  {
    $this->scoreboard();
    if ($this->paused) return;

    // Clamp newTick between 0 and maxTick.
    $newTick = $this->getCurrentTick();

    if ($newTick < $this->lastProcessedTick) {
      // Scrubbing backwards: revert blocks/actors to initial state and reprocess ticks.
      $this->resetSceneState();
      for ($tick = 0; $tick <= $newTick; $tick++) {
        $this->processTick($tick);
      }
    } elseif ($newTick > $this->lastProcessedTick) {
      // Process any new ticks.
      for ($tick = $this->lastProcessedTick + 1; $tick <= $newTick; $tick++) {
        $this->processTick($tick);
      }
    }

    $this->lastProcessedTick = $newTick;
  }

  /**
   * @throws ScoreFactoryException
   */
  private function scoreboard(): void
  {
    foreach ($this->players as $player) {
      if ($player->isScoreboardEnabled()) {
        $player->refreshScoreboard(TextFormat::AQUA . "Swimgg.club");
        ScoreFactory::sendObjective($player);

        $ping = $player->getNslHandler()->getPing();

        ScoreFactory::setScoreLine($player, 1, " §bPing: §3" . $ping);
        ScoreFactory::setScoreLine($player, 2, " §bTick: §3" . $this->getCurrentTick());

        ScoreFactory::sendLines($player);
      }
    }
  }

  /**
   * Process events for a specific tick.
   *
   * This method checks for movement, block adds, and block removals recorded exactly at the given tick.
   *
   * @param int $tick
   */
  private function processTick(int $tick): void
  {
    // Process all the recorded actions for this tick

    $this->movement($tick);

    $this->visibleArmor($tick);

    $this->blockAdds($tick);

    $this->blockRemoves($tick);
  }

  private function movement(int $tick): void
  {
    if (isset($this->fullMovements[$tick])) {
      foreach ($this->fullMovements[$tick] as $movement) {
        $id = $movement[SceneReplay::PLAYER_NAME_ID];
        $actor = $this->movieActors[$id] ?? null;

        if ($actor === null) {
          if (SwimCore::$DEBUG) {
            $playerName = $this->playerLookUpTable[$id] ?? "unknown";
            echo("No actor found for $playerName\n");
          }
          continue;
        }

        $relativePos = $movement[SceneReplay::RELATIVE_POS];
        $absolutePos = $this->replayOrigin->add($relativePos[0], $relativePos[1], $relativePos[2]);
        // Teleport the actor directly to the adjusted position for this tick, it's cheaper than entity::move()
        $adjustedPos = $absolutePos->subtract(0, 1.621, 0);
        $actor->teleport($adjustedPos, $movement[SceneReplay::YAW] ?? 0, $movement[SceneReplay::PITCH] ?? 0);

        // Calculate delta
        /*
        $dx = $absolutePos->x - $actor->getPosition()->x;
        $dy = $absolutePos->y - $actor->getPosition()->y;
        $dz = $absolutePos->z - $actor->getPosition()->z;

        // -1.621 for eye height fix
        $actor->move($dx, $dy - 1.621, $dz);
        if (SwimCore::$DEBUG) {
          echo("Moved '$id' to {$actor->getPosition()->asVector3()}\n");
        }

        $actor->setRotation($movement[SceneReplay::YAW], $movement[SceneReplay::PITCH]);
        */
      }
    }
  }

  /**
   * Applies recorded inventory changes (held item and armor) for the given tick to the corresponding movie actors.
   *
   * @param int $tick The tick at which to apply inventory changes.
   */
  private function visibleArmor(int $tick): void
  {
    if (!isset($this->fullInventory[$tick])) {
      return;
    }
    foreach ($this->fullInventory[$tick] as $playerId => $changes) {
      if (!isset($this->movieActors[$playerId])) {
        continue;
      }
      $actor = $this->movieActors[$playerId];
      $this->applyInventory($actor, $changes);
    }
  }

  private function blockAdds(int $tick): void
  {
    if (isset($this->fullBlockAdds[$tick])) {
      foreach ($this->fullBlockAdds[$tick] as $blockData) {
        $relativePos = $blockData[SceneReplay::BLOCK_POSITION];
        $absolutePos = $this->replayOrigin->add($relativePos[0], $relativePos[1], $relativePos[2]);
        $bid = $blockData[SceneReplay::BLOCK_ID];

        $identifier = new BlockIdentifier($bid);
        $typeInfo = new BlockTypeInfo(new BlockBreakInfo(1));

        static $blockTypesWithColor = [
          BlockTypeIds::WOOL => Wool::class,
          BlockTypeIds::CONCRETE => Concrete::class,
          BlockTypeIds::STAINED_GLASS => StainedGlass::class
        ];

        if (isset($blockTypesWithColor[$bid])) {
          $blockClass = $blockTypesWithColor[$bid];
          $block = new $blockClass($identifier, "", $typeInfo);
          if (isset($blockData[SceneReplay::BLOCK_META])) {
            $block->setColor($this->getClosestDyeColor($blockData[SceneReplay::BLOCK_META]));
          }
        } else {
          $block = new Block($identifier, "", $typeInfo);
        }

        $this->blocksManager->placeBlocks([$absolutePos], $block);
        if (SwimCore::$DEBUG) {
          echo "Replaying block add at {$absolutePos->asVector3()}\n";
        }
      }
    }
  }

  private function blockRemoves(int $tick): void
  {
    if (isset($this->fullBlockRemoves[$tick])) {
      foreach ($this->fullBlockRemoves[$tick] as $blockData) {
        $relativePos = $blockData[SceneReplay::BLOCK_POSITION];
        $absolutePos = $this->replayOrigin->add($relativePos[0], $relativePos[1], $relativePos[2]);
        $this->blocksManager->removeBlocks([$absolutePos]);
        if (SwimCore::$DEBUG) {
          echo "Replaying block remove at {$absolutePos->asVector3()}\n";
        }
      }
    }
  }

  /**
   * Resets the scene state for scrubbing.
   *
   * Resets actor positions back to the first recorded position in the movements array and
   * reverts blocks placed by cleaning the map and explicitly removing all blocks from block adds.
   */
  private function resetSceneState(): void
  {
    // Reset each actor to the first recorded position in the fullMovements array.
    foreach ($this->movieActors as $id => $actor) {
      $initialFound = false;
      $ticks = array_keys($this->fullMovements);
      sort($ticks, SORT_NUMERIC);
      foreach ($ticks as $tick) {
        foreach ($this->fullMovements[$tick] as $movement) {
          if ($movement[SceneReplay::PLAYER_NAME_ID] === $id) {
            $relativePos = $movement[SceneReplay::RELATIVE_POS];
            $absolutePos = $this->replayOrigin->add($relativePos[0], $relativePos[1], $relativePos[2]);
            $actor->teleport($absolutePos, $movement[SceneReplay::YAW] ?? 0, $movement[SceneReplay::PITCH] ?? 0);
            $initialFound = true;
            break 2;
          }
        }
      }
      if (!$initialFound) {
        $actor->setRotation(0, 0);
      }

      // Reset inventory: find the earliest inventory record for this actor. This might not fully be good enough.
      $initialInventory = null;
      $invTicks = array_keys($this->fullInventory);
      sort($invTicks, SORT_NUMERIC);
      foreach ($invTicks as $tick) {
        if (isset($this->fullInventory[$tick][$id])) {
          $initialInventory = $this->fullInventory[$tick][$id];
          break;
        }
      }

      if ($initialInventory !== null) {
        $this->applyInventory($actor, $initialInventory);
      }
    }

    // Clean up blocks via blocksManager
    $this->blocksManager->cleanMap();

    // Explicitly remove any blocks that were added to ensure they don't persist.
    $positions = [];
    $remove = false;
    foreach ($this->fullBlockAdds as $blocks) {
      foreach ($blocks as $blockData) {
        $relativePos = $blockData[SceneReplay::BLOCK_POSITION];
        $positions[] = $this->replayOrigin->add($relativePos[0], $relativePos[1], $relativePos[2]);
        $remove = true;
      }
    }

    if ($remove) $this->blocksManager->removeBlocks($positions);

    $this->lastProcessedTick = 0;
  }

  private function applyInventory(MovieActor $actor, array $invData): void
  {
    $armorInv = $actor->getArmorInventory();

    // Apply held item
    if (isset($invData[SceneReplay::HELD_ITEM])) {
      $heldData = $invData[SceneReplay::HELD_ITEM];
      $actor->getMainHandInventory()->setItem(0,
        $this->createPropItem(
          $heldData[SceneReplay::ITEM_ID],
          $heldData[SceneReplay::COLOR_RGBA],
          $this->isArmorItem($heldData[SceneReplay::ITEM_ID]),
          $heldData[SceneReplay::ENCHANTED],
          $heldData[SceneReplay::IS_BLOCK] ?? false
        )
      );
    }

    // Apply armor pieces
    static $armorSlots = [
      SceneReplay::HELMET, // 1
      SceneReplay::CHEST_PLATE, // 2
      SceneReplay::LEGGINGS, // 3
      SceneReplay::BOOTS // 4
    ];

    foreach ($armorSlots as $armorSlot) {
      if (isset($invData[$armorSlot])) {
        $armorData = $invData[$armorSlot];
        $armorInv->setItem($armorSlot - 1, // -1 because 1 off in the armor inventory
          $this->createPropItem(
            $armorData[SceneReplay::ITEM_ID],
            $armorData[SceneReplay::COLOR_RGBA],
            true, // Armor is always true for these slots
            $armorData[SceneReplay::ENCHANTED] ?? false
          // last param isBlock is false by default
          )
        );
      }
    }
  }

  private function createPropItem(int $id, int $color = -1, bool $isArmor = false, bool $enchanted = false, bool $isBlock = false): Item
  {
    // todo: coloring for potions via types
    // we do this special handling because some things break when using fake items like this + need meta coloring
    if ($id == ItemTypeIds::SPLASH_POTION) {
      return new SwimPotItem();
    } else if ($id == ItemTypeIds::POTION) {
      return new SwimDrinkPot();
    }

    if ($isArmor) {
      $item = new Armor(new ItemIdentifier($id), "", new ArmorTypeInfo(0, 0, 0));
      if ($color != -1) $item->setCustomColor(Color::fromRGBA($color));
      if ($enchanted) $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())); // purely visual
      return $item;
    } elseif ($isBlock) {
      // super hack: using wool as colorable block but with a different identifier to appear different, this in theory covers stained-glass and concrete too.
      // this does not seem to work properly for concrete, so that's either a byproduct of this hack, or my getClosestDyeColor function is flawed
      $block = new Wool(new BlockIdentifier($id), "", new BlockTypeInfo(new BlockBreakInfo(0, 0, 0)));
      if ($color != -1) $block->setColor($this->getClosestDyeColor($color)); // only do this if color is even valid
      return $block->asItem();
    }

    // Otherwise it is a regular item
    $item = new Item(new ItemIdentifier($id));
    // I guess we can enchant any item? how does the client treat this?
    if ($enchanted) $item->addEnchantment(new EnchantmentInstance(VanillaEnchantments::UNBREAKING())); // purely visual

    return $item;
  }

  private function getClosestDyeColor(int $color): DyeColor
  {
    // Extract RGBA components (we ignore the alpha channel)
    $r1 = ($color >> 24) & 0xFF;
    $g1 = ($color >> 16) & 0xFF;
    $b1 = ($color >> 8) & 0xFF;

    $closestColor = null;
    $minDistance = PHP_INT_MAX;

    // Iterate over all dye colors
    foreach (DyeColor::cases() as $dyeColor) {
      $rgb = $dyeColor->getRgbValue();

      $r2 = $rgb->getR();
      $g2 = $rgb->getG();
      $b2 = $rgb->getB();

      // Compute Euclidean distance in RGB space
      $distance = ($r1 - $r2) ** 2 + ($g1 - $g2) ** 2 + ($b1 - $b2) ** 2;

      if ($distance < $minDistance) {
        $minDistance = $distance;
        $closestColor = $dyeColor;
      }
    }

    return $closestColor;
  }

  /**
   * Determines if the given item is an armor piece.
   *
   * @param int $itemID
   * @return bool
   */
  private function isArmorItem(int $itemID): bool
  {
    static $armorIds = [
      ItemTypeIds::DIAMOND_HELMET, ItemTypeIds::DIAMOND_CHESTPLATE, ItemTypeIds::DIAMOND_LEGGINGS, ItemTypeIds::DIAMOND_BOOTS,
      ItemTypeIds::IRON_HELMET, ItemTypeIds::IRON_CHESTPLATE, ItemTypeIds::IRON_LEGGINGS, ItemTypeIds::IRON_BOOTS,
      ItemTypeIds::GOLDEN_HELMET, ItemTypeIds::GOLDEN_CHESTPLATE, ItemTypeIds::GOLDEN_LEGGINGS, ItemTypeIds::GOLDEN_BOOTS,
      ItemTypeIds::CHAINMAIL_HELMET, ItemTypeIds::CHAINMAIL_CHESTPLATE, ItemTypeIds::CHAINMAIL_LEGGINGS, ItemTypeIds::CHAINMAIL_BOOTS,
      ItemTypeIds::LEATHER_CAP, ItemTypeIds::LEATHER_TUNIC, ItemTypeIds::LEATHER_PANTS, ItemTypeIds::LEATHER_BOOTS
    ];

    return in_array($itemID, $armorIds, true);
  }

  /**
   * @throws ScoreFactoryException
   */
  public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void
  {
    if (!$this->spectatorControls($event, $swimPlayer)) {
      parent::sceneItemUseEvent($event, $swimPlayer);
    }
  }

  /**
   * @return bool determining if we did an action or not
   * @throws ScoreFactoryException
   */
  protected final function spectatorControls(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): bool
  {
    if ($swimPlayer->getGamemode() == GameMode::SPECTATOR) {
      $itemName = $event->getItem()->getCustomName();
      if ($itemName === TextFormat::RED . "Leave") {
        $swimPlayer->getSceneHelper()->setNewScene('Hub');
        $swimPlayer->sendMessage("§7Teleporting to hub...");
        $this->sceneAnnouncement(TextFormat::AQUA . $swimPlayer->getNicks()->getNick() . " Stopped Spectating");
        return true;
      } elseif ($itemName === TextFormat::RED . "Back") {
        $this->scrubBack(20);
        return true;
      } elseif ($itemName === TextFormat::YELLOW . "Toggle Pause") {
        $this->togglePause();
        return true;
      } elseif ($itemName === TextFormat::GREEN . "Forward") {
        $this->scrubForward(20);
        return true;
      }
    }

    return false;
  }

  /**
   * Returns the maximum tick of the replay based on the recorded events.
   *
   * @return int
   */
  private function getMaxTick(): int
  {
    $maxTick = 0;

    foreach ([$this->fullMovements, $this->fullBlockAdds, $this->fullBlockRemoves] as $recording) {
      if (!empty($recording)) {
        $keys = array_keys($recording);
        $currentMax = max($keys);
        if ($currentMax > $maxTick) $maxTick = $currentMax;
      }
    }

    return $maxTick;
  }

  /**
   * Returns the current tick taking into account the playback start time and any time offset.
   * Clamps the tick between 0 and the replay's maximum tick.
   * If paused, returns the last processed tick.
   *
   * @return int
   */
  private function getCurrentTick(): int
  {
    if ($this->paused) {
      return $this->lastProcessedTick;
    }

    $baseTick = (int)round((microtime(true) - $this->playbackStartTime) * 20);
    $rawTick = $baseTick + $this->timeOffset;
    $maxTick = $this->getMaxTick();

    return ($rawTick < 0) ? 0 : (($rawTick > $maxTick) ? $maxTick : $rawTick);
  }

  /**
   * Scrubs backward by a specified number of ticks.
   * Ensures the effective tick doesn't go below 0 and, when at the maximum replay tick,
   * immediately subtracts ticks so that rewinding takes effect.
   *
   * @param int $ticks
   */
  private function scrubBack(int $ticks): void
  {
    $baseTick = (int)round((microtime(true) - $this->playbackStartTime) * 20);
    $maxTick = $this->getMaxTick();
    $rawTick = $baseTick + $this->timeOffset;

    // If we're at or above max, set timeOffset so effective tick becomes maxTick - ticks.
    if ($rawTick >= $maxTick) {
      $this->timeOffset = ($maxTick - $ticks) - $baseTick;
    } else {
      $this->timeOffset -= $ticks;
    }

    // Ensure we don't go negative.
    if ($baseTick + $this->timeOffset < 0) {
      $this->timeOffset = -$baseTick;
    }

    $newTick = $this->getCurrentTick();
    $this->resetSceneState();
    for ($tick = 0; $tick <= $newTick; $tick++) {
      $this->processTick($tick);
    }

    $this->lastProcessedTick = $newTick;
    $this->sceneAnnouncement(TextFormat::YELLOW . "Rewound replay by $ticks ticks.");
  }

  /**
   * Scrubs forward by a specified number of ticks.
   * Ensures the effective tick doesn't exceed the replay's maximum tick.
   *
   * @param int $ticks
   */
  private function scrubForward(int $ticks): void
  {
    $this->timeOffset += $ticks;
    $baseTick = (int)round((microtime(true) - $this->playbackStartTime) * 20);
    $maxTick = $this->getMaxTick();

    if ($baseTick + $this->timeOffset > $maxTick) {
      $this->timeOffset = $maxTick - $baseTick;
    }

    $newTick = $this->getCurrentTick();
    for ($tick = $this->lastProcessedTick + 1; $tick <= $newTick; $tick++) {
      $this->processTick($tick);
    }

    $this->lastProcessedTick = $newTick;
    $this->sceneAnnouncement(TextFormat::GREEN . "Fast-forwarded replay by $ticks ticks.");
  }

  /**
   * Toggles the pause state of the replay.
   * When resuming, adjusts playbackStartTime to exclude the paused duration.
   */
  private function togglePause(): void
  {
    if (!$this->paused) {
      // Pausing: record the current time.
      $this->pauseStart = microtime(true);
      $this->paused = true;
      $msg = TextFormat::YELLOW . "Paused the Replay!";
    } else {
      // Resuming: calculate how long we were paused.
      $pausedDuration = microtime(true) - $this->pauseStart;
      // Adjust playbackStartTime so that paused time is not counted.
      $this->playbackStartTime += $pausedDuration;
      $this->paused = false;
      $msg = TextFormat::GREEN . "Resumed the Replay!";
    }

    $this->sceneAnnouncement($msg);
  }

  public function kit(SwimPlayer $player): void
  {
    $inv = $player->getInventory();
    $inv->setItem(0, VanillaItems::ARROW()->setCustomName(TextFormat::RED . "Back"));
    $inv->setItem(1, VanillaItems::CLOCK()->setCustomName(TextFormat::YELLOW . "Toggle Pause"));
    $inv->setItem(2, VanillaItems::FEATHER()->setCustomName(TextFormat::GREEN . "Forward"));
  }

  public function playerRemoved(SwimPlayer $player): void
  {
    if ($this->getPlayerCount() <= 0) {
      // kill this scene if no other players left
      $this->sceneSystem->removeScene($this->sceneName);
      if ($player->isOnline()) $player->sendMessage(TextFormat::YELLOW . "You were the last player in the movie scene, closed the movie scene!");
      $this->map->setActive(false);
    }
  }

  /**
   * @param SceneReplay $replay
   * @throws ScoreFactoryException|ReflectionException
   * @var SwimPlayer[] $playersToJoin
   */
  public static function makeMovieScene(SceneReplay $replay, array $playersToJoin): void
  {
    $core = SwimCoreInstance::getInstance();
    $sm = $core->getSystemManager();
    $mapsData = $sm->getMapsData();
    $sceneSystem = $sm->getSceneSystem();

    // first get the needed map
    $map = $mapsData->getMostSimilarNamedMapThatIsAvailable($replay->modeName, $replay->mapName);
    if (!isset($map)) {
      foreach ($playersToJoin as $player) {
        $player->sendMessage(TextFormat::RED . "The map needed for this replay is null, please contact swimfan72 on discord: discord.gg/swim");
        $player->sendMessage(TextFormat::YELLOW . $replay->dumpInfo());
      }
      return;
    }

    if ($map->mapIsActive()) {
      foreach ($playersToJoin as $player) {
        $player->sendMessage(TextFormat::RED . "The map needed for this replay is currently not available. Try again later!");
        $player->sendMessage(TextFormat::YELLOW . $replay->dumpInfo());
      }
      return;
    }

    // get the needed world for the map, make sure its real too
    $worldManager = $core->getServer()->getWorldManager();
    $world = $worldManager->getWorldByName($replay->worldName);

    if (!isset($world)) {
      foreach ($playersToJoin as $player) {
        $player->sendMessage(TextFormat::RED . "The world is null!");
        $player->sendMessage(TextFormat::YELLOW . $replay->dumpInfo());
      }
      return;
    }

    // now make the scene
    $movie = new MovieScene($replay, $map);
    $movie->setWorld($world);
    $movie->sceneName = $replay->replayName;

    $map->setActive(true);
    $sceneSystem->registerScene($movie, $replay->replayName, false);

    $tm = $movie->getTeamManager();
    $specTeam = $tm->makeTeam("spectators", TextFormat::RESET);
    $specTeam->setSpecTeam(true);
    $tm->setSpecTeam($specTeam);

    // add the players
    foreach ($playersToJoin as $player) {
      $player->getSceneHelper()?->setNewScene($replay->replayName);
      $specTeam->addPlayer($player); // will put them into spectator mode
      $pos = $map->getSpawnPos1(); // hopefully this works (it always should)
      $player->teleport(PositionHelper::vecToPos($pos, $world));
      $movie->kit($player);
    }

    $movie->init();
  }

}