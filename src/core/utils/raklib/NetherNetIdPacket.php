<?php

namespace core\utils\raklib;

use core\SwimCoreInstance;
use pmmp\encoding\ByteBufferReader;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

class NetherNetIdPacket
{

  public const ID = 0x02;

  private string $nethernetId;

  public function __construct()
  {

  }

  public function decode(ByteBufferReader $reader): void
  {
    $this->nethernetId = CommonTypes::getString($reader);
  }

  public function handle(): void
  {
    SwimCoreInstance::getInstance()->setNethernetId($this->nethernetId);
  }

}