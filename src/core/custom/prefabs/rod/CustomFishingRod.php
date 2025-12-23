<?php

namespace core\custom\prefabs\rod;

use pocketmine\entity\Location;
use pocketmine\item\FishingRod;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\ThrowSound;
use WeakReference;

class CustomFishingRod extends FishingRod
{

  /** @var array<int, WeakReference<FishingHook>> */
  private static array $hooksByPlayer = [];

  public function __construct
  (
    ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FISHING_ROD),
    string         $name = "Rod",
    array          $enchantmentTags = []
  )
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . TextFormat::GRAY . "Rod");
  }

  protected function serializeCompoundTag(CompoundTag $tag): void
  {
    parent::serializeCompoundTag($tag);
    $this->damage !== 0 ?
      $tag->setInt("Damage", (int)($this->damage * (parent::getMaxDurability() / $this->getMaxDurability())))
      :
      $tag->removeTag("Damage");
  }

  private static function getPlayerKey(Player $player): int
  {
    return spl_object_id($player);
  }

  public static function getCurrentHook(Player $player): ?FishingHook
  {
    $key = self::getPlayerKey($player);

    if (!isset(self::$hooksByPlayer[$key])) {
      return null;
    }

    $ref = self::$hooksByPlayer[$key];
    $hook = $ref->get();

    if ($hook === null || $hook->isClosed()) {
      unset(self::$hooksByPlayer[$key]);
      return null;
    }

    return $hook;
  }

  public static function setCurrentHook(Player $player, FishingHook $hook): void
  {
    $key = self::getPlayerKey($player);
    self::$hooksByPlayer[$key] = WeakReference::create($hook);
  }

  public static function clearCurrentHook(Player $player, ?FishingHook $onlyIfThis = null): void
  {
    $key = self::getPlayerKey($player);

    if (!isset(self::$hooksByPlayer[$key])) {
      return;
    }

    $ref = self::$hooksByPlayer[$key];
    $current = $ref->get();

    if ($onlyIfThis !== null && $current !== $onlyIfThis) {
      return;
    }

    unset(self::$hooksByPlayer[$key]);
  }

  public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
  {
    $currentHook = self::getCurrentHook($player);

    // No active hook for this player: cast a new one
    if ($currentHook === null) {
      $player->fishing = true;

      $hook = new FishingHook(
        Location::fromObject($player->getEyePos()->subtract(0, 0.2, 0), $player->getWorld()),
        $player,
        $this
      );

      $hook->handleHookCasting($directionVector->multiply(2.2));
      $hook->spawnToAll();

      self::setCurrentHook($player, $hook);

      $player->getWorld()->addSound($player->getPosition(), new ThrowSound());
      $this->applyDamage(1);
    } else {
      // Reel in: despawn the existing hook
      $currentHook->flagForDespawn();
      $player->fishing = false;
      self::clearCurrentHook($player, $currentHook);
    }

    return ItemUseResult::SUCCESS;
  }

}
