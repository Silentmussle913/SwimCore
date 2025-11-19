<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\systems\scene\SceneSystem;
use CortexPE\Commando\args\FloatArgument;
use CortexPE\Commando\args\TextArgument;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use jackmd\scorefactory\ScoreFactoryException;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use pocketmine\world\Position;

class WorldTP extends BaseCommand
{

  private SwimCore $core;
  private SceneSystem $sceneSystem;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "worldtp", "tp to a world");
    $this->setPermission("use.op");
    $this->core = $core;
    $this->sceneSystem = $this->core->getSystemManager()->getSceneSystem();
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new FloatArgument("x", false));
    $this->registerArgument(1, new FloatArgument("y", false));
    $this->registerArgument(2, new FloatArgument("z", false));
    $this->registerArgument(3, new TextArgument("world", false));
  }

  /**
   * @inheritDoc
   * @throws ScoreFactoryException
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank == Rank::OWNER_RANK) {
        $world = $args["world"];
        $x = $args["x"];
        $y = $args["y"];
        $z = $args["z"];
        $wm = $this->core->getServer()->getWorldManager();
        $w = $wm->getWorldByName($world);
        if ($w === null) {
          $loaded = $wm->loadworld($world);
          if (!$loaded) {
            $sender->sendMessage(TextFormat::RED . "World not found!");
            return;
          } else {
            $w = $wm->getWorldByName($world);
          }
        }

        if ($w === null) {
          $sender->sendMessage(TextFormat::RED . "Yea man idk");
          return;
        }

        // we should put them in god mode and move them here
        if ($sender->getSceneHelper()?->getScene()->getSceneName() !== 'GodMode') {
          $this->sceneSystem->setScene($sender, $this->sceneSystem->getScene('GodMode'));
        }

        $sender->teleport(new Position($x, $y, $z, $w));
      }
    } else {
      $sender->sendMessage(TextFormat::RED . "You can't use this command!");
    }
  }

  public function getPermission(): string
  {
    return "use.op";
  }

}
