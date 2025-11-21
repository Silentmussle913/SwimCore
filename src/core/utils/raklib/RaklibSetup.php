<?php

namespace core\utils\raklib;

use core\SwimCore;
use core\SwimCoreInstance;
use core\utils\security\ParseIP;
use pocketmine\event\EventPriority;
use pocketmine\event\Listener;
use pocketmine\event\server\NetworkInterfaceRegisterEvent;
use pocketmine\event\server\QueryRegenerateEvent;
use pocketmine\network\mcpe\convert\TypeConverter;
use pocketmine\network\mcpe\PacketBroadcaster;
use pocketmine\network\mcpe\protocol\ProtocolInfo;
use pocketmine\network\mcpe\raklib\RakLibInterface;
use pocketmine\network\mcpe\StandardEntityEventBroadcaster;
use pocketmine\network\mcpe\StandardPacketBroadcaster;
use pocketmine\network\query\DedicatedQueryNetworkInterface;
use pocketmine\player\GameMode;
use pocketmine\utils\TextFormat;
use ReflectionException;

use function count;
use function file_exists;
use function get_class;
use function method_exists;
use function str_contains;
use function str_replace;
use function substr;
use function trim;

class RaklibSetup implements Listener
{

  private TypeConverter $typeConverter;
  private PacketBroadcaster $packetBroadcaster;
  private StandardEntityEventBroadcaster $entityEventBroadcaster;

  /** @param string[] $addresses
   * @throws ReflectionException
   */
  public function __construct(private SwimCore $core, array $addresses, string $rakRouterSocketPath)
  {
    $this->typeConverter = TypeConverter::getInstance();

    $this->packetBroadcaster = new StandardPacketBroadcaster
    (
      $core->getServer(),
      method_exists(TypeConverter::class, "getProtocolId") ?
        $this->typeConverter->getProtocolId() : ProtocolInfo::CURRENT_PROTOCOL
    );

    $this->entityEventBroadcaster = new StandardEntityEventBroadcaster($this->packetBroadcaster, $this->typeConverter);

    if ($rakRouterSocketPath !== "" && file_exists($rakRouterSocketPath)) {
      $interface = $this->registerRakRouter($rakRouterSocketPath);
      $this->core->getServer()->getPluginManager()->registerEvent(QueryRegenerateEvent::class, function (QueryRegenerateEvent $ev)
      use ($interface): void {
        $info = $ev->getQueryInfo();
        $server = $this->core->getServer();
        $plist = $server->getName() . " " . $server->getPocketMineVersion();
        if (count($info->getPlugins()) > 0 && $info->canListPlugins()) {
          $plist .= ":";
          foreach ($info->getPlugins() as $p) {
            $d = $p->getDescription();
            $plist .= " " . str_replace([";", ":", " "], ["", "", "_"], $d->getName()) . " "
              . str_replace([";", ":", " "], ["", "", "_"], $d->getVersion()) . ";";
          }
          $plist = substr($plist, 0, -1);
        }
        $pk = new QueryInfoPacket(
          $server->getMotd(),
          ($server->getGamemode() === GameMode::SURVIVAL || $server->getGamemode() === GameMode::ADVENTURE) ? "SMP" : "CMP",
          $server->getVersion(),
          $server->getName() . " " . $server->getPocketMineVersion(),
          $plist, $info->getWorld(),
          $info->getPlayerCount(),
          $info->getMaxPlayerCount(),
          $server->hasWhitelist(),
          $server->getIp(),
          $server->getPort(),
          $info->getExtraData(),
          $info->getPlayerList()
        );
        $interface->queryData($pk);
      }, EventPriority::MONITOR, $core, false);
    } else {
      foreach ($addresses as $address) {
        $ipAndPort = ParseIP::sepIpFromPortWithv6Bracketed($address);
        if ($ipAndPort) {
          [$ip, $port] = $ipAndPort;
        }
        $this->registerInterface($ip ?? $address, $port ?? 19132);
      }
    }
    $core->getServer()->getPluginManager()->registerEvents($this, $core);
  }

  public function onInterfaceRegister(NetworkInterfaceRegisterEvent $event): void
  {
    $interface = $event->getInterface();
    if (!$interface instanceof SwimRakLibInterface &&
      ($interface instanceof RakLibInterface || $interface instanceof DedicatedQueryNetworkInterface)) {
      $event->cancel();
      $this->core->getLogger()->info("Prevented " . get_class($event->getInterface()) . " from being registered");
    }
  }

  private function getMOTDS(): array
  {
    $motds = SwimCoreInstance::getInstance()->getSwimConfig()->motds;

    if (empty($motds)) {
      $motds[] = TextFormat::AQUA . "SwimCore";
    }

    return $motds;
  }

  public function registerInterface(string $ip, int $port): void
  {
    $ip = trim($ip, "[]");
    $v6 = str_contains($ip, ":");
    $prettyIp = $v6 ? "[" . $ip . "]" : $ip;

    $interface = new SwimRakLibInterface(
      $this->core->getServer(),
      $ip,
      $port,
      $v6,
      $this->packetBroadcaster,
      $this->entityEventBroadcaster,
      $this->typeConverter,
      $this->getMOTDS()
    );

    $this->core->getServer()->getNetwork()->registerInterface($interface);
    $this->core->getLogger()->info("Registered SwimRakLibInterface on " . $prettyIp . ":" . $port);
  }

  public function registerRakRouter(string $path): SwimRakLibInterface
  {
    $interface = new SwimRakLibInterface(
      $this->core->getServer(),
      $path,
      0,
      false,
      $this->packetBroadcaster,
      $this->entityEventBroadcaster,
      $this->typeConverter,
      $this->getMOTDS()
    );

    $this->core->getServer()->getNetwork()->registerInterface($interface);
    $this->core->getLogger()->info("Registered SwimRakLibInterface (RakRouter), path: $path");

    return $interface;
  }

}