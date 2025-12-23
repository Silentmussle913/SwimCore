<?php

namespace core\custom\prefabs\rod;

use core\systems\player\SwimPlayer;
use pocketmine\entity\Location;
use pocketmine\item\ItemIdentifier;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\ItemUseResult;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;
use pocketmine\world\sound\ThrowSound;

class GrapplingHook extends CustomFishingRod
{

  public function __construct
  (
    ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FISHING_ROD),
    string         $name = "Rod",
    array          $enchantmentTags = []
  )
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . TextFormat::GRAY . "Grappling Hook");
  }

  public function getMaxDurability(): int
  {
    return 50;
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
      // If the hook is out:
      // Can only grapple if we are collided with something like a block or entity
      if ($currentHook->isCollided) {
        if ($player instanceof SwimPlayer) {
          $this->grapple($player, $currentHook);
        }
      }

      // Reel in: despawn the existing hook
      $currentHook->flagForDespawn();
      $player->fishing = false;
      self::clearCurrentHook($player, $currentHook);
    }

    return ItemUseResult::SUCCESS;
  }

  // Boost into the direction of the hook
  private function grapple(SwimPlayer $player, FishingHook $hook): void
  {
    // Get the position of the hook and the player
    $hookPos = $hook->getPosition();
    $playerPos = $player->getPosition();

    // Calculate the direction vector from the player's position to the hook's position
    $motionVector = $hookPos->subtract($playerPos->x, $playerPos->y, $playerPos->z);

    // Normalize the motion vector to get the direction
    $motionVector = $motionVector->normalize();

    // Multiply the motion vector by a factor to control the speed of the "grapple"
    $grappleSpeed = 1.5; // Adjust this value to control how fast the player is reeled in
    $motionVector = $motionVector->multiply($grappleSpeed);

    // Apply the motion to the player
    $player->setMotion($motionVector, true);
  }

}
