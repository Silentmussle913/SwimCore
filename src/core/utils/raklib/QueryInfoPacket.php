<?php

namespace core\utils\raklib;

use pmmp\encoding\ByteBufferWriter;
use pmmp\encoding\LE;
use pmmp\encoding\VarInt;
use pocketmine\network\mcpe\protocol\serializer\CommonTypes;
use function count;

class QueryInfoPacket
{

  public const ID = 0x0a;

  public function __construct(
    private string $hostName,
    private string $gameType,
    private string $version,
    private string $serverEngine,
    private string $plugins,
    private string $map,
    private int    $numPlayers,
    private int    $maxPlayers,
    private bool   $whiteList,
    private string $hostIp,
    private int    $hostPort,
    private array  $extraData,
    private array  $players,
  )
  {
  }

  public function encode(ByteBufferWriter $writer): void
  {
    CommonTypes::putString($writer, $this->hostName);
    CommonTypes::putString($writer, $this->gameType);
    CommonTypes::putString($writer, $this->version);
    CommonTypes::putString($writer, $this->serverEngine);
    CommonTypes::putString($writer, $this->plugins);
    CommonTypes::putString($writer, $this->map);
    VarInt::writeUnsignedInt($writer, $this->numPlayers);
    VarInt::writeUnsignedInt($writer, $this->maxPlayers);
    CommonTypes::putBool($writer, $this->whiteList);
    CommonTypes::putString($writer, $this->hostIp);
    LE::writeUnsignedShort($writer, $this->hostPort);
    VarInt::writeUnsignedInt($writer, count($this->extraData));
    foreach ($this->extraData as $key => $value) {
      CommonTypes::putString($writer, $key);
      CommonTypes::putString($writer, $value);
    }
    VarInt::writeUnsignedInt($writer, count($this->players));
    foreach ($this->players as $player) {
      CommonTypes::putString($writer, $player);
    }
  }

}