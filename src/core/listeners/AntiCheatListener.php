<?php

namespace core\listeners;

use core\SwimCore;
use core\systems\player\components\ClickHandler;
use core\systems\player\SwimPlayer;
use core\utils\AcData;
use core\utils\SteveSkin;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\network\mcpe\PacketRateLimiter;
use pocketmine\network\mcpe\protocol\ClientCacheStatusPacket;
use pocketmine\network\mcpe\protocol\InventoryTransactionPacket;
use pocketmine\network\mcpe\protocol\LevelSoundEventPacket;
use pocketmine\network\mcpe\protocol\PlayerAuthInputPacket;
use pocketmine\network\mcpe\protocol\types\inventory\UseItemOnEntityTransactionData;
use pocketmine\network\mcpe\protocol\types\LevelSoundEvent;
use pocketmine\network\mcpe\protocol\types\PlayerAuthInputFlags;
use pocketmine\network\PacketHandlingException;
use pocketmine\utils\TextFormat as TF;
use ReflectionClass;
use ReflectionException;

class AntiCheatListener implements Listener
{

  private SwimCore $core;
  private SteveSkin $steveSkin;

  private static string $spacer = TF::GRAY . " | " . TF::RED;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
    $this->steveSkin = new SteveSkin();
  }

  public function onDeath(PlayerDeathEvent $event)
  {
    /** @var SwimPlayer $player */
    $player = $event->getPlayer();
    $player->getAntiCheatData()?->unsetData(AcData::LAST_CLIENT_TICK);
  }


  /**
   * @throws ReflectionException
   */
  public function onLogin(PlayerLoginEvent $event)
  {
    // $process = new LoginProcessor($this->core, $event);
    // if (!$process->run()) return;

    // then do quick skin check
    $player = $event->getPlayer();

    // update game packet limit for the player
    (new ReflectionClass(NetworkSession::class))->getProperty("gamePacketLimiter")->setValue($player->getNetworkSession(),
      new PacketRateLimiter("Game Packets", 12, 100));
  }

  /**
   * @priority LOWEST
   * @brief main heart beat listener for anti cheat, also includes some specific packet actions we can check that aren't worth a full on detection.
   *        An example of these small detections is the illegal item consuming check.
   */
  public function onPacketReceive(DataPacketReceiveEvent $event)
  {
    // $this->enableBlobCacheOnClient($event);

    /* @var SwimPlayer $player */
    $player = $event->getOrigin()->getPlayer();
    if (!isset($player)) return;

    // get anti cheat data
    $data = $player->getAntiCheatData();
    if (!isset($data)) return;

    $this->processSwing($event, $player); // when player swings there fist (left click)
    // $this->checkGopherTunnel($event, $player); // check if player is doing stuff on the chunks that gopher tunnel would try
    $this->handleInput($event, $player); // update player info based on input
    // $this->processNSL($event, $player); // update the network stack latency component for the player
    $this->updateExactPosition($event, $player); // update their exact position if we can because use item returns more precisely from the client

    // make the packet get handled by all the anti cheat components
    $data->handle($event);
  }

  /**
   * @throws ReflectionException
   * @deprecated Not used anymore due to PocketMine being refactored, chunks are cached client side now automatically
   */
  private function enableBlobCacheOnClient(DataPacketReceiveEvent $event): void
  {
    $packet = $event->getPacket();
    /** @var ClientCacheStatusPacket $packet */
    if ($packet->pid() == ClientCacheStatusPacket::NETWORK_ID) {
      if ($packet->isEnabled()) {
        (new ReflectionClass(NetworkSession::class))->getProperty("chunkCacheEnabled")->setValue($event->getOrigin(), true);
      }
      $event->cancel();
    }
  }

  private function updateExactPosition(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void
  {
    $packet = $event->getPacket();
    if ($packet instanceof InventoryTransactionPacket && $packet->trData instanceof UseItemOnEntityTransactionData && $packet->trData->getActionType() == 1) {
      $swimPlayer->setExactPosition($packet->trData->getPlayerPosition());
    }
  }

  private function handleInput(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void
  {
    $packet = $event->getPacket();
    if ($packet->pid() != PlayerAuthInputPacket::NETWORK_ID) return;

    /** @var PlayerAuthInputPacket $packet */

    $data = $swimPlayer->getAntiCheatData();

    // movement for anti cheat
    $data->playerAuthInput($packet);
    //$this->handleSuperSmoothMovement($packet, $swimPlayer);
    $swimPlayer->setExactPosition($packet->getPosition()->subtract(0, 1.62, 0)); // I don't know the point of this, seems bad

    // auto sprint
    $settings = $swimPlayer->getSettings();
    if ($settings) {
      if ($settings->isAutoSprint()) {
        if ($packet->getMoveVecZ() > 0.5) {
          $swimPlayer->setSprinting();
        } else {
          $swimPlayer->setSprinting(false);
        }
      }
    }

    // update tick time
    if ($data->getData(AcData::LAST_CLIENT_TICK) && $data->getData(AcData::LAST_CLIENT_TICK) != $packet->getTick() - 1) {
      throw new PacketHandlingException("Invalid tick");
    }
    $data->setData(AcData::LAST_CLIENT_TICK, $packet->getTick());

    // update jump time if needed
    if ($packet->getInputFlags()->get(PlayerAuthInputFlags::START_JUMPING)) {
      $data->setData(AcData::LAST_JUMP_TIME, microtime(true));
    }

    // set the detected input mode (mouse, controller, touch, etc)
    $data->setData(AcData::INPUT_MODE, $packet->getInputMode());
  }

  /*
  private function processNSL(DataPacketReceiveEvent $event, SwimPlayer $player): void
  {
    $pk = $event->getPacket();
    if ($pk instanceof NetworkStackLatencyPacket) {
      if (!$player->getAckHandler()->receive($pk)) $player->getNslHandler()->onNsl($pk); // if receive returns false then call onNsl
    }
  }
  */

  private int $threshold = 45; // in MS, this is supposed to 50 but that cancels way too much CPS

  private function processSwing(DataPacketReceiveEvent $event, SwimPlayer $swimPlayer): void
  {
    $packet = $event->getPacket();
    $swung = false;

    if ($packet instanceof PlayerAuthInputPacket) {
      // $swung = (($packet->getInputFlags() & (1 << PlayerAuthInputFlags::MISSED_SWING)) !== 0);
      // 1.21.50: Instead of performing a bitwise & on a BitSet, call get() with the index
      $swung = $packet->getInputFlags()->get(PlayerAuthInputFlags::MISSED_SWING);
    }

    if ($packet instanceof LevelSoundEventPacket) {
      $swung = $packet->sound == LevelSoundEvent::ATTACK_NODAMAGE;
    }

    if ($swung || ($packet instanceof InventoryTransactionPacket && $packet->trData instanceof UseItemOnEntityTransactionData)) {
      $ch = $swimPlayer->getClickHandler();
      if ($ch) {

        $isRanked = $swimPlayer->getSceneHelper()?->getScene()->isRanked() ?? false;

        // dc prevent logic if enabled or in a ranked scene
        $settings = $swimPlayer->getSettings();
        if ($isRanked || ($settings?->dcPreventOn())) {
          if (((microtime(true) * 1000) - ($swimPlayer->getAntiCheatData()->getData(AcData::LAST_CLICK_TIME) ?? 0)) < $this->threshold) {
            $event->cancel(); // block the swing
          } else {
            $swimPlayer->getAntiCheatData()->setData(AcData::LAST_CLICK_TIME, microtime(true) * 1000);
          }
        }

        // if dc prevent didn't cancel the click then we can call it
        if (!$event->isCancelled()) {
          $ch->click();
        }

        // only does this notification in ranked marked scenes
        if ($isRanked && $ch->getCPS() > ClickHandler::CPS_MAX) {
          $msg = TF::RED . "Clicked above " . TF::YELLOW . ClickHandler::CPS_MAX . TF::RED . " CPS" . self::$spacer . TF::YELLOW . "Attacks will deal Less KB";
          $swimPlayer->sendActionBarMessage($msg);
        }
      }
    }
  }

}