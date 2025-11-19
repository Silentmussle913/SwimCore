<?php

namespace core\utils\raklib;

use core\communicator\packet\PacketDecoder;
use pmmp\thread\ThreadSafeArray;
use pocketmine\network\mcpe\raklib\PthreadsChannelReader;
use pocketmine\network\mcpe\raklib\RakLibServer;
use pocketmine\network\mcpe\raklib\SnoozeAwarePthreadsChannelWriter;
use pocketmine\snooze\SleeperHandlerEntry;
use pocketmine\thread\log\ThreadSafeLogger;
use pocketmine\utils\Binary;
use raklib\utils\InternetAddress;

class RakRouterRaklibServer extends RakLibServer
{
  private const TPS = 2000;
  private const TIME_PER_TICK = 1 / self::TPS;

  public function __construct(
    ThreadSafeLogger    $logger,
    ThreadSafeArray     $mainToThreadBuffer,
    ThreadSafeArray     $threadToMainBuffer,
    int                 $serverId,
    SleeperHandlerEntry $sleeperEntry,
    protected string    $socketPath,
    protected string    $serverKey,
  )
  {
    parent::__construct
    (
      $logger,
      $mainToThreadBuffer,
      $threadToMainBuffer,
      new InternetAddress("", 0, 0),
      $serverId,
      1400,
      10,
      $sleeperEntry
    );
  }

  protected function onRun(): void
  {
    $socket = stream_socket_client("unix://" . $this->socketPath);
    stream_set_blocking($socket, false);
    fwrite($socket, Binary::writeByte(strlen($this->serverKey)) . $this->serverKey);
    $reader = new PthreadsChannelReader($this->mainToThreadBuffer);
    $writer = new SnoozeAwarePthreadsChannelWriter($this->threadToMainBuffer, $this->sleeperEntry->createNotifier());
    $this->synchronized(function (): void {
      $this->ready = true;
      $this->notify();
    });
    $dec = new PacketDecoder();
    while (!$this->isKilled) {
      $start = microtime(true);
      $pk = "";
      while ($msg = $reader->read()) {
        $pk .= Binary::writeInt(strlen($msg)) . $msg;
      }
      if ($pk !== "") {
        $this->fwrite_all($socket, $pk);
      }
      while ($msg = fread($socket, 65535)) {
        if ($msg === "") {
          break;
        }
        foreach ($dec->decodeFromString($msg) as $pk) {
          if (strlen($pk) > 0) {
            if (ord($pk[0]) === 8) {
              echo(substr($pk, 1) . "\n");
            } else {
              $writer->write($pk);
            }
          }
        }
      }
      $time = microtime(true) - $start;
      if ($time < self::TIME_PER_TICK) {
        @time_sleep_until(microtime(true) + self::TIME_PER_TICK);
      }
    }
    fclose($socket);
  }

  private function fwrite_all($handle, string $data): void
  {
    $original_len = strlen($data);
    if ($original_len > 0) {
      $len = $original_len;
      $written_total = 0;
      for ($i = 0; $i < 1000; $i++) {
        $written_now = fwrite($handle, $data);
        if ($written_now === $len) {
          return;
        }
        if ($written_now < 1) {
          usleep(1000);
        }
        $written_total += $written_now; // why does this exist?
        $data = substr($data, $written_now);
        $len -= $written_now;
        // assert($len > 0);
        // assert($len === strlen($data));
      }
      assert($len === strlen($data));
    }
  }

}