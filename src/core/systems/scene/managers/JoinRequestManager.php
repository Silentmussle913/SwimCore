<?php

namespace core\systems\scene\managers;

use core\systems\player\SwimPlayer;
use core\systems\scene\Scene;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\utils\TextFormat;

class JoinRequestManager
{

  private Scene $scene;

  private array $joinRequests = array();

  public function __construct(Scene $scene)
  {
    $this->scene = $scene;
  }

  public function hasSentJoinRequest(SwimPlayer $player): bool
  {
    return isset($this->joinRequests[$player->getId()]);
  }

  public function sendJoinRequest(SwimPlayer $player): void
  {
    $this->joinRequests[$player->getId()] = $player;
  }

  /**
   * @throws ScoreFactoryException
   * You should check hasSentJoinRequest() first!
   */
  public function acceptedJoinRequest(SwimPlayer $player, SwimPlayer $owner): void
  {
    $sh = $player->getSceneHelper();

    $inParty = $sh?->isInParty();
    if ($inParty) {
      $owner->sendMessage(TextFormat::RED . "They are in a party and can not be accepted to join your game.");
      return;
    }

    $inHub = strtolower($sh?->getScene()->getSceneName()) === "hub";
    if (!$inHub) {
      $owner->sendMessage(TextFormat::RED . "They are not in the hub and can not be accepted to join your game.");
      return;
    }

    // otherwise, we can accept them to join
    $party = $owner->getSceneHelper()?->getParty();
    $party?->addPlayerToParty($player);
    $sh?->setNewScene($this->scene->getSceneName());
    // $this->scene->sceneAnnouncement(TextFormat::GREEN . "{$player->getNicks()->getNick()} joined!");
    unset($this->joinRequests[$player->getId()]);
  }

}