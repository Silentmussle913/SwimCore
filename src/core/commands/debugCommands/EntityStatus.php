<?php

namespace core\commands\debugCommands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;
use ReflectionClass;

class EntityStatus extends Command
{

  public function __construct()
  {
    parent::__construct("estatus", "get entity status of worlds");
    $this->setPermission("use.op");
  }

  /**
   * @inheritDoc
   */
  public function execute(CommandSender $sender, string $commandLabel, array $args): void
  {
    $server = $sender->getServer();
    $skippedWorlds = [];

    foreach ($server->getWorldManager()->getWorlds() as $world) {
      $loadedChunks = count($world->getLoadedChunks());
      $tickingChunks = count($world->getTickingChunks());
      $entities = count($world->getEntities());

      // Skip worlds with no activity
      if ($loadedChunks === 0 && $tickingChunks === 0 && $entities === 0) {
        $skippedWorlds[] = $world->getFolderName();
        continue;
      }

      // Count entities by short class name
      $counts = [];
      foreach ($world->getEntities() as $entity) {
        // if ($entity instanceof Player) { continue; } // optional

        $short = (new ReflectionClass($entity))->getShortName();
        $counts[$short] = ($counts[$short] ?? 0) + 1;
      }

      // Build entity breakdown string
      $entityBreakdown = TextFormat::GRAY . "None";
      if (!empty($counts)) {
        uasort($counts, static function (int $a, int $b) {
          return $b <=> $a;
        });

        $lines = [];
        foreach ($counts as $name => $count) {
          $lines[] = TextFormat::AQUA . $name . TextFormat::GRAY . ": " . TextFormat::YELLOW . number_format($count);
        }

        $entityBreakdown = implode(TextFormat::RESET . "\n", $lines);
      }

      $worldName = $world->getFolderName() !== $world->getDisplayName()
        ? " (" . $world->getDisplayName() . ")" : "";

      $timeColor = $world->getTickRateTime() > 40 ? TextFormat::RED : TextFormat::YELLOW;

      // Send as one message appended to the world stats line
      $sender->sendMessage(
        TextFormat::GOLD . "World \"{$world->getFolderName()}\"$worldName: " .
        TextFormat::RED . number_format($loadedChunks) . TextFormat::GREEN . " loaded chunks, " .
        TextFormat::RED . number_format($tickingChunks) . TextFormat::GREEN . " ticking chunks, " .
        TextFormat::RED . number_format($entities) . TextFormat::GREEN . " entities. " .
        "Time $timeColor" . round($world->getTickRateTime(), 2) . "ms" . TextFormat::RESET . "\n" .
        TextFormat::GOLD . "Entities by type:\n" . $entityBreakdown . TextFormat::RESET
      );
    }

    // At the end, show skipped worlds
    if (!empty($skippedWorlds)) {
      $sender->sendMessage(
        TextFormat::DARK_GRAY . "Inactive: " . TextFormat::GRAY . implode(", ", $skippedWorlds)
      );
    }
  }


}
