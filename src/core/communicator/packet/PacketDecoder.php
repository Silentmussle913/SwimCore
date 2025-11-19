<?php

namespace core\communicator\packet;

use core\communicator\Communicator;
use pocketmine\utils\Binary;

class PacketDecoder
{

  private string $buf = "";

  public function decodeFromString(string $buf): array
  {
    $packets = [];

    $buf = $this->buf . $buf;

    $numRead = 0;
    $totalLen = strlen($buf);
    while ($numRead < $totalLen) {
      if (strlen($buf) < 4) {
        $this->buf = $buf;
        return $packets;
      }
      $len = Binary::readInt($buf);

      $numRead += $len + 4;
      if (strlen($buf) < $len + 4) {
        $this->buf = $buf;
        return $packets;
      }
      $buf = substr($buf, 4);

      $data = substr($buf, 0, $len);
      $this->buf = "";

      $packets[] = $data;

      $buf = substr($buf, $len);
    }

    return $packets;
  }

  public function decodeFromStringCommunicator(string $buf, Communicator $communicator): array
  {
    $packets = [];

    $buf = $this->buf . $buf;

    $numRead = 0;
    $totalLen = strlen($buf);
    while ($numRead < $totalLen) {
      if (strlen($buf) < 2) {
        $this->buf = $buf;
        return $packets;
      }
      $len = Binary::readShort($buf);

      $numRead += $len + 2;
      if (strlen($buf) < $len + 2) {
        $this->buf = $buf;
        return $packets;
      }
      $buf = substr($buf, 2);

      $data = substr($buf, 0, $len);
      $this->buf = "";
      $packets[] = Packet::decode(new PacketSerializer($data), $communicator);

      $buf = substr($buf, $len);
    }

    return $packets;
  }

}