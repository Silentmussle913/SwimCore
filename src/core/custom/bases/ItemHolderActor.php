<?php

namespace core\custom\bases;

use core\systems\entity\entities\Actor;
use core\systems\scene\Scene;
use pocketmine\entity\Location;
use pocketmine\entity\Skin;
use pocketmine\inventory\CallbackInventoryListener;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\EntityEventBroadcaster;
use pocketmine\network\mcpe\NetworkBroadcastUtils;
use pocketmine\network\mcpe\protocol\MobEquipmentPacket;
use pocketmine\network\mcpe\protocol\types\inventory\ContainerIds;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine\network\mcpe\StandardEntityEventBroadcaster;
use pocketmine\player\Player;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

abstract class ItemHolderActor extends Actor
{

  protected MainHandInventory $mainHandInventory;
  private const  TAG_MAIN_HAND = "Mainhand";
  private static ReflectionMethod $sendDataPacketBroadcaster;
  private static ReflectionProperty $typeConverterRefl;
  private int $inventorySize = 1;

  public function __construct
  (
    Location $location,
    ?Scene $parentScene = null,
    int $inventorySize = 1,
    ?CompoundTag $nbt = null,
    ?Skin $skin = null
  )
  {
    $this->inventorySize = $inventorySize;
    parent::__construct($location, $parentScene, $nbt, $skin);
  }

  /**
   * @throws ReflectionException
   */
  protected function initEntity(CompoundTag $nbt): void
  {
    parent::initEntity($nbt);

    if (!isset(self::$sendDataPacketBroadcaster)) {
      self::$sendDataPacketBroadcaster = new ReflectionMethod(StandardEntityEventBroadcaster::class, "sendDataPacket");
      self::$typeConverterRefl = (new ReflectionClass(StandardEntityEventBroadcaster::class))->getProperty("typeConverter");
    }

    $this->mainHandInventory = new MainHandInventory($this, $this->inventorySize);
    $mainHand = $nbt->getCompoundTag(self::TAG_MAIN_HAND);

    if ($mainHand !== null) {
      $this->mainHandInventory->setItem(0, Item::nbtDeserialize($mainHand));
    }

    $this->mainHandInventory->getListeners()->add(CallbackInventoryListener::onAnyChange(fn() => $this->syncMainHandInventory()));
  }

  public function syncMainHandInventory(?array $targets = null): void
  {
    $targets ??= $this->getViewers();
    NetworkBroadcastUtils::broadcastEntityEvent(
      $targets,
      function (EntityEventBroadcaster $broadcaster, array $recipients): void {
        self::$sendDataPacketBroadcaster->invoke($broadcaster, $recipients, MobEquipmentPacket::create(
          $this->getId(),
          ItemStackWrapper::legacy(self::$typeConverterRefl->getValue($broadcaster)->coreItemStackToNet($this->mainHandInventory->getItem(0))),
          0,
          0,
          ContainerIds::INVENTORY
        ));
      }
    );
  }

  protected function sendSpawnPacket(Player $player): void
  {
    parent::sendSpawnPacket($player);
    $this->syncMainHandInventory([$player]);
  }

  public function saveNBT(): CompoundTag
  {
    $nbt = parent::saveNBT();

    if (isset($this->heldItem)) {
      $nbt->setTag(self::TAG_MAIN_HAND, $this->heldItem->nbtSerialize());
    }

    return $nbt;
  }

  public function getMainHandInventory(): MainHandInventory
  {
    return $this->mainHandInventory;
  }

}