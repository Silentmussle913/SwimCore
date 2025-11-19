<?php

namespace core\commands\debugCommands;

use core\custom\prefabs\bots\BotInventoryEditor;
use core\custom\prefabs\bots\BotPlayer;
use core\custom\prefabs\bots\SimpleCombat;
use core\custom\prefabs\bots\SimpleFollow;
use core\custom\prefabs\bots\SimpleMover;
use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use ReflectionException;

class CallBot extends Command
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct("callbot", "spawn a debug entity for testing");
    $this->core = $core;
    $this->setPermission("use.staff");
  }

  /**
   * @throws ReflectionException
   */
  public function execute(CommandSender $sender, string $commandLabel, array $args): bool
  {
    // Only SwimPlayer can run this
    if (!$sender instanceof SwimPlayer) {
      return true;
    }

    // Only owner rank permitted
    $rank = $sender->getRank()->getRankLevel();
    if ($rank !== Rank::OWNER_RANK) {
      return true;
    }

    // Scene is required
    $scene = $sender->getSceneHelper()?->getScene();
    if ($scene === null) {
      return true;
    }

    // Normalize args to lowercase strings
    $tokens = array_map(static fn($v) => strtolower((string)$v), $args);

    // Parse flags from args in ANY order
    $wantsFollow = in_array('follow', $tokens, true);
    $wantsCombat = in_array('combat', $tokens, true);
    $wantsEdit = in_array('edit', $tokens, true);

    // Spin up the bot + behavior manager
    $bot = new BotPlayer($sender->getLocation(), $scene);
    $eb = $bot->getEntityBehaviorManager();

    // Helper to add a behavior once (works even if hasBehavior() doesn't exist)
    $addOnce = static function (string $name, callable $factory) use ($eb): void {
      $already = $eb->hasBehavior($name);
      if (!$already) {
        $eb->addBehavior($factory(), $name);
      }
    };

    // FOLLOW: add mover + follow behaviors when requested
    if ($wantsFollow) {
      $addOnce('mover', fn() => new SimpleMover($bot, $scene));
      $addOnce('follow', fn() => new SimpleFollow($bot, $scene));
    }

    // COMBAT: add when requested
    if ($wantsCombat) {
      $addOnce('combat', function () use ($bot, $scene) {
        $combat = new SimpleCombat($bot, $scene);
        $combat->setBotPlayer($bot);
        return $combat;
      });
    }

    // EDIT: add when requested
    if ($wantsEdit) {
      $addOnce('editor', function () use ($bot, $scene) {
        $editor = new BotInventoryEditor($bot, $scene);
        $editor->setBotPlayer($bot);
        $editor->allowEditing(true);
        return $editor;
      });
    }

    $suffix = $args !== [] ? " with " . implode(", ", $args) : "";
    $sender->sendMessage(TextFormat::GREEN . "Calling bot{$suffix}");

    return true;
  }


}