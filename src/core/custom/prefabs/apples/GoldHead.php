<?php

namespace core\custom\prefabs\apples;

use core\scenes\PvP;
use core\systems\player\SwimPlayer;
use core\utils\InventoryUtil;
use pocketmine\block\Block;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\MobHead;
use pocketmine\block\utils\MobHeadType;
use pocketmine\entity\effect\EffectInstance;
use pocketmine\entity\effect\VanillaEffects;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerItemUseEvent;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\utils\TextFormat;
use pocketmine\world\BlockTransaction;
use pocketmine\world\sound\BurpSound;

class GoldHead extends MobHead
{

  public static string $name = TextFormat::RESET . TextFormat::MINECOIN_GOLD . "Golden Head";

  public function __construct
  (
    BlockIdentifier $idInfo = new BlockIdentifier(BlockTypeIds::MOB_HEAD),
    string          $name = "head",
    BlockTypeInfo   $typeInfo = new BlockTypeInfo(new BlockBreakInfo(0))
  )
  {
    parent::__construct($idInfo, $name, $typeInfo);
    $this->setMobHeadType(MobHeadType::CREEPER);
  }

  public function place(BlockTransaction $tx, Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, ?Player $player = null): bool
  {
    return false;
  }

}

// we have to do this scuffed JIT patterns for a block item listener
class GoldHeadListener implements Listener
{

  /**
   * @priority LOWEST
   */
  function onUse(PlayerItemUseEvent $event): void
  {
    if ($event->isCancelled()) return;

    $item = $event->getItem();
    /** @var SwimPlayer $player */
    $player = $event->getPlayer();

    if (!($player->getSceneHelper()?->getScene() instanceof PvP)) {
      $event->cancel();
      return;
    }

    if (($item->getTypeId() == -BlockTypeIds::MOB_HEAD) && ($item->getCustomName() === GoldHead::$name)) {
      // if on cool down then don't do throwing tnt logic
      if ($player->getCoolDowns()->onCoolDown($item)) {
        return;
      }

      // trigger cool down
      $player->getCoolDowns()->triggerItemCoolDownEvent($event, $player->getInventory()->getItemInHand(), 1, true, false);

      // if the item cool down did not cancel the event (meaning we aren't on cool down) then do effects:
      $player->getEffects()->add(new EffectInstance(VanillaEffects::ABSORPTION(), 120 * 20, 0));
      $player->getEffects()->add(new EffectInstance(VanillaEffects::REGENERATION(), 5 * 20, 2));
      $player->getEffects()->add(new EffectInstance(VanillaEffects::SPEED(), 10 * 20, 0));

      $player->broadcastSound(new BurpSound());
      InventoryUTil::forceItemPop($player, $item);
    }
  }

}

// exists to cause the construct to happen, only constructed once
static $throwable = new UsableBlock();

class UsableBlock
{

  private ?Plugin $swimCore;
  private static bool $constructed = false;

  public function __construct()
  {
    if (self::$constructed) {
      echo "\nAlready Constructed Gold Head Listener\n"; // don't think this ever happens anyway
      return;
    }

    echo "\nConstructing Gold Head Listener\n";
    $server = Server::getInstance();
    $pluginManager = $server->getPluginManager();
    $this->swimCore = $pluginManager->getPlugin("swim");
    if ($this->swimCore) {
      $pluginManager->registerEvents(new GoldHeadListener(), $this->swimCore);
      self::$constructed = true;
    } else {
      echo "\nHorrible error | SwimCore plugin not found when making gold head listener\n";
    }
  }

}