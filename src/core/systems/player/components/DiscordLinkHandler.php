<?php

namespace core\systems\player\components;

use core\communicator\packet\DiscordLinkRequestPacket;
use core\communicator\packet\DiscordUserResponsePacket;
use core\communicator\packet\types\embed\Embed;
use core\database\queries\ConnectionHandler;
use core\systems\player\Component;
use pocketmine\utils\TextFormat;

class DiscordLinkHandler extends Component
{

  private string $discordId;
  private string $discordName;
  private string $avatarUrl;
  /** @var string[] */
  private array $discordRoles;


  private bool $pending = false;

  public function init(): void
  {
    ConnectionHandler::getDiscordLink($this->swimPlayer->getXuid(), function (string $id) {
      if ($id !== "") {
        $this->discordId = $id;
        $this->core->getCommunicator()->requestDiscordUser($id, $this->setInfo(...));
      } else {
        $this->checkLink();
      }
    });
  }

  public function checkLink(): void
  {
    $pk = new DiscordLinkRequestPacket;
    $pk->ign = $this->swimPlayer->getName();
    $this->core->getCommunicator()->write($pk->encodeToString());
  }

  public function isCompleteLink(): bool
  {
    return isset($this->discordId) && !$this->pending;
  }

  public function isPendingLink(): bool
  {
    return isset($this->discordId) && $this->pending;
  }

  public function getDiscordId(): ?string
  {
    return $this->discordId ?? null;
  }

  public function getDiscordRoles(): ?array
  {
    return $this->discordRoles ?? null;
  }

  public function getDiscordName(): ?string
  {
    return $this->discordName ?? null;
  }

  public function getAvatarUrl(): ?string
  {
    return $this->avatarUrl ?? null;
  }

  public function setPendingLink(string $id): void
  {
    $this->discordId = $id;
    unset($this->discordName);
    unset($this->discordRoles);
    unset($this->avatarUrl);
    $this->pending = true;
  }

  public function onLinkAccepted(): void
  {
    if (!$this->pending) {
      $this->swimPlayer->sendMessage(TextFormat::RED . "No link request found");
      return;
    }

    $this->core->getCommunicator()->sendEmbed($this->core->getCommunicator()->getDiscordInfo()->linkAlertsChannel,
      new Embed(title: "LINK ALERT", description: "<@" . $this->discordId . "> linked to " . $this->swimPlayer->getName()));

    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Accepted link");
    $this->removePendingLink();
    $this->core->getCommunicator()->requestDiscordUser($this->discordId, $this->setInfo(...));
    ConnectionHandler::updateDiscordLink($this->swimPlayer->getXuid(), $this->discordId);
  }

  public function onLinkRemoved(): void
  {
    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Removed link");
    ConnectionHandler::removeDiscordLink($this->swimPlayer->getXuid());
    unset($this->discordName);
    unset($this->discordRoles);
    unset($this->avatarUrl);
    unset($this->discordId);
  }

  public function onLinkDenied(): void
  {
    if (!$this->pending) {
      $this->swimPlayer->sendMessage(TextFormat::GREEN . "Denied link");
      $this->removePendingLink();
      return;
    }
    $this->swimPlayer->sendMessage(TextFormat::GREEN . "Denied link");
    if (!isset($this->discordRoles)) {
      unset($this->discordId);
    }
    $this->removePendingLink();
  }

  private function removePendingLink(): void
  {
    $this->pending = false;
    $pk = new DiscordLinkRequestPacket;
    $pk->ign = $this->swimPlayer->getName();
    $pk->remove = true;
    $this->core->getCommunicator()->write($pk->encodeToString());
  }

  private function updatePerms(): void
  {
    if ($this->swimPlayer->getRank()->getRankLevel() < Rank::BOOSTER_RANK && in_array($this->core->getCommunicator()->getDiscordInfo()->boosterRole, haystack: $this->discordRoles)) {
      $this->swimPlayer->getRank()->setTempRank(Rank::BOOSTER_RANK); // dont save booster rank in database
    }
    if ($this->swimPlayer->getRank()->getRankLevel() < Rank::YOUTUBE_RANK && in_array($this->core->getCommunicator()->getDiscordInfo()->youtubeRole, $this->discordRoles)) {
      $this->swimPlayer->getRank()->setTempRank(Rank::YOUTUBE_RANK);
      Rank::attemptRankUpgrade($this->swimPlayer->getXuid(), Rank::YOUTUBE_RANK);
    }
  }

  public function setInfo(DiscordUserResponsePacket $pk): void
  {
    $this->discordName = $pk->name;
    $this->discordRoles = $pk->roles;
    $this->avatarUrl = $pk->avatarUrl;
    $this->updatePerms();
  }

}