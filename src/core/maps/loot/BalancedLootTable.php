<?php

namespace core\maps\loot;

use core\SwimCore;
use core\systems\scene\misc\LootTable;
use pocketmine\item\Armor;
use pocketmine\item\Durable;
use pocketmine\item\Item;
use pocketmine\item\VanillaItems;

abstract class BalancedLootTable extends LootTable
{

  // Rarity weights (bigger number = more common)
  public const RARITY_VERY_RARE = 15;
  public const RARITY_RARE = 20;
  public const RARITY_UNCOMMON = 25;
  public const RARITY_COMMON = 30;
  public const RARITY_VERY_COMMON = 40;

  /**
   * Garbage tier: leather armor, wood sword, stone axe. Absolute crap you do not want.
   * Only 0–1 items from this tier will be given per chest.
   */
  public const RARITY_GARBAGE = 50;

  public bool $unbreakable = false;

  /**
   * @var BalancedLootEntry[]
   */
  protected array $items = [];

  /**
   * Parent class will implement this and use this function as where to call the register functions
   */
  abstract public function init(): void;

  /**
   * Registers an item with rarity weight and min/max stack.
   * @param Item $item
   * @param int $weight Higher = more common
   * @param int $minStack Minimum stack size to roll (1+)
   * @param int $maxStack Maximum stack size to roll (>= minStack)
   * @param bool $avoidGood If true, this item will not be used in getRandomGoodLoot().
   */
  public function registerItemBalanced(Item $item, int $weight, int $minStack = 1, int $maxStack = 1, bool $avoidGood = false): void
  {
    if ($this->unbreakable && $item instanceof Durable) {
      $item->setUnbreakable();
    }

    $weight = max(1, $weight);
    $minStack = max(1, $minStack);
    $maxStack = max($minStack, $maxStack);

    $this->items[] = new BalancedLootEntry(
      $item,
      $weight,
      $minStack,
      $maxStack,
      $avoidGood
    );
  }

  /**
   * Retrieves a globally balanced set of items using weights.
   * - Total items: 5–7
   * - At least 1 upper rarity item (rare/very rare) if available
   * - 0–1 garbage tier item (arrows/webs/etc) per chest at most
   * - Remaining items are mostly medium tier (common/uncommon/very common)
   * - Avoids giving multiple similar non-stackable items:
   *   - Armor: no duplicate armor slots (e.g. 3 helmets)
   *   - Other non-stackables: no duplicate item types
   * @return Item[]
   */
  public function getRandomLoot(): array
  {
    $loot = [];

    if (empty($this->items)) {
      echo "BalancedLootTable::getRandomLoot() - Loot table is empty.\n";
      return $loot;
    }

    // Split items into rarity tiers based on their weight.
    $upperEntries = [];
    $mediumEntries = [];
    $garbageEntries = [];

    foreach ($this->items as $entry) {
      $weight = $entry->weight;

      // Smaller weight = rarer.
      if ($weight <= self::RARITY_RARE) {
        // VERY_RARE + RARE
        $upperEntries[] = $entry;
      } elseif ($weight <= self::RARITY_VERY_COMMON) {
        // UNCOMMON + COMMON + VERY_COMMON
        $mediumEntries[] = $entry;
      } else {
        // Anything above VERY_COMMON is considered "garbage tier"
        // (e.g. RARITY_GARBAGE).
        $garbageEntries[] = $entry;
      }
    }

    // Target number of items in the loot.
    $targetCount = rand(5, 7);

    // Track which non-stackable "groups" we have already given.
    // Key: group key string -> true.
    $usedGroups = [];

    // Helper to roll an item from a given pool and push it into $loot,
    // avoiding duplicate non-stackable groups where possible.
    $rollFromPool = function (array $pool) use (&$loot, &$usedGroups) {
      if (empty($pool)) {
        return;
      }

      $chosenEntry = null;
      $chosenItem = null;

      // Try several times to avoid duplicate non-stackable groups.
      $maxAttempts = 10;
      $attempts = 0;

      while ($attempts < $maxAttempts) {
        $attempts++;

        $entry = $this->getWeightedEntry($pool);
        if ($entry === null) {
          return;
        }

        $candidateItem = $entry->item;

        $groupKey = $this->getNonStackableGroupKey($candidateItem);
        if ($groupKey !== null && isset($usedGroups[$groupKey])) {
          // Already gave an item in this non-stackable group; try again.
          continue;
        }

        // Good candidate (either stackable or unused group).
        $chosenEntry = $entry;
        $chosenItem = $candidateItem;
        break;
      }

      // If we failed to find a non-duplicate group, just fall back to any entry.
      if ($chosenEntry === null) {
        $chosenEntry = $this->getWeightedEntry($pool);
        if ($chosenEntry === null) {
          return;
        }
        $chosenItem = $chosenEntry->item;
      }

      /** @var Item $item */
      $item = clone $chosenItem;

      $minStack = $chosenEntry->minStack;
      $maxStack = $chosenEntry->maxStack;
      $maxStackSize = $item->getMaxStackSize();

      if ($maxStackSize <= 1) {
        $item->setCount(1);
      } else {
        $stackMin = max(1, min($minStack, $maxStackSize));
        $stackMax = max($stackMin, min($maxStack, $maxStackSize));
        $count = rand($stackMin, $stackMax);
        $item->setCount($count);
      }

      // Mark non-stackable group as used if applicable.
      $groupKey = $this->getNonStackableGroupKey($item);
      if ($groupKey !== null) {
        $usedGroups[$groupKey] = true;
      }

      $loot[] = $item;
    };

    // 1) Ensure at least one upper rarity item if possible.
    if (!empty($upperEntries)) {
      $rollFromPool($upperEntries);
    } else {
      echo "BalancedLootTable::getRandomLoot() - No upper rarity entries available.\n";
    }

    // 2) Optionally roll exactly one garbage-tier item if any exist.
    //    This ensures arrows/webs/etc don't flood the chest:
    //    at most 1 per chest, but they still appear very often.
    $hasGarbageRolled = false;
    if (!empty($garbageEntries) && count($loot) < $targetCount) {
      $rollFromPool($garbageEntries);
      $hasGarbageRolled = true;
    }

    // 3) Fill remaining slots with a mix of medium and occasional extra upper rarity.
    $safetyCounter = 0;
    while (count($loot) < $targetCount && $safetyCounter < 20) {
      $safetyCounter++;

      if (!empty($mediumEntries) || !empty($upperEntries)) {
        $poolRoll = rand(1, 100);

        if (!empty($mediumEntries) && !empty($upperEntries)) {
          // 80% chance medium, 20% chance upper for fillers.
          if ($poolRoll <= 80) {
            $rollFromPool($mediumEntries);
          } else {
            $rollFromPool($upperEntries);
          }
        } elseif (!empty($mediumEntries)) {
          $rollFromPool($mediumEntries);
        } else {
          $rollFromPool($upperEntries);
        }

        continue;
      }

      // If medium/upper pools are empty, fall back to any items.
      $rollFromPool($this->items);
    }

    // Final safety: if somehow we still have too few items, fill with global pool.
    while (count($loot) < $targetCount && $safetyCounter < 40) {
      $safetyCounter++;
      $rollFromPool($this->items);
    }

    return $loot;
  }

  /**
   * Retrieves a "good loot" set:
   * - 4 very rare items
   * - 2 rare items
   * - 2 uncommon items
   * - 3–4 common/very common items
   * - Never includes garbage-tier items.
   * - Skips entries registered with $avoidGood = true.
   * @return Item[]
   */
  public function getRandomGoodLoot(): array
  {
    if (SwimCore::$DEBUG) {
      echo("getRandomGoodLoot called\n");
    }

    $loot = [];

    if (empty($this->items)) {
      echo "BalancedLootTable::getRandomGoodLoot() - Loot table is empty.\n";
      return $loot;
    }

    // Bucket items by rarity (using weight ranges, skipping garbage and avoidGood entries).
    $veryRareEntries = [];
    $rareEntries = [];
    $uncommonEntries = [];
    $commonEntries = [];
    $veryCommonEntries = [];

    foreach ($this->items as $entry) {
      if ($entry->avoidGood) {
        // Explicitly skip these from good loot.
        continue;
      }

      $weight = $entry->weight;

      if ($weight <= self::RARITY_VERY_RARE) {
        $veryRareEntries[] = $entry;
      } elseif ($weight <= self::RARITY_RARE) {
        $rareEntries[] = $entry;
      } elseif ($weight <= self::RARITY_UNCOMMON) {
        $uncommonEntries[] = $entry;
      } elseif ($weight <= self::RARITY_COMMON) {
        $commonEntries[] = $entry;
      } elseif ($weight <= self::RARITY_VERY_COMMON) {
        $veryCommonEntries[] = $entry;
      }
      // Anything above VERY_COMMON is garbage and intentionally ignored here.
    }

    $usedGroups = [];

    // Helper to roll N items from a pool, respecting non-stackable grouping.
    $rollFromPool = function (array $pool, int $count) use (&$loot, &$usedGroups) {
      $rolled = 0;
      $safetyCounter = 0;

      while ($rolled < $count && $safetyCounter < $count * 10) {
        $safetyCounter++;

        if (empty($pool)) {
          break;
        }

        $chosenEntry = null;
        $chosenItem = null;

        $maxAttempts = 10;
        $attempts = 0;

        while ($attempts < $maxAttempts) {
          $attempts++;

          $entry = $this->getWeightedEntry($pool);
          if ($entry === null) {
            break;
          }

          $candidateItem = $entry->item;

          $groupKey = $this->getNonStackableGroupKey($candidateItem);
          if ($groupKey !== null && isset($usedGroups[$groupKey])) {
            continue;
          }

          $chosenEntry = $entry;
          $chosenItem = $candidateItem;
          break;
        }

        if ($chosenEntry === null) {
          $chosenEntry = $this->getWeightedEntry($pool);
          if ($chosenEntry === null) {
            break;
          }
          $chosenItem = $chosenEntry->item;
        }

        /** @var Item $item */
        $item = clone $chosenItem;

        $minStack = $chosenEntry->minStack;
        $maxStack = $chosenEntry->maxStack;
        $maxStackSize = $item->getMaxStackSize();

        if ($maxStackSize <= 1) {
          $item->setCount(1);
        } else {
          $stackMin = max(1, min($minStack, $maxStackSize));
          $stackMax = max($stackMin, min($maxStack, $maxStackSize));
          $countValue = rand($stackMin, $stackMax);
          $item->setCount($countValue);
        }

        $groupKey = $this->getNonStackableGroupKey($item);
        if ($groupKey !== null) {
          $usedGroups[$groupKey] = true;
        }

        $loot[] = $item;
        $rolled++;
      }
    };

    // 3 very rare items; if not enough, fall back to better-ish stuff.
    $start = count($loot);
    $rollFromPool($veryRareEntries, 3);
    $added = count($loot) - $start;
    if ($added < 3) {
      $remaining = 3 - $added;
      $fallbackPool = array_merge($rareEntries, $uncommonEntries, $commonEntries, $veryCommonEntries);
      $rollFromPool($fallbackPool, $remaining);
    }

    // 2 rare items; if not enough, fall back to very rare/uncommon.
    $start = count($loot);
    $rollFromPool($rareEntries, 2);
    $added = count($loot) - $start;
    if ($added < 2) {
      $remaining = 2 - $added;
      $fallbackPool = array_merge($veryRareEntries, $uncommonEntries, $commonEntries, $veryCommonEntries);
      $rollFromPool($fallbackPool, $remaining);
    }

    // 2 uncommon items; if not enough, fall back to rare/common.
    $start = count($loot);
    $rollFromPool($uncommonEntries, 2);
    $added = count($loot) - $start;
    if ($added < 2) {
      $remaining = 2 - $added;
      $fallbackPool = array_merge($rareEntries, $commonEntries, $veryCommonEntries, $veryRareEntries);
      $rollFromPool($fallbackPool, $remaining);
    }

    // 3–4 common-ish items (common + very common), still no garbage.
    $commonPool = array_merge($commonEntries, $veryCommonEntries);
    $commonCount = rand(3, 4);
    $rollFromPool($commonPool, $commonCount);

    return $loot;
  }

  /**
   * Returns a grouping key for a non-stackable item to avoid giving too many similar items.
   * - Stackable items return null (no restriction).
   * - Armor groups by armor slot (helmet, chest, etc.).
   * - Other non-stackables group by item type ID.
   */
  private function getNonStackableGroupKey(Item $item): ?string
  {
    // We only care about non-stackable items.
    if ($item->getMaxStackSize() > 1) {
      return null;
    }

    // Armor: avoid multiple of the same slot (e.g. multiple helmets).
    if ($item instanceof Armor) {
      return 'armor_slot_' . $item->getArmorSlot();
    }

    // Generic non-stackable: group by type ID.
    $id = $item->getTypeId();

    return 'item_type_' . $id;
  }

  /**
   * Picks a random entry from the given weighted list.
   * @param BalancedLootEntry[] $entries
   * @return BalancedLootEntry|null
   */
  private function getWeightedEntry(array $entries): ?BalancedLootEntry
  {
    if (empty($entries)) {
      echo "BalancedLootTable::getWeightedEntry() - No loot entries provided.\n";
      return null;
    }

    $totalWeight = 0;
    foreach ($entries as $entry) {
      $totalWeight += $entry->weight;
    }

    if ($totalWeight <= 0) {
      echo "BalancedLootTable::getWeightedEntry() - All loot entries have non-positive weight; using first entry as fallback.\n";
      $firstKey = array_key_first($entries);
      if ($firstKey === null) {
        return null;
      }
      return $entries[$firstKey];
    }

    $roll = rand(1, $totalWeight);
    $running = 0;

    foreach ($entries as $entry) {
      $running += $entry->weight;
      if ($roll <= $running) {
        return $entry;
      }
    }

    // Fallback (should never happen)
    $firstKey = array_key_first($entries);
    if ($firstKey === null) {
      echo "BalancedLootTable::getWeightedEntry() - Fallback failed, entries is empty.\n";
      return null;
    }

    echo "BalancedLootTable::getWeightedEntry() - Roll fell through, using first entry as fallback.\n";
    return $entries[$firstKey];
  }

  /**
   * Retrieves a single randomly selected item using weights.
   * @return Item Returns AIR if the table is empty or selection fails.
   */
  public function getRandomItem(): Item
  {
    if (empty($this->items)) {
      echo "BalancedLootTable::getRandomItem() - Loot table is empty.\n";
      return VanillaItems::AIR();
    }

    $entry = $this->getWeightedEntry($this->items);
    if ($entry === null) {
      echo "BalancedLootTable::getRandomItem() - Failed to pick a weighted entry.\n";
      return VanillaItems::AIR();
    }

    $item = clone $entry->item;
    $item->setCount(1);
    return $item;
  }

}
