<?php

namespace core\custom\prefabs\hub;

use core\forms\hub\FormServerSelector;
use core\SwimCoreInstance;
use core\systems\player\SwimPlayer;
use pocketmine\item\Compass;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class ServerSelectorCompass extends Compass
{

    public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::COMPASS), string $name = "Compass", array $enchantmentTags = [])
    {
        parent::__construct($identifier, $name, $enchantmentTags);
        $this->setCustomName(TextFormat::RESET . TextFormat::GREEN . "Select Server Region " . TextFormat::GRAY . "[Right Click]");
    }

    public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
    {
        if ($player instanceof SwimPlayer)
            FormServerSelector::serverSelectorForm($player, SwimCoreInstance::getInstance());

        return ItemUseResult::NONE;
    }
}