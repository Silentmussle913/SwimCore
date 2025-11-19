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
use WeakReference;

class GrapplingHook extends CustomFishingRod
{

  public function __construct(ItemIdentifier $identifier = new ItemIdentifier(ItemTypeIds::FISHING_ROD), string $name = "Rod", array $enchantmentTags = [])
  {
    parent::__construct($identifier, $name, $enchantmentTags);
    $this->setCustomName(TextFormat::RESET . TextFormat::GRAY . "Grappling Hook");
  }

  public function onClickAir(Player $player, Vector3 $directionVector, array &$returnedItems): ItemUseResult
  {
    // if rod is not out:
    if (!$this->entity || !$this->entity->get() || $this->entity->get()->isClosed()) {
      $player->fishing = true;
      $this->entity = WeakReference::create(new FishingHook(Location::fromObject($player->getEyePos()->subtract(0, 0.2, 0), $player->getWorld()), $player, $this));
      $entity = $this->entity->get();
      $entity->handleHookCasting($directionVector->multiply(2.2));
      $entity->spawnToAll();
      $player->getWorld()->addSound($player->getPosition(), new ThrowSound());
      $this->applyDamage(1);
    } else {
      // if rod is out:
      $entity = $this->entity->get();

      if ($entity) {
        // can only grapple if we are collided with something like a block or entity
        if ($entity->isCollided) {
          /** @var $player SwimPlayer */
          $this->grapple($player);
        }
        $entity->flagForDespawn();
      }

      $player->fishing = false;
      unset($this->entity);
    }

    return ItemUseResult::SUCCESS;
  }

  // boost into the direction of the hook
  private function grapple(SwimPlayer $player): void
  {
    $entity = $this->entity->get();
    if (!$entity) return;

    // Get the position of the hook and the player
    $hookPos = $entity->getPosition();
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