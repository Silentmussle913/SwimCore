<?php

namespace core\scenes\duel;

use core\systems\player\SwimPlayer;
use core\systems\scene\misc\Team;
use core\utils\BehaviorEventEnum;
use core\utils\InventoryUtil;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\ItemTypeIds;
use pocketmine\item\PotionType;
use pocketmine\item\VanillaItems;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;

class Nodebuff extends Duel
{

  private int $victimPotCount = 0;

  public static function getIcon(): string
  {
    return "textures/items/potion_bottle_splash_heal";
  }

  public function init(): void
  {
    $this->registerCanceledEvents([
      BehaviorEventEnum::PLAYER_DROP_ITEM_EVENT,
      BehaviorEventEnum::BLOCK_BREAK_EVENT,
      BehaviorEventEnum::BLOCK_PLACE_EVENT
    ]);
    $this->spawnCloser = true;
  }

  // pearl cool down mechanics
  public function sceneItemUseEvent(PlayerItemUseEvent $event, SwimPlayer $swimPlayer): void
  {
    if ($this->spectatorControls($event, $swimPlayer)) return;

    $item = $event->getItem();
    if ($item->getTypeId() == ItemTypeIds::ENDER_PEARL) {
      $swimPlayer->getCoolDowns()->triggerItemCoolDownEvent($event, $item);
    }
  }

  protected function applyKit(SwimPlayer $swimPlayer): void
  {
    $swimPlayer->setGamemode(GameMode::ADVENTURE);
    InventoryUtil::potKit($swimPlayer);
  }

  protected function playerKilled(SwimPlayer $attacker, SwimPlayer $victim, EntityDamageByEntityEvent $event): void
  {
    // cache pot count of the killed player for the kill message
    $this->victimPotCount = InventoryUtil::getItemCount(
      $victim, VanillaItems::SPLASH_POTION()->setType(PotionType::STRONG_HEALING())
    );
    parent::playerKilled($attacker, $victim, $event);
  }

  protected function duelOver(Team $winners, Team $losers): void
  {
    // Check if it's a team win or a 1v1 duel
    if ($winners->getTeamSize() > 1) {
      // Handle a team victory
      $this->partyWin($winners, $losers, "Nodebuff");
    } else {
      // 1v1 duel scenario: assume there's only one loser
      // 3/29 rare crash fix attempt
      $loser = !empty($this->losers) ? $this->losers[array_key_first($this->losers)] : null;
      $players = $winners->getPlayers();
      $winner = !empty($players) ? $players[array_key_first($players)] : null;

      // Ensure both winner and loser are valid
      if ($loser && $winner) {
        // Retrieve nicknames and potion counts for the winner and loser
        $attackerName = $winner->getNicks()->getNick();
        $attackerPotCount = InventoryUtil::getItemCount(
          $winner, VanillaItems::SPLASH_POTION()->setType(PotionType::STRONG_HEALING())
        );

        // Format strings for displaying potion counts
        $attackerPotString = TextFormat::GRAY . " (" . TextFormat::GREEN . $attackerPotCount . TextFormat::GRAY . ")";
        $victimPotString = TextFormat::GRAY . " (" . TextFormat::GREEN . $this->victimPotCount . TextFormat::GRAY . ")";

        // Prepare the nodebuff string for the message
        $nodebuff = TextFormat::GRAY . "(" . TextFormat::AQUA . "Nodebuff" . TextFormat::GRAY . ")" . TextFormat::RESET . " ";

        // Determine message based on potion counts and send broadcast message
        if ($attackerPotCount > $this->victimPotCount) {
          $pots = $attackerPotCount - $this->victimPotCount;
          $msg = $nodebuff . TextFormat::GREEN . $attackerName . $attackerPotString . TextFormat::YELLOW .
            " " . $pots . " Potted " . TextFormat::RED . $loser->getNicks()->getNick() . $victimPotString;
        } else {
          $msg = $nodebuff . TextFormat::GREEN . $attackerName . $attackerPotString . TextFormat::YELLOW .
            " Killed " . TextFormat::RED . $loser->getNicks()->getNick() . $victimPotString;
        }
        $this->core->getSystemManager()->getSceneSystem()->getScene("Hub")?->sceneAnnouncement($msg);
        $this->sceneAnnouncement($msg);

        // Handle messages for spectators
        $this->specMessage();
      }
    }
  }

}