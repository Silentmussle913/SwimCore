<?php

namespace core\utils\raklib;

use core\SwimCore;
use core\systems\player\components\NetworkStackLatencyHandler;
use core\systems\player\SwimPlayer;
use core\utils\acktypes\MultiAckWithTimestamp;
use core\utils\acktypes\NslAck;
use core\utils\ProtocolIdToVersion;
use pocketmine\event\server\DataPacketSendEvent;
use pocketmine\lang\Translatable;
use pocketmine\network\mcpe\compression\CompressBatchPromise;
use pocketmine\network\mcpe\compression\Compressor;
use pocketmine\network\mcpe\encryption\EncryptionContext;
use pocketmine\network\mcpe\handler\LoginPacketHandler;
use pocketmine\network\mcpe\handler\PacketHandler;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\protocol\ClientboundPacket;
use pocketmine\network\mcpe\protocol\DisconnectPacket;
use pocketmine\network\mcpe\protocol\NetworkStackLatencyPacket;
use pocketmine\network\mcpe\protocol\Packet;
use pocketmine\network\mcpe\protocol\PlayerListPacket;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\network\mcpe\protocol\types\PlayerListEntry;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\timings\Timings;
use pocketmine\utils\TextFormat;
use raklib\generic\DisconnectReason;
use ReflectionClass;
use pmmp\encoding\ByteBufferWriter;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

use function array_map;
use function array_unshift;
use function count;
use function debug_backtrace;
use function implode;
use function sort;

class SwimNetworkSession extends NetworkSession
{

  private static ReflectionProperty $protocolRefl;
  private static ReflectionProperty $sendBufferRefl;
  private static ReflectionMethod $tryDisconnectRefl;

  private static string $supportedVersions;

  private ?Compressor $origCompressor = null;

  /** @var \Closure[] */
  private array $afterPacketHandledCbs = [];

  private bool $nslEnabled = true;

  private int $mtu = 0;

  public bool $disableVibrantVisuals = false;

  public bool $isNethernet = false;

  public function setMTU(int $mtu): void
  {
    $this->mtu = $mtu;
  }

  public function getMTU(): int
  {
    return $this->mtu;
  }

  /** @var NslAck[] */
  private array $nslBuffer = [];

  public function addToNslBuffer(NslAck $ack): void
  {
    $this->nslBuffer[] = $ack;
  }

  public function handleDataPacket(Packet $packet, string $buffer): void
  {
    /*
    if($packet->pid() === PlayerAuthInputPacket::NETWORK_ID) {
      $this->callAfterPacketHandledCbs();
    }
    */
    parent::handleDataPacket($packet, $buffer);
    $this->callAfterPacketHandledCbs();
  }

  private function callAfterPacketHandledCbs(): void
  {
    if (count($this->afterPacketHandledCbs) > 0) {
      foreach ($this->afterPacketHandledCbs as $cb) {
        $cb();
      }
      $this->afterPacketHandledCbs = [];
    }
  }

  public function addAfterPacketHandledCb(\Closure $cb): void
  {
    $this->afterPacketHandledCbs[] = $cb;
  }

  public function getProtocolId(): int
  {
    if (SwimCore::$isNetherGames) {
      return parent::getProtocolId();
    }
    return ProtocolInfo::CURRENT_PROTOCOL;
  }

  public function setHandler(?PacketHandler $handler): void
  {
    if ($handler instanceof LoginPacketHandler) {
      $refl = new ReflectionClass(LoginPacketHandler::class);
      $authCb = $refl->getProperty("authCallback");
      $oldAuthCb = $authCb->getValue($handler);
      $authCb->setValue($handler, function (bool $authed, bool $authRequired, Translatable|string|null $error, ?string $clientPubKey)
      use ($oldAuthCb): void {
        if ($this->isNethernet) {
          EncryptionContext::$ENABLED = false;
        }
        // $is = $this->isNethernet ? "true" : "false";
        // echo("SwimNetworkSession isNetherNet: $is \n");
        $oldAuthCb($authed, $authRequired, $error, $clientPubKey);
        if ($this->isNethernet) {
          EncryptionContext::$ENABLED = true;
        }
      });
    }
    parent::setHandler($handler);
  }

  public function tick(): void
  {
    $this->flushNslBuffer();
    parent::tick();
  }

  public function queueCompressed(CompressBatchPromise|string $payload, bool $immediate = false): void
  {
    $this->flushNslBuffer(false);
    parent::queueCompressed($payload, $immediate);
  }

  private function prependToSendBuffer(string $buf): void
  {
    if (!isset(self::$sendBufferRefl)) {
      self::$sendBufferRefl = new ReflectionProperty(NetworkSession::class, "sendBuffer");
    }

    $sendBuf = self::$sendBufferRefl->getValue($this);
    array_unshift($sendBuf, $buf);
    self::$sendBufferRefl->setValue($this, $sendBuf);
  }

  private function flushNslBuffer(bool $mainPing = true): void
  {
    if (!$this->nslEnabled) {
      if (count($this->nslBuffer) > 0) {
        $this->nslBuffer = [];
      }
      return;
    }

    if (!$mainPing && count($this->nslBuffer) === 0) {
      return;
    }

    // PluginTimings::$nsl->startTiming();
    /** @var SwimPlayer $pl */
    $pl = $this->getPlayer();
    if ($pl && $pl->isConnected() && $pl->getAckHandler() !== null) {
      $timestamp = NetworkStackLatencyHandler::randomIntNoZeroEnd();
      $nsl = NetworkStackLatencyPacket::create($timestamp * 1000, true);
      $buf = SwimCore::$isNetherGames ?
        self::encodePacketTimed(new ByteBufferWriter(), $this->getProtocolId(), $nsl) : self::encodePacketTimed(new ByteBufferWriter(), $nsl);
      $this->prependToSendBuffer($buf);
      $pl->getAckHandler()?->add($timestamp, new MultiAckWithTimestamp($this->nslBuffer, !$mainPing));
      if (count($this->nslBuffer) > 0) {
        $this->nslBuffer = [];
      }
    }
    // PluginTimings::$nsl->stopTiming();
  }

  public function sendDataPacket(ClientboundPacket $packet, bool $immediate = false): bool
  {
    if ($immediate) {
      $this->flushNslBuffer(false);
    }
    return parent::sendDataPacket($packet, $immediate);
  }

  public function setNslEnabled(bool $enabled): void
  {
    $this->nslEnabled = $enabled;
  }

  public function sendDataPacketRepeat(ClientboundPacket $packet, bool $immediate, int $times): bool
  {
    if (!$this->isConnected()) {
      return false;
    }

    $timings = Timings::getSendDataPacketTimings($packet);
    $timings->startTiming();
    try {
      if (DataPacketSendEvent::hasHandlers()) {
        $ev = new DataPacketSendEvent([$this], [$packet]);
        $ev->call();
        if ($ev->isCancelled()) {
          return false;
        }
        $packets = $ev->getPackets();
      } else {
        $packets = [$packet];
      }

      $writer = new ByteBufferWriter();
      foreach ($packets as $evPacket) {
        $writer->clear();
        $encoded = SwimCore::$isNetherGames ?
          self::encodePacketTimed($writer, $this->getProtocolId(), $evPacket) : self::encodePacketTimed($writer, $evPacket);
        for ($i = 0; $i < $times; $i++) {
          $this->addToSendBuffer($encoded);
        }
      }
      if ($immediate) {
        //$this->flushSendBuffer(true);
      }

      return true;
    } finally {
      $timings->stopTiming();
    }
  }

  public function sendDataPacketNoEvent(ClientboundPacket $packet): bool
  {
    if (!$this->isConnected()) {
      return false;
    }

    $timings = Timings::getSendDataPacketTimings($packet);
    $timings->startTiming();
    try {
      $encoded = SwimCore::$isNetherGames ?
        self::encodePacketTimed(new ByteBufferWriter(), $this->getProtocolId(), $packet) : self::encodePacketTimed(new ByteBufferWriter(), $packet);
      $this->addToSendBuffer($encoded);
      return true;
    } finally {
      $timings->stopTiming();
    }
  }

  /**
   * @throws ReflectionException
   */
  public function disconnectIncompatibleProtocol(int $protocolVersion): void
  {
    if (SwimCore::$isNetherGames) {
      if (!isset(self::$protocolRefl)) {
        self::$protocolRefl = (new ReflectionClass(NetworkSession::class))->getProperty("protocolId");
      }
      self::$protocolRefl->setValue($this, $protocolVersion);
    }

    if (!isset(self::$supportedVersions)) {
      $supported = [];
      foreach (ProtocolIdToVersion::getMap() as $protocol => $name) {
        $supported[] = TextFormat::GREEN . $name . " ($protocol)";
      }
      sort($supported);
      self::$supportedVersions = "Supported version" . (count($supported) !== 1 ? "s" : "") . ": "
        . implode(TextFormat::WHITE . ", ", $supported);
    }

    $this->disconnect(TextFormat::RED . "We do not currently support your version of Minecraft ($protocolVersion).\n"
      . TextFormat::WHITE . self::$supportedVersions, null, true,
      ProtocolInfo::CURRENT_PROTOCOL > $protocolVersion ? DisconnectReason::CLIENT_DISCONNECT : DisconnectReason::SERVER_DISCONNECT);
  }

  /**
   * Called by the Player when it is closed (for example due to getting kicked).
   * @throws ReflectionException
   */
  public function onPlayerDestroyed
  (
    Translatable|string $reason,
    Translatable|string $disconnectScreenMessage,
    int                 $disconnectReason = DisconnectReason::CLIENT_DISCONNECT
  ): void
  {
    if (!isset(self::$tryDisconnectRefl)) {
      self::$tryDisconnectRefl = new ReflectionMethod(NetworkSession::class, "tryDisconnect");
    }
    self::$tryDisconnectRefl->invoke($this, function () use ($disconnectScreenMessage, $disconnectReason): void {
      $this->sendDisconnectPacketWithReason($disconnectScreenMessage, $disconnectReason);
    }, $reason);
  }

  /**
   * Disconnects the session, destroying the associated player (if it exists).
   *
   * @param Translatable|string $reason Shown in the server log - this should be a short one-line message
   * @param Translatable|string|null $disconnectScreenMessage Shown on the player's disconnection screen (null will use the reason)
   * @throws ReflectionException
   */
  public function disconnect
  (
    Translatable|string      $reason,
    Translatable|string|null $disconnectScreenMessage = null,
    bool                     $notify = true,
    int                      $disconnectReason = DisconnectReason::CLIENT_DISCONNECT
  ): void
  {
    if (!isset(self::$tryDisconnectRefl)) {
      self::$tryDisconnectRefl = new ReflectionMethod(NetworkSession::class, "tryDisconnect");
    }
    self::$tryDisconnectRefl->invoke($this, function () use ($reason, $disconnectScreenMessage, $notify, $disconnectReason): void {
      if ($notify) {
        $this->sendDisconnectPacketWithReason($disconnectScreenMessage ?? $reason, $disconnectReason);
      }
      $this->getPlayer()?->onPostDisconnect($reason, null);
    }, $reason);
  }

  private function sendDisconnectPacketWithReason(Translatable|string $message, int $reason): void
  {
    if ($message instanceof Translatable) {
      $translated = Server::getInstance()->getLanguage()->translate($message);
    } else {
      $translated = $message;
    }
    $this->sendDataPacket(DisconnectPacket::create($reason, $translated, ""));
  }

  /*
    1.21.130 and above, all these overrides below are broken because players now need to have the real UUID
    of the player who is broadcasting the skin packets to actually accept the skin, otherwise everyone is a Steve skin.
    This is due to the player list having a contract on the client to only accept skins of players it knows exist in
    that list to avoid memory leaks from excess skins being sent out.
  */

  /*
  public function onPlayerAdded(Player $p): void
  {
    /* // I guess we could do something like this? not worth it right now to try.
    if (SwimCore::$isNetherGames) {
      if ($this->getProtocolId() < ProtocolInfo::CURRENT_PROTOCOL) {
        parent::onPlayerAdded($p);
        return;
      }
    }
    */
    /*

    $bt = debug_backtrace(0, 2);
    if (isset($bt[1]["function"]) && $bt[1]["function"] === "addOnlinePlayer") {
      return;
    }

    if ($p === $this->getPlayer()) {
      $id = $p->getUniqueId();
    } else {
      $id = $p->getRandomUUID();
    }

    $this->sendDataPacket(PlayerListPacket::add([PlayerListEntry::createAdditionEntry(
      $id, $p->getId(), $p->getDisplayName(), $this->getTypeConverter()->getSkinAdapter()->toSkinData($p->getSkin()), $p->getXuid())
    ]));
  }
  */

  /**
   * @param SwimPlayer[] $players
   */
  /*
  public function syncPlayerList(array $players): void
  {
    $this->sendDataPacket(PlayerListPacket::add(array_map(function (SwimPlayer $player): PlayerListEntry {
      if ($player === $this->getPlayer()) {
        $id = $player->getUniqueId();
      } else {
        $id = $player->getRandomUUID();
      }

      return PlayerListEntry::createAdditionEntry(
        $id,
        $player->getId(),
        $player->getDisplayName(),
        $this->getTypeConverter()->getSkinAdapter()->toSkinData($player->getSkin()),
        $player->getXuid()
      );
    }, $players)));
  }
  */

  /*
  public function onPlayerRemoved(Player $p): void
  {
    if ($p !== $this->getPlayer()) {
      $this->sendDataPacket(PlayerListPacket::remove([PlayerListEntry::createRemovalEntry($p->getRandomUUID())]));
    }
  }
  */

}