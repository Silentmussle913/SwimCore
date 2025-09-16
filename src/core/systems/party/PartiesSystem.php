<?php

namespace core\systems\party;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use core\systems\System;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class PartiesSystem extends System
{

  private array $parties;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core);
    $this->parties = [];
  }

  /**
   * @return array
   */
  public function getParties(): array
  {
    return $this->parties;
  }

  public function addParty(Party $party): void
  {
    $this->parties[$party->getPartyName()] = $party;
  }

  public function renameParty(string $partyName, string $newPartyName): void
  {
    // Fast path: same key requested. Keep object name consistent, then bail.
    if ($partyName === $newPartyName) {
      if (array_key_exists($partyName, $this->parties)) {
        $this->parties[$partyName]->setPartyName($newPartyName);
      }
      return;
    }

    // Old key must exist.
    if (!array_key_exists($partyName, $this->parties)) {
      echo("Party '$partyName' does not exist.\n");
      return;
    }

    // New key must not already exist (avoid accidental overwrite).
    if (array_key_exists($newPartyName, $this->parties)) {
      echo("Party '$newPartyName' already exists.\n");
      return;
    }

    // Move the entry. This does not copy the whole array; it's just moving a value.
    $party = $this->parties[$partyName];

    // Keep the object's internal name in sync with the map key.
    $party->setPartyName($newPartyName);

    // Create the new key, then remove the old one.
    $this->parties[$newPartyName] = $party;
    unset($this->parties[$partyName]);
  }

  /**
   * @throws ScoreFactoryException
   * this should maybe be a method of Party
   */
  public function disbandParty(Party $party): void
  {
    foreach ($party->getPlayers() as $player) {
      $player->sendMessage(TextFormat::YELLOW . "The party has been disbanded.");
      $player->getSceneHelper()->setNewScene("Hub"); // do we want to do this?
      $player->getSceneHelper()->setParty(null);
    }
    // delete the party
    if (isset($this->parties[$party->getPartyName()])) {
      unset($this->parties[$party->getPartyName()]);
    }
  }

  public function getPartyCount(): int
  {
    return count($this->parties);
  }

  public function getPartyPlayerIsIn(Player $player): ?Party
  {
    foreach ($this->parties as $party) {
      if ($party->hasPlayer($player)) {
        return $party;
      }
    }
    return null;
  }

  public function isInParty(SwimPlayer $player): bool
  {
    foreach ($this->parties as $party) {
      if ($party->hasPlayer($player)) {
        return true;
      }
    }
    return false;
  }

  public function partyNameTaken(string $name): bool
  {
    foreach ($this->parties as $party) {
      if ($party->getPartyName() === $name) {
        return true;
      }
    }
    return false;
  }

  // TO DO : make sure to have proper handling for when this happens during a duel
  // this probably currently does not have proper handling
  /**
   * @throws ScoreFactoryException
   */
  public function handlePlayerLeave(SwimPlayer $swimPlayer): void
  {
    $party = $this->getPartyPlayerIsIn($swimPlayer);
    if ($party) {
      $party->removePlayerFromParty($swimPlayer);
      if ($party->getCurrentPartySize() <= 0) {
        unset($this->parties[$party->getPartyName()]);
      }
    }
  }

  public function init(): void
  {
    // TODO: Implement init() method.
  }

  public function updateTick(): void
  {
    // TODO: Implement updateTick() method.
  }

  public function updateSecond(): void
  {
    // TODO: Implement updateSecond() method.
  }

  public function exit(): void
  {
    // TODO: Implement exit() method.
  }

}