<?php

namespace core\utils\raklib;

use core\SwimCore;
use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\convert\ItemTranslator;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStack;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackExtraData;
use pocketmine\network\mcpe\protocol\types\inventory\ItemStackExtraDataShield;
use ReflectionProperty;
use pmmp\encoding\ByteBufferWriter;

class SwimTypeConverter extends TypeConverter
{

  private const  PM_ID_TAG = "___Id___";

  public static function make(int $protocolId): self
  {
    if (SwimCore::$isNetherGames) {
      $instancesRefl = new ReflectionProperty(TypeConverter::class, "instance");
      $instances = self::getAll();
      $instances[$protocolId] = new self($protocolId);
      $instancesRefl->setValue(null, $instances);
      return $instances[$protocolId];
    } else {
      $instanceRefl = new ReflectionProperty(TypeConverter::class, "instance");
      $instanceRefl->setValue(null, new self()); // ignore this error for missing args if you get it
      return self::getInstance();
    }
  }

  private static ReflectionProperty $canPlaceOnRefl;
  private static ReflectionProperty $canDestroyRefl;
  private int $shieldRuntimeId;

  public function coreItemStackToNet(Item $itemStack): ItemStack
  {
    if (!isset($this->shieldRuntimeId)) {
      $this->shieldRuntimeId = (new ReflectionProperty(TypeConverter::class, "shieldRuntimeId"))->getValue($this);
    }
    if ($itemStack->isNull()) {
      return ItemStack::null();
    }
    $nbt = $itemStack->getNamedTag();
    if ($nbt->count() === 0) {
      $nbt = null;
    } else {
      $nbt = clone $nbt;
    }

    $idMeta = $this->getItemTranslator()->toNetworkIdQuiet($itemStack);
    if ($idMeta === null) {
      //Display unmapped items as INFO_UPDATE, but stick something in their NBT to make sure they don't stack with
      //other unmapped items.
      [$id, $meta, $blockRuntimeId] = $this->getItemTranslator()->toNetworkId(VanillaBlocks::INFO_UPDATE()->asItem());
      if ($nbt === null) {
        $nbt = new CompoundTag();
      }
      $nbt->setLong(self::PM_ID_TAG, $itemStack->getStateId());
    } else {
      [$id, $meta, $blockRuntimeId] = $idMeta;
    }

    $extraData = $id === $this->shieldRuntimeId ?
      new ItemStackExtraDataShield($nbt, canPlaceOn: $itemStack->getCanPlaceOn(), canDestroy: $itemStack->getCanDestroy(), blockingTick: 0) :
      new ItemStackExtraData($nbt, canPlaceOn: $itemStack->getCanPlaceOn(), canDestroy: $itemStack->getCanDestroy());

    $extraDataSerializer = new ByteBufferWriter();
    $extraData->write($extraDataSerializer);

    return new ItemStack(
      $id,
      $meta,
      $itemStack->getCount(),
      $blockRuntimeId ?? ItemTranslator::NO_BLOCK_RUNTIME_ID,
      $extraDataSerializer->getData(),
    );
  }

}