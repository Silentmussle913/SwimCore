<?php

namespace core\systems\scene\managers;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\systems\scene\misc\BlockTicker;
use core\systems\scene\replay\SceneRecorder;
use core\systems\scene\Scene;
use core\utils\PositionHelper;
use core\utils\TimeHelper;
use pocketmine\block\Block;
use pocketmine\block\VanillaBlocks;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\block\BlockFormEvent;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\block\BlockSpreadEvent;
use pocketmine\event\player\PlayerBucketEmptyEvent;
use pocketmine\math\Vector3;
use pocketmine\Server;
use pocketmine\world\World;

class BlocksManager
{

  // Old array of array version
  // int vectorHash => [self::BLOCK => Block $block, int self::TIME => $time, Vector3 self::POSITION => $vec]

  /* Deprecated key const look up values for the old array structure
    public const TIME = 0;
    public const BLOCK = 1;
    public const POSITION = 2;
  */

  /**
   * @var BlockEntry[]
   * @brief key is an int of a vector3 hash
   */
  private array $placedBlocks; // logs the blocks placed by player

  /**
   * @var BlockEntry[]
   * @brief key is an int of a vector3 hash
   */
  private array $brokenMapBlocks; // logs the blocks that were part of the map and got broken

  /**
   * @var int[]
   */
  private array $allowedToBreakFromMap; // blocks the player is allowed to break in the map

  private bool $canPlaceBlocks;
  private bool $canBreakBlocks; // only applies to player placed blocks
  private bool $canBreakRegisteredBlocks; // if we can break blocks registered in our allow list, this override can break map blocks
  private bool $canBreakMapBlocks; // also applies to breaking pre-made map blocks
  private bool $prunes; // if replaces broken and placed blocks
  private bool $pruneReplaceBrokenBlocks = true; // if broken map blocks should be replaced during pruning
  private bool $pruneRemovePlacedBlocks = true; // if placed blocks should be removed during pruning

  private World $world; // so server knows what world to place blocks back in during clean up

  private int $brokenLifeTime;
  private int $placedLifeTime;

  private SwimCore $core;
  private Server $server;
  private Scene $parentScene;
  private SceneRecorder $recorder;

  /**
   * key is Vector3
   * @var BlockTicker[]
   */
  private array $chunksToKeepAlive;

  // TODO: have block ticker positions be saved in the replay to be used there as well in its own blocks manager

  public function __construct
  (
    Scene    $parentScene,
    SwimCore $core,
    World    $world,
    bool     $canPlaceBlocks = false,
    bool     $canBreakBlocks = false,
    bool     $canBreakMapBlocks = false,
    bool     $prune = false
  )
  {
    $this->parentScene = $parentScene;
    $this->core = $core;
    $this->server = $this->core->getServer();
    $this->world = $world;
    $this->placedBlocks = [];
    $this->brokenMapBlocks = [];
    $this->allowedToBreakFromMap = [];
    $this->chunksToKeepAlive = [];
    $this->canPlaceBlocks = $canPlaceBlocks;
    $this->canBreakBlocks = $canBreakBlocks;
    $this->canBreakMapBlocks = $canBreakMapBlocks;
    $this->canBreakRegisteredBlocks = $canBreakMapBlocks;
    $this->prunes = $prune;

    $this->recorder = $this->parentScene->getSceneRecorder();

    // how long in ticks for a block to be replaced back to what it was, by default is 5 minutes
    $this->brokenLifeTime = TimeHelper::minutesToTicks(5);
    $this->placedLifeTime = $this->brokenLifeTime;
  }

  public function addToAllowedToBreakList(int $blockId): void
  {
    $this->allowedToBreakFromMap[$blockId] = true;
  }

  public function removeFromAllowedToBreakList(int $blockId): void
  {
    unset($this->allowedToBreakFromMap[$blockId]);
  }

  public function allowedToBreak(int $blockId): bool
  {
    return isset($this->allowedToBreakFromMap[$blockId]);
  }

  /**
   * @return bool
   */
  public function isPrunes(): bool
  {
    return $this->prunes;
  }

  /**
   * @param bool $prunes
   */
  public function setPrunes(bool $prunes = true): void
  {
    $this->prunes = $prunes;
  }

  public function setPruneReplaceBrokenBlocks(bool $prunes = true): void
  {
    $this->pruneReplaceBrokenBlocks = $prunes;
  }

  public function setPruneRemovePlacedBlocks(bool $prunes = true): void
  {
    $this->pruneRemovePlacedBlocks = $prunes;
  }

  /**
   * @return int
   */
  public function getBrokenLifeTime(): int
  {
    return $this->brokenLifeTime;
  }

  /**
   * @return int
   */
  public function getPlacedLifeTime(): int
  {
    return $this->placedLifeTime;
  }

  /**
   * @param int $brokenLifeTime
   */
  public function setBrokenLifeTime(int $brokenLifeTime): void
  {
    $this->brokenLifeTime = $brokenLifeTime;
  }

  /**
   * @param int $placedLifeTime
   */
  public function setPlacedLifeTime(int $placedLifeTime): void
  {
    $this->placedLifeTime = $placedLifeTime;
  }

  /**
   * Checks if a hashed Vector3 key exists in the given array.
   * @param Vector3 $vector The Vector3 object to generate the hash key.
   * @param array $array The array to check for the key.
   * @return bool True if the key exists, false otherwise.
   */
  private function isHashKeyInArray(Vector3 $vector, array $array): bool
  {
    return isset($array[PositionHelper::getVectorHashKey($vector)]);
  }

  /**
   * Adds a Vector3 object to an array using a hashed Vector3 key.
   * @param array $array The array to add to.
   * @param BlockEntry $entry The entry to add to the array.
   */
  public function addBlockEntryToArrayWithVector3Key(array &$array, BlockEntry $entry): void
  {
    $key = PositionHelper::getVectorHashKey($entry->position);
    $entry->key = $key;
    $array[$key] = $entry;

    // we need to record placed blocks and broken map blocks depending on the array we are modifying, this is a bit of a hack
    if ($this->recorder->isRecording()) {
      if ($array === $this->placedBlocks) {
        $this->recorder->onBlockAdd($entry->block, $entry->position);
      } elseif ($array === $this->brokenMapBlocks) {
        $this->recorder->onBlockRemove($entry->block, $entry->position);
      }
    }
  }

  public function handleBlockPlace(BlockPlaceEvent $event): void
  {
    $id = $event->getPlayer()->getId();
    $time = $this->core->getServer()->getTick() + $this->placedLifeTime;
    if ($this->canPlaceBlocks) {
      foreach ($event->getTransaction()->getBlocks() as [$x, $y, $z, $block]) {
        $vec = new Vector3($x, $y, $z);
        $entry = new BlockEntry($vec, $block, $time);
        $this->addBlockEntryToArrayWithVector3Key($this->placedBlocks, $entry);
        $entry->ownerEntity = $id;
      }
    } else {
      // how would you have blocks to place if the duel has block placements disabled?
      $event->cancel();
    }
  }

  public function handleBlockBreak(BlockBreakEvent $event): void
  {
    $allowed = $this->handleBlockBreakOnBlock($event->getBlock(), $event->getPlayer()->getId());
    if (!$allowed) $event->cancel();
  }

  // returns if the block was allowed to be broken
  public function handleBlockBreakOnBlock(Block $block, int $ownerID = -1): bool
  {
    // first check if we are allowed to break blocks, if not then cancel and return
    if (!$this->canBreakBlocks) {
      return false;
    }

    // get the block
    $position = $block->getPosition();
    $time = $this->server->getTick() + $this->brokenLifeTime;

    // get if the block we broke is a player placed block
    $inPlacedBlocks = $this->isInPlacedBlocks($position);

    // if we can break map blocks, or we can break registered blocks and the block is registered, then we can just log and return
    // checking via state id is kinda sus
    if ($this->canBreakMapBlocks ||
      ($this->canBreakRegisteredBlocks && ($this->allowedToBreak($block->getTypeId()) || $this->allowedToBreak($block->getStateId())))
    ) {
      // if the block we broke was not in the player placed blocks array, we log it as needs to be replaced since it was part of the map
      if (!$inPlacedBlocks) {
        $entry = new BlockEntry($position, $block, $time);
        if (SwimCore::$DEBUG) {
          $str = PositionHelper::toString($position);
          echo("$str {$block->getName()} broken map block, OK!\n");
        }
        $this->addBlockEntryToArrayWithVector3Key($this->brokenMapBlocks, $entry);
        $entry->ownerEntity = $ownerID;
        return true;
      }
    }

    // record it no matter what if we end up getting here
    if ($this->recorder->isRecording()) $this->recorder->onBlockRemove($block, $position);

    if (SwimCore::$DEBUG) {
      $str = PositionHelper::toString($position);
      if (!$inPlacedBlocks) {
        echo("$str {$block->getName()} attempting breaking block but not in placed blocks, CANCEL!\n");
      } else {
        echo("$str {$block->getName()} breaking placed block, OK!\n");
      }
    }

    // at this point if the broken block cords is in the placedBlocks array, that means it was allowed to be broken since it was placed by a player during the match
    return $inPlacedBlocks;
  }

  public function handleNaturalBlockEvent(BlockFormEvent|BlockSpreadEvent $event): void
  {
    $time = $this->server->getTick() + $this->placedLifeTime;
    $block = $event->getBlock();
    $position = $block->getPosition();
    $entry = new BlockEntry($position, $block, $time);
    $this->addBlockEntryToArrayWithVector3Key($this->placedBlocks, $entry);
  }

  public function handleBucketDump(PlayerBucketEmptyEvent $event): void
  {
    $time = $this->server->getTick() + $this->placedLifeTime;
    $blockFace = $event->getBlockFace();
    $blockClicked = $event->getBlockClicked();

    // Calculate the position offset by 1 in the correct axis determined by the block face
    $position = $blockClicked->getSide($blockFace)->getPosition();

    // Determine the type of block (water or lava) being placed
    // $block = $event->getItem()->getTypeId() == ItemTypeIds::WATER_BUCKET ? VanillaBlocks::WATER() : VanillaBlocks::LAVA();
    $block = $this->world->getBlock($position); // probably fine to just log what is already there

    $entry = new BlockEntry($position, $block, $time);

    // Add the block to the placedBlocks array with the calculated position and time
    $this->addBlockEntryToArrayWithVector3Key($this->placedBlocks, $entry);
  }

  private function isInPlacedBlocks(Vector3 $vector3): bool
  {
    return $this->isHashKeyInArray($vector3, $this->placedBlocks);
  }

  // sets all placed blocks back to air
  public function clearPlacedBlocks(): void
  {
    foreach ($this->placedBlocks as $data) {
      $pos = $data->position;
      // have to check if terrain is loaded, this might not be nice on performance
      if ($this->world->isInLoadedTerrain($pos)) {
        $this->world->setBlock($pos, VanillaBlocks::AIR());
      }
    }
    $this->placedBlocks = [];
  }

  // sets all blocks broken from the map back to what they were
  public function replaceBrokenMapBlocks(): void
  {
    foreach ($this->brokenMapBlocks as $data) {
      // have to check if terrain is loaded, this might not be nice on performance
      if ($this->world->isInLoadedTerrain($data->position)) {
        $this->world->setBlock($data->position, $data->block);
      }
    }
    $this->brokenMapBlocks = [];
  }

  public function cleanMap(): void
  {
    // actually we don't need a pointer in this class to the parent scene, so we can't log which map is cleaned
    if (SwimCore::$DEBUG) echo("Cleaning map\n");
    $this->clearPlacedBlocks();
    $this->replaceBrokenMapBlocks();
    $this->clearChunkLoaders();
  }

  public function resetBlocksFromPlayer(SwimPlayer $player, bool $doBroken, bool $doPlaced): void
  {
    $id = $player->getId();

    if ($doBroken) {
      foreach ($this->brokenMapBlocks as $key => $data) {
        // have to check if terrain is loaded, this might not be nice on performance
        if ($data->ownerEntity == $id) {
          if ($this->world->isInLoadedTerrain($data->position)) {
            $this->world->setBlock($data->position, $data->block);
            // remove this entry from broken map blocks
            unset($this->brokenMapBlocks[$key]);
          }
        }
      }
    }

    if ($doPlaced) {
      foreach ($this->placedBlocks as $key => $data) {
        // have to check if terrain is loaded, this might not be nice on performance
        if ($data->ownerEntity == $id) {
          if ($this->world->isInLoadedTerrain($data->position)) {
            $this->world->setBlock($data->position, VanillaBlocks::AIR());
            // remove this entry from placed map blocks
            unset($this->placedBlocks[$key]);
          }
        }
      }
    }
  }

  // Getter for canPlaceBlocks
  public function getCanPlaceBlocks(): bool
  {
    return $this->canPlaceBlocks;
  }

  // Setter for canPlaceBlocks
  public function setCanPlaceBlocks(bool $canPlaceBlocks): void
  {
    $this->canPlaceBlocks = $canPlaceBlocks;
  }

  // Getter for canBreakBlocks
  public function getCanBreakBlocks(): bool
  {
    return $this->canBreakBlocks;
  }

  // Setter for canBreakBlocks
  public function setCanBreakBlocks(bool $canBreakBlocks): void
  {
    $this->canBreakBlocks = $canBreakBlocks;
  }

  // Getter for canBreakMapBlocks
  public function getCanBreakMapBlocks(): bool
  {
    return $this->canBreakMapBlocks;
  }

  // Setter for canBreakMapBlocks
  public function setCanBreakMapBlocks(bool $canBreakMapBlocks): void
  {
    $this->canBreakMapBlocks = $canBreakMapBlocks;
  }

  /**
   * @return bool
   */
  public function isCanBreakRegisteredBlocks(): bool
  {
    return $this->canBreakRegisteredBlocks;
  }

  /**
   * @param bool $canBreakRegisteredBlocks
   */
  public function setCanBreakRegisteredBlocks(bool $canBreakRegisteredBlocks): void
  {
    $this->canBreakRegisteredBlocks = $canBreakRegisteredBlocks;
  }

  // place an array of vector3 positions of a single block type
  // works the same as if a player placed these blocks
  public function placeBlocks(array $positions, Block $block): void
  {
    $time = $this->server->getTick();
    foreach ($positions as $pos) {
      // if ($this->world->isInLoadedTerrain($pos))
      if ($this->world->isInWorld($pos->x, $pos->y, $pos->z)) {
        $this->world->setBlock($pos, $block);
        $entry = new BlockEntry($pos, $block, $time);
        $this->addBlockEntryToArrayWithVector3Key($this->placedBlocks, $entry);
      }
    }
  }

  // simulates breaking blocks and does the same handling a player would have
  public function removeBlocks(array $positions): void
  {
    foreach ($positions as $pos) {
      // if ($this->world->isInLoadedTerrain($pos))
      if ($this->world->isInWorld($pos->x, $pos->y, $pos->z)) {
        $block = $this->world->getBlock($pos);
        $this->handleBlockBreakOnBlock($block); // we just call this for logging purposes (this might not even be correct though)
        $this->world->setBlock($pos, VanillaBlocks::AIR());
      }
    }
  }

  // set blocks to air and by default removes any existing blocks at the positions from the placed blocks array
  public function removeBlocksFast(array $positions, bool $removeFromPlacedBlocksArray = true): void
  {
    foreach ($positions as $pos) {
      // if ($this->world->isInLoadedTerrain($pos))
      if ($this->world->isInWorld($pos->x, $pos->y, $pos->z)) {
        // Remove from the placed blocks array since it is now air
        if ($removeFromPlacedBlocksArray && $this->isInPlacedBlocks($pos)) {
          if (SwimCore::$DEBUG) echo("BlocksManager::removeBlocksFast() | Removing placed blocks from blocks array\n");
          unset($this->placedBlocks[PositionHelper::getVectorHashKey($pos)]);
        }
        $this->world->setBlock($pos, VanillaBlocks::AIR());
      }
    }
  }

  // prunes all old blocks (this can maybe get expensive)
  public function updateSecond(): void
  {
    if (!$this->prunes) return;

    $time = $this->server->getTick();

    // set back the placed blocks to air
    if ($this->pruneRemovePlacedBlocks) {
      foreach ($this->placedBlocks as $key => $data) {
        if ($time >= $data->time) {
          // if ($this->world->isInLoadedTerrain($pos))

          if ($this->recorder->isRecording()) {
            // store the block before it was removed for timeline scrubbing in replay mode
            $this->recorder->onBlockRemove($data->block, $data->position);
          }

          $this->world->setBlock($data->position, VanillaBlocks::AIR());

          // if (SwimCore::$DEBUG) echo "Removing placed block: " . $block->getName() . "\n";
          unset($this->placedBlocks[$key]);
        }
      }
    }

    // set back the broken map blocks to what they were
    if ($this->pruneReplaceBrokenBlocks) {
      foreach ($this->brokenMapBlocks as $key => $data) {
        if ($time >= $data->time) {
          // if ($this->world->isInLoadedTerrain($pos))

          if ($this->recorder->isRecording()) {
            // store the block before it was removed for timeline scrubbing in replay mode
            $this->recorder->onBlockRemove($data->block, $data->position);
          }

          $this->world->setBlock($data->position, $data->block);

          // if (SwimCore::$DEBUG) echo "Replacing map block: " . $block->getName() . "\n";
          unset($this->brokenMapBlocks[$key]);
        }
      }
    }
  }

  // add a chunk loader to the world, if a loader already exists at this position, it is removed and freed, and then replaced
  public function addChunkLoader(Vector3 $position, bool $tick = false): void
  {
    $key = $this->removeChunkLoader($position);
    $ticker = new BlockTicker($this->world, $position, $tick);
    $ticker->enableChunkTicker($tick);
    $this->chunksToKeepAlive[$key] = $ticker;

    // recorded scenes need to have the same chunk loaders
    if ($this->recorder->isRecording()) $this->recorder->addChunkLoader($position);
  }

  // returns they key of the hash key of the position passed in
  // this also frees the chunk loader from the world
  public function removeChunkLoader(Vector3 $position): int
  {
    $key = PositionHelper::getVectorHashKey($position);
    if (self::isHashKeyInArray($position, $this->chunksToKeepAlive)) {
      $this->chunksToKeepAlive[$key]->free();
      unset($this->chunksToKeepAlive[$key]);
    }
    return $key;
  }

  // frees all chunk loaders and empties the array
  public function clearChunkLoaders(): void
  {
    foreach ($this->chunksToKeepAlive as $loader) {
      $loader->free();
    }
    $this->chunksToKeepAlive = [];
  }

  public function getPlacedBlocks(): array
  {
    return $this->placedBlocks;
  }

  public function &getPlacedBlocksRef(): array
  {
    return $this->placedBlocks;
  }

  public function &getBrokenBlocksRef(): array
  {
    return $this->brokenMapBlocks;
  }

  /**
   * @param BlockEntry[] $arr
   * @return void
   */
  public static function debugBlockEntries(array $arr): void
  {
    foreach ($arr as $data) {
      $pos = PositionHelper::toString($data->position);
      echo("block entry# $data->key: ($pos) ({$data->block->getName()})\n");
      $remadeKey = PositionHelper::getVectorHashKey($data->position);
      if ($remadeKey != $data->key) {
        echo("$data->key and $remadeKey do not match!\n");
      }
    }
  }

}
