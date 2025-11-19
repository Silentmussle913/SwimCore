<?php

namespace core\utils\raklib;

use pmmp\encoding\ByteBufferWriter;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;

class KickMessageOverridePacket
{

  public const ID = 0x0b;

  public function __construct(
    private string $key,
    private string $msg,
  )
  {
  }

  public function encode(ByteBufferWriter $writer): void
  {
    CommonTypes::putString($writer, $this->key);
    CommonTypes::putString($writer, $this->msg);
  }

}
