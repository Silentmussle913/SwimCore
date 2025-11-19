<?php

namespace core\utils\raklib;

use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

class LogKickPacket
{

  public const ID = 0x00;

  private string $type;
  private string $player;
  private string $extraData;

  public function __construct()
  {

  }

  public function decode(ByteBufferReader $reader): void
  {
    $this->type = CommonTypes::getString($reader);
    $this->player = CommonTypes::getString($reader);
    $this->extraData = CommonTypes::getString($reader);
  }

  public function sendLog(): void
  {
    // nop
  }

}