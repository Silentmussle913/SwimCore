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

  private bool $inUse = false;

  /** @var ?WeakReference<FishingHook> */
  protected ?WeakReference $entity = null;

  public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FISHING_ROD), string $name = "Rod", array $enchantmentTags = [])
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . TextFormat::GRAY . "Rod");
  }

  public function getMaxDurability() : int {
    return 150;
  }

  protected function serializeCompoundTag(CompoundTag $tag) : void {
    parent::serializeCompoundTag($tag);
    $this->damage !== 0 ? $tag->setInt("Damage", (int) ($this->damage * (parent::getMaxDurability() / $this->getMaxDurability()))) : $tag->removeTag("Damage");
  }

  public function setInUse(bool $inUse) : void {
    $this->inUse = $inUse;
  }

  public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems) : ItemUseResult {
    if (!$this->entity || !$this->entity->get() || $this->entity->get()->isClosed()) {
      $player->fishing = true;
      $this->entity = WeakReference::create(new FishingHook(Location::fromObject($player->getEyePos()->subtract(0, 0.2, 0), $player->getWorld()), $player, $this));
      $entity = $this->entity->get();
      $entity->handleHookCasting($directionVector->multiply(2.2));
      $entity->spawnToAll();
      $player->getWorld()->addSound($player->getPosition(), new ThrowSound());
      $this->applyDamage(1);
    } else {
      $this->entity->get()?->flagForDespawn();
      $player->fishing = false;
      unset($this->entity);
    }

    return ItemUseResult::SUCCESS;
  }

}
