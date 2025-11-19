<?php

namespace core\custom\prefabs\bots;

use pocketmine\item\Armor;
use pocketmine\item\Item;
use pocketmine\item\ItemTypeIds;

class ArmorHelper
{

  public static function getArmorScore(Item $item): int
  {
    $score = 0;
    if ($item instanceof Armor) {
      $score = $item->getDefensePoints();
    }
    return $score;
  }

  public static function getArmorType(Item $item): ArmorType
  {
    $id = $item->getTypeId();

    if (
      $id === ItemTypeIds::LEATHER_CAP ||
      $id === ItemTypeIds::CHAINMAIL_HELMET ||
      $id === ItemTypeIds::IRON_HELMET ||
      $id === ItemTypeIds::GOLDEN_HELMET ||
      $id === ItemTypeIds::DIAMOND_HELMET ||
      $id === ItemTypeIds::NETHERITE_HELMET
    ) {
      return ArmorType::Helmet;
    }

    if (
      $id === ItemTypeIds::LEATHER_TUNIC ||
      $id === ItemTypeIds::CHAINMAIL_CHESTPLATE ||
      $id === ItemTypeIds::IRON_CHESTPLATE ||
      $id === ItemTypeIds::GOLDEN_CHESTPLATE ||
      $id === ItemTypeIds::DIAMOND_CHESTPLATE ||
      $id === ItemTypeIds::NETHERITE_CHESTPLATE
    ) {
      return ArmorType::Chest;
    }

    if (
      $id === ItemTypeIds::LEATHER_PANTS ||
      $id === ItemTypeIds::CHAINMAIL_LEGGINGS ||
      $id === ItemTypeIds::IRON_LEGGINGS ||
      $id === ItemTypeIds::GOLDEN_LEGGINGS ||
      $id === ItemTypeIds::DIAMOND_LEGGINGS ||
      $id === ItemTypeIds::NETHERITE_LEGGINGS
    ) {
      return ArmorType::Legs;
    }

    if (
      $id === ItemTypeIds::LEATHER_BOOTS ||
      $id === ItemTypeIds::CHAINMAIL_BOOTS ||
      $id === ItemTypeIds::IRON_BOOTS ||
      $id === ItemTypeIds::GOLDEN_BOOTS ||
      $id === ItemTypeIds::DIAMOND_BOOTS ||
      $id === ItemTypeIds::NETHERITE_BOOTS
    ) {
      return ArmorType::Boots;
    }

    return ArmorType::NotArmor;
  }

}