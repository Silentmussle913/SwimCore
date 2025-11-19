<?php

namespace core\utils\raklib;

use pmmp\encoding\ByteBufferReader;
use pmmp\encoding\LE;

class NetherNetNoticePacket
{

  public const ID = 0x01;

  private int $sessionId;

  public function __construct()
  {

  }

  public function decode(ByteBufferReader $reader): void
  {
    $this->sessionId = LE::readSignedInt($reader);
  }

  public function getSessionId(): int
  {
    return $this->sessionId;
  }

}