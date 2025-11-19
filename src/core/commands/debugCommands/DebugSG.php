<?php

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\BaseCommand;
use DateTime;
use pocketmine\block\Block;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\Chest;
use pocketmine\block\EnderChest;
use pocketmine\block\VanillaBlocks;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\player\Player;
use pocketmine\scheduler\Task;
use pocketmine\utils\TextFormat;
use pocketmine\world\World;

class DebugSG extends BaseCommand
{

  private SwimCore $core;

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "debugsg", "prepare an sg map for development (gets all chest positions and error blocks and fixes + logs them)");
    $this->setPermission("use.staff");
    $this->core = $core;
  }

  protected function prepare(): void
  {
  }

  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {
      $rank = $sender->getRank()->getRankLevel();
      if ($rank == Rank::OWNER_RANK) {
        $this->debugSG($sender);
      } else {
        $sender->sendMessage(TextFormat::RED . "You can not use this");
      }
    }
  }

  /*
    iterates all blocks within the min max position and saves the following positions with names of the blocks to a json file
    We should probably try multithreading and doing this by chunks
  */
  private function debugSG(SwimPlayer $swimPlayer): void
  {
    $attributes = $swimPlayer->getAttributes();
    if (!$attributes->hasAttribute("pos 1") || !$attributes->hasAttribute("pos 2")) {
      $swimPlayer->sendMessage(TextFormat::RED . "You first need to set the 1 and 2 positions with /pos <num>");
      return;
    }

    $world = $swimPlayer->getWorld();
    $pos1 = $attributes->getAttribute("pos 1");
    $pos2 = $attributes->getAttribute("pos 2");

    $minX = (int)min($pos1->x, $pos2->x);
    $maxX = (int)max($pos1->x, $pos2->x);
    $minY = (int)min($pos1->y, $pos2->y);
    $maxY = (int)max($pos1->y, $pos2->y);
    $minZ = (int)min($pos1->z, $pos2->z);
    $maxZ = (int)max($pos1->z, $pos2->z);

    $blocksWeCareAboutSet = [
      BlockTypeIds::CHEST => true,
      BlockTypeIds::ENDER_CHEST => true,
      BlockTypeIds::TRAPPED_CHEST => true,
      BlockTypeIds::INFO_UPDATE => true,
      BlockTypeIds::INFO_UPDATE2 => true
    ];

    $foundBlocks = [];
    $count = 0;
    for ($x = $minX; $x <= $maxX; ++$x) {
      for ($y = $minY; $y <= $maxY; ++$y) {
        for ($z = $minZ; $z <= $maxZ; ++$z) {
          $block = $world->getBlockAt($x, $y, $z);
          $id = $block->getTypeId();
          if (isset($blocksWeCareAboutSet[$id])) {
            $foundBlocks[] = [
              'name' => $block->getName(),
              'type_id' => $id,
              'x' => $x,
              'y' => $y,
              'z' => $z
            ];
            $count++;
            echo $count . " | " . $block->getName() . ": " . $x . ", " . $y . ", " . $z . "\n";
            // place in physically to fix the chest since converting files broke the chest nbt, and it is stuck from opening
            $newBlock = VanillaBlocks::CHEST();
            if ($block instanceof Chest || $block instanceof EnderChest) {
              $newBlock->setFacing($block->getFacing());
            }
            $world->setBlockAt($x, $y, $z, $newBlock);
          }
        }
      }
    }

    // Writing to JSON file
    $this->writeToJson($foundBlocks);
    $swimPlayer->sendMessage("Debug information saved and finished processing.");
  }

  private function writeToJson(array $foundBlocks): void
  {
    $sortedBlocks = [];
    foreach ($foundBlocks as $block) {
      $key = $block['name'] . ", " . $block['type_id'];
      $sortedBlocks[$key][] = "{$block['x']} {$block['y']} {$block['z']}";
    }

    $dateTime = new DateTime();
    $formattedFileName = $dateTime->format('m_d_Y_H_i'); // Format date for the filename

    $json = json_encode($sortedBlocks, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

    // Getting the data folder from the core plugin
    $pluginDataFolder = $this->core->getDataFolder();
    // Ensure the directory path ends with a trailing slash
    $pluginDataFolder = rtrim($pluginDataFolder, '/') . '/';

    // Constructing the filename with date and time
    $filename = "sg_debug_" . $formattedFileName . ".json";

    // Writing the JSON to a file in the plugin's data folder
    $filePath = $pluginDataFolder . $filename;
    file_put_contents($filePath, $json);

    // Inform the user where the file was saved (optional)
    echo "Debug information saved to: $filePath";
  }

  private function replace(SwimPlayer $swimPlayer, World $world, Block $block, int $x, int $y, int $z): void
  {
    $vecBlock = new Vector3($x, $y, $z);
    $world->setBlock($vecBlock, VanillaBlocks::AIR());

    // not sure why this needs to be a delayed task, and why it can't just be instant
    $this->core->getScheduler()->scheduleDelayedTask(new class($swimPlayer, $vecBlock, $block) extends Task {

      private Player $player;
      private Vector3 $vecBlock;
      private Block $block;

      public function __construct(Player $player, Vector3 $vecBlock, Block $block)
      {
        $this->player = $player;
        $this->vecBlock = $vecBlock;
        $this->block = $block;
      }

      public function onRun(): void
      {
        $this->player->getWorld()->setBlock($this->vecBlock, VanillaBlocks::CHEST()->setFacing($this->block->getFacing()));
      }

    }, 20);
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }

}