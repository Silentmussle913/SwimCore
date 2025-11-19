<?php

namespace core\custom\prefabs\bots;

use pocketmine\inventory\ArmorInventory;

enum ArmorType: int
{
  case Helmet = ArmorInventory::SLOT_HEAD;
  case Chest = ArmorInventory::SLOT_CHEST;
  case Legs = ArmorInventory::SLOT_LEGS;
  case Boots = ArmorInventory::SLOT_FEET;
  case NotArmor = -1;
}