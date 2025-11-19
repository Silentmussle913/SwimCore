<?php

namespace core\utils\raklib;

use DateTime;
use Logger;

use raklib\generic\PacketHandlingException as RaklibPacketHandlingException;
use pocketmine\utils\BinaryDataException;
use raklib\generic\DisconnectReason;
use raklib\generic\SocketException;
use raklib\protocol\ACK;
use raklib\protocol\Datagram;
use raklib\protocol\NACK;
use raklib\protocol\Packet;
use raklib\protocol\PacketSerializer;
use raklib\server\ProtocolAcceptor;
use raklib\server\Server;
use raklib\server\ServerEventListener;
use raklib\server\ServerEventSource;
use raklib\server\ServerSession;
use raklib\server\ServerSocket;
use raklib\utils\ExceptionTraceCleaner;
use raklib\utils\InternetAddress;
use ReflectionException;
use ReflectionMethod;

use function asort;
use function bin2hex;
use function count;
use function microtime;
use function morton2d_decode;
use function ord;
use function preg_match;
use function str_contains;
use function strlen;
use function time;
use function time_sleep_until;
use const PHP_INT_MAX;
use const SOCKET_ECONNRESET;

class SwimRakLibRawServer extends Server
{

  private const MAX_UNCONNECTED_PPS = 15000;
  private const PPS_CLEAR_INTERVAL = 10;
  private const MAX_SHUTDOWN_MS = 1000;

  private const ACTUAL_MAX_UNCONNECTED_PPS = self::MAX_UNCONNECTED_PPS * self::PPS_CLEAR_INTERVAL;

  private const RAKLIB_TPS = 1000;
  private const RAKLIB_TIME_PER_TICK = 1 / self::RAKLIB_TPS;

  private bool $isBeingDdosed = false;
  private bool $forcedAntiDdos = false;
  public bool $blockNewConnections = false;
  private int $dosSec = 0;
  private int $lastBlockTime = 0;
  private int $unconnectedPps = 0;
  private ServerEventSource $eventSource;
  private ServerEventListener $eventListener;

  private ReflectionMethod $removeSessionInternal;
  private ReflectionMethod $checkSessions;

  public int $ipHeaderSize;

  /**
   * @throws ReflectionException
   */
  public function __construct
  (
    int                   $serverId,
    Logger                $logger,
    ServerSocket          $socket,
    int                   $maxMtuSize,
    ProtocolAcceptor      $protocolAcceptor,
    ServerEventSource     $eventSource,
    ServerEventListener   $eventListener,
    ExceptionTraceCleaner $traceCleaner
  )
  {
    $this->eventSource = $eventSource;
    $this->eventListener = $eventListener;
    parent::__construct($serverId, $logger, $socket, $maxMtuSize, $protocolAcceptor, $eventSource, $eventListener, $traceCleaner);
    $this->removeSessionInternal = (new ReflectionMethod(Server::class, "removeSessionInternal"));
    $this->checkSessions = (new ReflectionMethod(Server::class, "checkSessions"));
    $this->packetLimit = 1000;
    $this->unconnectedMessageHandler = new SecureUnconnectedMessageHandler($this, $protocolAcceptor);
    $this->logger = new StubLogger();
    $this->ipHeaderSize = str_contains($socket->getBindAddress()->getIp(), ":") ? 40 : 20;
  }

  /**
   * @throws ReflectionException
   */
  public function tickProcessor(): void
  {
    $start = microtime(true);

    /*
     * The below code is designed to allow co-op between sending and receiving to avoid slowing down either one
     * when high traffic is coming either way. Yielding will occur after 50 messages.
     */
    do {
      $stream = !$this->shutdown;
      for ($i = 0; $i < 50 && $stream && !$this->shutdown; ++$i) { //if we received a shutdown event, we don't care about any more messages from the event source
        $stream = $this->eventSource->process($this);
      }

      $socket = true;
      for ($i = 0; $i < 50 && $socket; ++$i) {
        $socket = $this->receivePacket();
      }
    } while ($stream || $socket);

    $this->tick();

    $time = microtime(true) - $start;
    if ($time < self::RAKLIB_TIME_PER_TICK) {
      @time_sleep_until(microtime(true) + self::RAKLIB_TIME_PER_TICK - $time);
    }
  }

  public function isShuttingDown(): bool
  {
    return $this->shutdown;
  }

  /**
   * @throws ReflectionException
   */
  public function waitShutdown(): void
  {
    $shutdownStart = microtime(true) * 1000;
    $this->shutdown = true;

    while ($this->eventSource->process($this)) {
      if (microtime(true) * 1000 - $shutdownStart > self::MAX_SHUTDOWN_MS) {
        $this->socket->close();
        $this->logger->warning("Force shutdown");
        return;
      }
      //Ensure that any late messages are processed before we start initiating server disconnects, so that if the
      //server implementation used a custom disconnect mechanism (e.g. a server transfer), we don't break it in
      //race conditions.
    }

    foreach ($this->sessions as $session) {
      $session->forciblyDisconnect(DisconnectReason::SERVER_SHUTDOWN);
    }

    while (count($this->sessions) > 0) {
      $this->tickProcessor();
      if (microtime(true) * 1000 - $shutdownStart > self::MAX_SHUTDOWN_MS) {
        $this->socket->close();
        $this->logger->warning("Force shutdown");
        return;
      }
    }

    $this->socket->close();
    $this->logger->debug("Graceful shutdown complete");
  }

  /**
   * Runs once per RakLib tick (1 kHz).
   * - Flushes delayed *send* / *recv* entries for every session
   * - Ticks session state machines
   * - Handles bandwidth stats, IP-block expiry, DDOS state, etc.
   * @throws ReflectionException
   */
  private function tick(): void
  {
    $time = microtime(true);

    /* -----------------------------------------------------------------
     * 1) Per-session maintenance
     * ----------------------------------------------------------------- */
    foreach ($this->sessions as $session) {
      $cleanRecv = false;
      $cleanSend = false;

      /* ---------- Process queued *received* packets ---------- */
      foreach ($session->getRecvEntries() as $e => $pk) {
        if ($pk[0] < $time) {
          $cleanRecv = true;

          /*  new fix to quarantine malformed split-packets here too  */
          try {
            $session->handlePacket($pk[1]);
          } catch (RaklibPacketHandlingException $ex) {
            /* Same mitigation path we use in receivePacket() */
            $this->logger->warning(
              "Dropped {$session->getAddress()->toString()} – {$ex->getMessage()}"
            );
            $this->blockAddress($session->getAddress()->getIp(), 60, true);
            $session->forciblyDisconnect(DisconnectReason::SPLIT_PACKET_TOO_LARGE);

            /* Skip post-processing for this entry */
            $session->removeRecvEntry($e);
            continue; /* to next queued packet */
          }

          $session->removeRecvEntry($e);
        }
      }

      /* ---------- Process queued *outgoing* packets ---------- */
      foreach ($session->getSendEntries() as $e => $pk) {
        if ($pk[0] < $time) {
          $cleanSend = true;
          $this->sendPacketInternal($pk[1], $session->getAddress());
          $session->removeSendEntry($e);
        }
      }

      /* ---------- Clean dead queues & update session ---------- */
      $session->cleanEntries($cleanSend, $cleanRecv);
      $session->update($time);

      /* ---------- Remove fully-disconnected sessions ---------- */
      if ($session->isFullyDisconnected()) {
        $this->removeSessionInternal->invokeArgs($this, [$session]);
      }
    }

    /* -----------------------------------------------------------------
     * 2) Global per-tick / per-second maintenance
     * ----------------------------------------------------------------- */
    if ($this->ticks % (self::RAKLIB_TPS / 10) == 0) {
      $this->ipSec = [];
    }
    if ($this->ticks % (self::RAKLIB_TPS * self::PPS_CLEAR_INTERVAL) == 0) {
      if (
        $this->isBeingDdosed &&
        time() - $this->lastBlockTime > 20 &&
        $this->unconnectedPps * 2 < self::ACTUAL_MAX_UNCONNECTED_PPS
      ) {
        $this->unconnectedMessageHandler->trustedAddresses = [];
        $this->isBeingDdosed = false;
        $this->eventListener->onPacketReceive(-69420, "ddosEnd");
      }

      $this->unconnectedMessageHandler->trustedAddresses = [];
      $this->dosSec = 0;
      $this->unconnectedPps = 0;
    }

    /* -----------------------------------------------------------------
     * 3) Once-per-second maintenance (bandwidth stats + IP block expiry)
     * ----------------------------------------------------------------- */
    if (!$this->shutdown && ($this->ticks % self::RAKLIB_TPS) === 0) {
      if ($this->sendBytes > 0 || $this->receiveBytes > 0) {
        $this->eventListener->onBandwidthStatsUpdate($this->sendBytes, $this->receiveBytes);
        $this->sendBytes = 0;
        $this->receiveBytes = 0;
      }

      if (count($this->block) > 0) {
        asort($this->block);
        $now = time();
        foreach ($this->block as $address => $timeout) {
          if ($timeout <= $now) {
            unset($this->block[$address]);
          } else {
            break;
          }
        }
      }
    }

    ++$this->ticks;
  }

  public function sendPacket(Packet $packet, InternetAddress $address): void
  {
    $session = $this->getSessionByAddress($address);
    if (!$session || $session->getSpoofAmt() == 0) {
      $this->sendPacketInternal($packet, $address);
      return;
    }
    $session->addSendEntry(microtime(true) + $session->getTotalSpoofAmt(), $packet);
  }

  public function sendPacketInternal(Packet $packet, InternetAddress $address): void
  {
    $out = new PacketSerializer();
    $packet->encode($out);
    try {
      $this->sendBytes += $this->socket->writePacket($out->getBuffer(), $address->getIp(), $address->getPort());
    } catch (SocketException $e) {
      $this->logger->debug($e->getMessage());
    }
  }

  /**
   * Reads one UDP datagram from the bound socket, performs basic
   * anti-abuse checks, and hands the decoded Datagram/ACK/NACK to the
   * appropriate Session. Malformed split-packets that trigger a
   * PacketHandlingException will now be safely quarantined instead of
   * crashing the RakLib thread.
   *
   * @return bool  True  => continue polling socket
   *               False => no more data available
   * @throws ReflectionException
   */
  private function receivePacket(): bool
  {
    /* ----------------------------------------------------------
     * 1) Read raw datagram from the socket
     * ---------------------------------------------------------- */
    try {
      $buffer = $this->socket->readPacket($addressIp, $addressPort);
    } catch (SocketException $e) {
      $error = $e->getCode();

      /* ECONNRESET => harmless client crash or NAT time-out */
      if ($error === SOCKET_ECONNRESET) {
        return true; /* keep looping */
      }

      $this->logger->debug($e->getMessage());
      return false; /* give caller chance to poll other sources */
    }

    if ($buffer === null) {
      return false; /* nothing pending on socket */
    }

    $len = strlen($buffer);
    $this->receiveBytes += $len;

    /* ----------------------------------------------------------
     * 2) Quick-exit checks: blocked IP / packet flood guard
     * ---------------------------------------------------------- */
    if (isset($this->block[$addressIp])) {
      return true; /* ignore but carry on polling */
    }

    if (isset($this->ipSec[$addressIp])) {
      if (++$this->ipSec[$addressIp] >= $this->packetLimit) {
        $this->blockAddress($addressIp);
        return true;
      }
    } else {
      $this->ipSec[$addressIp] = 1;
    }

    if ($len < 1) {
      return true; /* stray empty datagram */
    }

    /* ----------------------------------------------------------
     * 3) Hand off to the correct Session (or unconnected handler)
     * ---------------------------------------------------------- */
    $address = new InternetAddress(
      $addressIp,
      $addressPort,
      $this->socket->getBindAddress()->getVersion()
    );

    try {
      $session = $this->getSessionByAddress($address);
      if ($session !== null) {
        /** @var SwimServerSession $session */
        $header = ord($buffer[0]);

        if (($header & Datagram::BITFLAG_VALID) !== 0) {
          /* Decode Datagram / ACK / NACK -------------------------------- */
          if (($header & Datagram::BITFLAG_ACK) !== 0) {
            $packet = new ACK();
          } elseif (($header & Datagram::BITFLAG_NAK) !== 0) {
            $packet = new NACK();
          } else {
            $packet = new Datagram();
          }
          $packet->decode(new PacketSerializer($buffer));

          // Critical packet splitting check with try catch
          try {
            if ($session->getSpoofAmt() === 0) {
              $session->handlePacket($packet);
            } else {
              $session->addRecvEntry(
                microtime(true) + $session->getTotalSpoofAmt(),
                $packet
              );
            }
          } catch (RaklibPacketHandlingException $ex) {
            /* The client sent a malformed or malicious split-packet.
             * 1) Log it
             * 2) Temp-ban the IP for 60 s, mark as DDOS so limits tighten
             * 3) Forcibly disconnect the session
             * 4) Swallow the exception so the RakLib thread survives
             */
            $this->logger->warning(
              "Dropped {$address->toString()} – " . $ex->getMessage()
            );

            $this->blockAddress($address->getIp(), 60, true);
            $session->forciblyDisconnect(
              DisconnectReason::SPLIT_PACKET_TOO_LARGE
            );

            return true; /* continue processing other packets */
          }

          return true; /* session handled successfully */
        }

        /* Unconnected datagram for an already-connected session --------- */
        if ($session->isConnected()) {
          $this->logger->debug(
            "Ignored unconnected packet from $address (0x" .
            bin2hex($buffer[0]) . ")"
          );
          return true;
        }
      }

      /* ----------------------------------------------------------
       * 4) Unconnected packet flow / anti-DDOS counters
       * ---------------------------------------------------------- */
      if (++$this->unconnectedPps > self::ACTUAL_MAX_UNCONNECTED_PPS
        && !$this->isBeingDdosed) {
        $this->isBeingDdosed = true;
        $this->eventListener->onPacketReceive(-69420, "ddosStart");
      }

      if (!$this->shutdown) {
        $handled = $this->unconnectedMessageHandler->handleRaw(
          $buffer,
          $address
        );

        if (!$handled && !$this->getIsBeingDdosed()) {
          foreach ($this->rawPacketFilters as $pattern) {
            if (preg_match($pattern, $buffer) > 0) {
              $handled = true;
              $this->eventListener->onRawPacketReceive(
                $address->getIp(),
                $address->getPort(),
                $buffer
              );
              break;
            }
          }
        }

        if (!$handled) {
          $this->logger->debug(
            "Ignored packet from $address due to no session opened (0x" .
            bin2hex($buffer[0]) . ")"
          );
        }
      }
    } catch (BinaryDataException $e) {
      /* Totally busted datagram – instant short ban */
      $this->blockAddress($address->getIp(), 5, true);
    }

    return true; /* keep polling */
  }

  public function openSession(ServerSession $session): void
  {
    $address = $session->getAddress();
    $this->eventListener->onClientConnect($session->getInternalId(), $address->getIp(), $address->getPort(), $session->getMTUSize());
  }

  public function blockAddress(string $address, int $timeout = 300, bool $ddos = false): void
  {
    if ($address === "enableForcedAD") {
      $this->forcedAntiDdos = true;
      return;
    }
    if ($address === "enableForcedAD true") {
      $this->forcedAntiDdos = true;
      $this->blockNewConnections = true;
      return;
    }
    if ($address === "disableForcedAD") {
      $this->forcedAntiDdos = false;
      $this->blockNewConnections = false;
      return;
    }
    if (str_contains($address, " ")) {
      $session = $this->sessionsByAddress[$address] ?? null;
      if (!$session)
        return;
      [$ping, $jitter] = morton2d_decode($timeout);
      if ($ping < 0 || $jitter < 0) {
        return;
      }
      $session->setSpoofAmt($ping);
      $session->setSpoofJitter($jitter);
      return;
    }
    $final = time() + $timeout;
    if (!isset($this->block[$address]) || $timeout === -1) {
      if ($timeout === -1) {
        $final = PHP_INT_MAX;
      } else {
        if ($ddos) {
          $this->dosSec++;
          if ($this->dosSec > 20 && !$this->isBeingDdosed) {
            $this->isBeingDdosed = true;
            $this->eventListener->onPacketReceive(-69420, "ddosStart");
          }
          if ($this->isBeingDdosed) {
            $this->lastBlockTime = time();
          } else {
            $time = new DateTime();
            print ("\u{001b}[38;5;87m" . $time->format("[H:i:s.v]") . " [AntiDDOS] Blocked $address for $timeout seconds\u{001b}[0m\n");
          }
        } else {
          $time = new DateTime();
          print ("\u{001b}[38;5;87m" . $time->format("[H:i:s.v]") . " [NOTICE] Blocked $address for $timeout seconds\u{001b}[0m\n");
          //$this->logger->notice("Blocked $address for $timeout seconds");
        }
      }
      $this->block[$address] = $final;
    } elseif ($this->block[$address] < $final) {
      $this->block[$address] = $final;
    }
  }

  public function getIsBeingDdosed(): bool
  {
    return $this->isBeingDdosed || $this->forcedAntiDdos;
  }

  public function closeSession(int $sessionId): void
  {
    if (isset($this->sessions[$sessionId])) {
      foreach ($this->sessions[$sessionId]->getSendEntries() as $e => $pk) {
        $this->sendPacketInternal($pk[1], $this->sessions[$sessionId]->getAddress());
        $this->sessions[$sessionId]->removeSendEntry($e);
      }
      $this->sessions[$sessionId]->forciblyDisconnect(DisconnectReason::SERVER_DISCONNECT);
    }
  }

  /**
   * @throws ReflectionException
   */
  public function createSession(InternetAddress $address, int $clientId, int $mtuSize): ServerSession
  {
    $existingSession = $this->sessionsByAddress[$address->toString()] ?? null;
    if ($existingSession !== null) {
      $existingSession->forciblyDisconnect(DisconnectReason::CLIENT_RECONNECT);
      $this->removeSessionInternal->invokeArgs($this, [$existingSession]);
    }

    $this->checkSessions->invoke($this);

    while (isset($this->sessions[$this->nextSessionId])) {
      $this->nextSessionId++;
      $this->nextSessionId &= 0x7fffffff; //we don't expect more than 2 billion simultaneous connections, and this fits in 4 bytes
    }

    $session = new SwimServerSession($this, $this->logger, clone $address, $clientId, $mtuSize, $this->nextSessionId);
    $this->sessionsByAddress[$address->toString()] = $session;
    $this->sessions[$this->nextSessionId] = $session;
    $this->logger->debug("Created session for $address with MTU size $mtuSize");

    return $session;
  }

}