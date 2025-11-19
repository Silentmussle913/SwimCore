<?php

namespace core\systems\scene\replay;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\block\Block;
use pocketmine\block\Concrete;
use pocketmine\block\StainedGlass;
use pocketmine\block\StainedHardenedClay;
use pocketmine\block\Wool;
use pocketmine\entity\Location;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\item\ItemBlock;
use pocketmine\item\ItemTypeIds;
use pocketmine\math\Vector3;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;

class SceneReplay
{

  public string $replayName; // e.g., "Bedfight Swim Vs Parrot 2:18 PM 3/8/2025"
  public string $modeName;   // e.g., "Midfight", "Boxing", etc.
  public string $mapName;    // e.g., "tropical", "volcano", etc.
  public string $worldName;  // e.g., "mixed", "duelWorld", etc.

  // The reference point for relative positions.
  private Vector3 $origin;
  public float $startTime;

  // Recording type constants.
  public const MOVEMENT = 1;
  public const PACKETS = 2;
  public const BLOCK_REMOVES = 3;
  public const BLOCK_ADDS = 4;
  public const CHUNK_LOADERS = 5;
  public const PLAYER_NAME_LOOKUP = 6;

  // Keys for movement data.
  public const PLAYER_NAME_ID = 0;
  public const RELATIVE_POS = 1;
  public const PITCH = 2;
  public const YAW = 3;
  public const HEAD_YAW = 4;

  // Keys for other packets and stuff.
  public const PACKET_PLAYER_NAME = 5;
  public const PACKET_DATA = 6;
  public const INVENTORY = 7;

  // Keys for block actions.
  public const BLOCK_POSITION = 0; // Array: [x, y, z]
  public const BLOCK_ID = 1;
  public const BLOCK_META = 2;

  // Keys for inventory stuff.
  public const ITEM_ID = 0;
  public const COLOR_RGBA = 1;
  public const ENCHANTED = 2;
  public const IS_BLOCK = 3;

  // All recordings are stored tick-based in arrays.
  public array $recording = [
    self::MOVEMENT => [],
    self::PACKETS => [],
    self::BLOCK_REMOVES => [],
    self::BLOCK_ADDS => [],
    self::CHUNK_LOADERS => [],
    self::PLAYER_NAME_LOOKUP => [],
    self::INVENTORY => [],
  ];

  // Cache to store the last known location per player (id => Location).
  private array $previousLocationCache = [];

  // Keys for inventory caching (id -> ItemTypeID, which is also an int)
  public const HELD_ITEM = 0;
  public const HELMET = 1;
  public const CHEST_PLATE = 2;
  public const LEGGINGS = 3;
  public const BOOTS = 4;
  public const LAST_SAVE_TIME = 5;

  // Cache to store visible inventory items, which is the held item and the armor
  private array $inventoryCache = [];

  /** @var SceneReplay[] */
  public static array $replays = []; // temporary storage

  public function __construct(string $replayName, string $modeName, string $mapName, string $worldName, Vector3 $origin)
  {
    $this->replayName = $replayName;
    $this->modeName = $modeName;
    $this->mapName = $mapName;
    $this->worldName = $worldName;
    $this->origin = $origin;
    $this->startTime = microtime(true);
  }

  /**
   * Returns a summary string of the replay.
   */
  public function dumpInfo(): string
  {
    return "$this->replayName | $this->modeName | $this->mapName | $this->worldName";
  }

  /**
   * Called frequently during recording.
   * Only records movement if there’s an actual delta.
   */
  public function onReceive(DataPacketReceiveEvent $event, SwimPlayer $player): void
  {
    $pk = $event->getPacket();
    $pid = $pk->pid();
    // Calculate the tick at which this event occurs.
    $timeKey = (int)round((microtime(true) - $this->startTime) * 20);

    if ($pid == PlayerAuthInputPacket::NETWORK_ID) {
      /** @var PlayerAuthInputPacket $pk */
      $this->recordMovement($pk, $timeKey, $player);

      // check if anything changed inventory wise, this feels very scuffed calling this here
      $this->recordArmorAndHeldItem($player, $timeKey);
    }
    /* TODO: animations */
  }

  /**
   * Records movement events per tick.
   */
  private function recordMovement(PlayerAuthInputPacket $pk, int $timeKey, SwimPlayer $player): void
  {
    // Calculate position relative to the scene origin.
    $relativePos = $pk->getPosition()->subtract($this->origin->x, $this->origin->y, $this->origin->z);
    $id = $player->getId();

    // Only record movement if there is an actual delta.
    $lastLocation = $this->previousLocationCache[$id] ?? null;
    if ($lastLocation) {
      if ($this->sameLocation($lastLocation, $player->getLocation())) {
        return;
      }
    } else if (SwimCore::$DEBUG) {
      $name = $player->getName();
      echo "Last location not found, potentially new player in recording: $name \n";
    }

    // We cache this as you can see we use this above on checking if movement happened to record
    $this->previousLocationCache[$id] = $player->getLocation();

    // Add player ID to lookup table if not already present.
    $name = $player->getName();
    if (!isset($this->recording[self::PLAYER_NAME_LOOKUP][$id])) {
      $this->recording[self::PLAYER_NAME_LOOKUP][$id] = $name;
      if (SwimCore::$DEBUG) {
        echo "Recording player in look up table " . $name . "\n";
      }
    }

    // Record the movement event at the exact tick.
    $this->recording[self::MOVEMENT][$timeKey][] = [
      self::PLAYER_NAME_ID => $id,
      self::RELATIVE_POS => [$relativePos->x, $relativePos->y, $relativePos->z],
      self::PITCH => $pk->getPitch(),
      self::YAW => $pk->getYaw(),
      self::HEAD_YAW => $pk->getHeadYaw()
    ];
  }

  private function recordArmorAndHeldItem(SwimPlayer $player, int $timeKey): void
  {
    $id = $player->getId();
    $armorInv = $player->getArmorInventory();
    $inv = $player->getInventory();

    // Ensure the cache exists
    if (!isset($this->inventoryCache[$id])) {
      $this->inventoryCache[$id] = [
        self::HELD_ITEM => [],
        self::HELMET => [],
        self::CHEST_PLATE => [],
        self::LEGGINGS => [],
        self::BOOTS => [],
        self::LAST_SAVE_TIME => $timeKey
      ];
    }

    $cache = &$this->inventoryCache[$id];

    // Prevent redundant recording at the same tick
    /* not doing this because it's kind of spotty but would in theory help perf a ton
    if ($cache[self::LAST_SAVE_TIME] === $timeKey) {
      return;
    }
    */

    // Track changes
    $changes = [];

    // HELD ITEM
    $heldItem = $inv->getItemInHand();
    $heldItemID = $this->getItemID($heldItem);
    $heldColor = $this->getItemColor($heldItem);
    $heldEnchanted = $heldItem->hasEnchantments();

    if (!isset($cache[self::HELD_ITEM][self::ITEM_ID]) ||
      $cache[self::HELD_ITEM][self::ITEM_ID] !== $heldItemID ||
      $cache[self::HELD_ITEM][self::COLOR_RGBA] !== $heldColor ||
      $cache[self::HELD_ITEM][self::ENCHANTED] !== $heldEnchanted
    ) {

      $cache[self::HELD_ITEM] = [
        self::ITEM_ID => $heldItemID,
        self::COLOR_RGBA => $heldColor,
        self::ENCHANTED => $heldEnchanted,
        self::IS_BLOCK => $this->isBlock($heldItem)
      ];

      $changes[self::HELD_ITEM] = $cache[self::HELD_ITEM];
    }

    // ARMOR SLOTS
    $helmet = $armorInv->getHelmet();
    $chestPlate = $armorInv->getChestplate();
    $leggings = $armorInv->getLeggings();
    $boots = $armorInv->getBoots();

    // would be better to have this static somewhere
    $armorPieces = [
      self::HELMET => $helmet,
      self::CHEST_PLATE => $chestPlate,
      self::LEGGINGS => $leggings,
      self::BOOTS => $boots
    ];

    foreach ($armorPieces as $slot => $armorPiece) {
      $armorID = $this->getItemID($armorPiece);
      $armorColor = $this->getItemColor($armorPiece);
      $armorEnchanted = $armorPiece->hasEnchantments();

      if (!isset($cache[$slot][self::ITEM_ID]) ||
        $cache[$slot][self::ITEM_ID] !== $armorID ||
        $cache[$slot][self::COLOR_RGBA] !== $armorColor ||
        $cache[$slot][self::ENCHANTED] !== $armorEnchanted) {

        $cache[$slot] = [
          self::ITEM_ID => $armorID,
          self::COLOR_RGBA => $armorColor,
          self::ENCHANTED => $armorEnchanted
        ];

        $changes[$slot] = $cache[$slot];
      }
    }

    // Record only if there were changes
    if (!empty($changes)) {
      $cache[self::LAST_SAVE_TIME] = $timeKey;
      $changes[self::LAST_SAVE_TIME] = $timeKey;
      $this->recording[self::INVENTORY][$timeKey][$id] = $changes;

      if (SwimCore::$DEBUG) {
        echo "{$player->getName()} inventory changed at tick $timeKey:\n";
      }
    }
  }

  /**
   * Returns the item ID, ensuring that item blocks are correctly mapped to their block IDs.
   */
  private function getItemID(Item $item): int
  {
    if ($this->isBlock($item)) {
      return $item->getBlock()->getTypeId();
    }

    return $item->getTypeId();
  }

  /**
   * Determines if the given item is a block item.
   */
  private function isBlock(Item $item): bool
  {
    return $item instanceof ItemBlock;
  }

  /**
   * Returns the RGBA color value of an item if applicable (e.g., leather armor or colored blocks).
   */
  private function getItemColor(Item $item): int
  {
    if ($this->isLeatherArmorItem($item)) {
      /** @var Armor $item */
      return $item->getCustomColor()->toRGBA();
    }

    if ($this->isBlock($item)) {
      return $this->getBlockColor($item->getBlock());
    }

    return -1; // -1 means no color
  }

  /**
   * Determines if the given item is a leather armor piece.
   */
  private function isLeatherArmorItem(Item $item): bool
  {
    static $armorIds = [
      ItemTypeIds::LEATHER_CAP,
      ItemTypeIds::LEATHER_TUNIC,
      ItemTypeIds::LEATHER_PANTS,
      ItemTypeIds::LEATHER_BOOTS
    ];

    return in_array($item->getTypeId(), $armorIds, true);
  }

  /**
   * Returns the RGBA color value of a block if it has a dye color.
   */
  private function getBlockColor(Block $block): int
  {
    if ($block instanceof Wool
      || $block instanceof Concrete
      || $block instanceof StainedGlass
      || $block instanceof StainedHardenedClay
    ) {
      return $block->getColor()->getRgbValue()->toRGBA();
    }

    return -1; // if no color
  }

  /**
   * Helper function to check if two locations are nearly the same.
   */
  private function sameLocation(Location $location1, Location $location2, float $epsilon = 0.001): bool
  {
    return (
      (abs($location1->pitch - $location2->pitch) <= $epsilon) &&
      (abs($location1->yaw - $location2->yaw) <= $epsilon) &&
      (abs($location1->x - $location2->x) <= $epsilon) &&
      (abs($location1->y - $location2->y) <= $epsilon) &&
      (abs($location1->z - $location2->z) <= $epsilon)
    );
  }

  /**
   * Records a block addition event.
   */
  public function onBlockAdd(Block $block, Vector3 $pos): void
  {
    $this->recordBlockAction(self::BLOCK_ADDS, $block, $pos);
  }

  /**
   * Records a block removal event.
   */
  public function onBlockRemove(Block $block, Vector3 $pos): void
  {
    $this->recordBlockAction(self::BLOCK_REMOVES, $block, $pos);
  }

  /**
   * Helper function to record block actions (add or remove) at a tick.
   */
  private function recordBlockAction(int $key, Block $block, Vector3 $pos): void
  {
    $timeKey = (int)round((microtime(true) - $this->startTime) * 20);

    // For colored blocks, use the color as meta.
    $color = $this->getBlockColor($block);

    $relativePos = [
      $pos->x - $this->origin->x,
      $pos->y - $this->origin->y,
      $pos->z - $this->origin->z
    ];

    $this->recording[$key][$timeKey][] = [
      self::BLOCK_POSITION => $relativePos,
      self::BLOCK_ID => $block->getTypeId(),
      self::BLOCK_META => $color
    ];
  }

  /**
   * Records a chunk loader position.
   */
  public function addChunkLoader(Vector3 $position): void
  {
    $relativePos = $position->subtract($this->origin->x, $this->origin->y, $this->origin->z);
    $this->recording[self::CHUNK_LOADERS][] = [$relativePos->x, $relativePos->y, $relativePos->z];
  }

  /**
   * Saves this replay to temporary storage.
   */
  public function save(): void
  {
    echo "Saving scene replay $this->replayName \n";
    self::$replays[$this->replayName] = $this;
  }

}
