<?php

declare(strict_types=1);

namespace core\commands\debugCommands;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use core\utils\ArrayEnumArgument; // If you don't have this, create your own argument class similar to your 'GivePet' example
use DateTime;
use pocketmine\command\CommandSender;
use pocketmine\math\Vector3;
use pocketmine\utils\TextFormat;

/**
 * A debug command that lets you store various positions for a scrim map
 * (e.g. spawn points, bed points, generator points, etc.) and save them to JSON.
 *
 * Usage:
 *   /scrimbo blueSpawnPoints  => Add your current position to the "blueSpawnPoints" array
 *   /scrimbo redBedPoint      => Overwrite the "redBedPoint" position with your current location
 *   /scrimbo save             => Save all stored data to a JSON file
 *   /scrimbo clear            => Clear all stored data to defaults
 */
class ScrimboCommand extends BaseCommand
{
  private SwimCore $core;

  /**
   * Define all possible fields, plus the special "save" & "clear".
   *
   * - If the field maps to an array in $scrimFields, we'll ADD a new position.
   * - If the field maps to a single slot (null), we'll SET/overwrite that position.
   * - "save" => write the entire data to JSON.
   * - "clear" => reset all data to default.
   */
  private array $possibleFields = [
    "blueSpawnPoints",
    "redSpawnPoints",
    "goldPoints",
    "diamondPoints",
    "emeraldPoints",
    "shopPoints",
    "blueBedPoint",
    "redBedPoint",
    "blueUpgradePoint",
    "redUpgradePoint",
    "save",
    "clear",
  ];

  /**
   * These are the default data structures.
   * Arrays for multi-add fields, null for single-set fields.
   */
  private array $scrimFields = [
    // Arrays
    "blueSpawnPoints"  => [],
    "redSpawnPoints"   => [],
    "goldPoints"       => [],
    "diamondPoints"    => [],
    "emeraldPoints"    => [],
    "shopPoints"       => [],

    // Singles
    "blueBedPoint"     => null,
    "redBedPoint"      => null,
    "blueUpgradePoint" => null,
    "redUpgradePoint"  => null
  ];

  public function __construct(SwimCore $core)
  {
    parent::__construct($core, "scrimbo", "Debug command: Save map positions to JSON");
    $this->setPermission("use.staff");
    $this->core = $core;
  }

  /**
   * We register just one argument: "field".
   * The field can be "blueSpawnPoints", "redBedPoint", "save", "clear", etc.
   *
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(
      0,
      new ArrayEnumArgument("field", $this->possibleFields)
    );
  }

  /**
   * Main command logic.
   *
   * Examples:
   * /scrimbo blueSpawnPoints -> Adds a position to the "blueSpawnPoints" array
   * /scrimbo redBedPoint     -> Sets the "redBedPoint" single-position
   * /scrimbo save            -> Saves all data to JSON
   * /scrimbo clear           -> Clears all data
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if (!$sender instanceof SwimPlayer) {
      $sender->sendMessage(TextFormat::RED . "This command can only be used in-game.");
      return;
    }

    // They must have typed a valid field from $possibleFields.
    $field = $args["field"] ?? null;
    if ($field === null) {
      $sender->sendMessage(TextFormat::RED . "Usage: /scrimbo <field|save|clear>");
      return;
    }

    // Load existing data or initialize with defaults
    $data = $sender->getAttributes()->getAttribute("scrimboData") ?? $this->scrimFields;

    // Special cases: "save" or "clear"
    if ($field === "save") {
      $this->saveData($sender, $data);
      return;
    }
    if ($field === "clear") {
      $data = $this->scrimFields; // reset to defaults
      $sender->getAttributes()->setAttribute("scrimboData", $data);
      $sender->sendMessage(TextFormat::YELLOW . "Scrimbo data has been cleared!");
      return;
    }

    // Otherwise, we add or set a position depending on if the field is array or single
    if (!array_key_exists($field, $data)) {
      $sender->sendMessage(TextFormat::RED . "Unknown field: {$field}");
      return;
    }

    if (is_array($data[$field])) {
      // The field is an array => "add" behavior
      $this->addPosition($sender, $data, $field);
    } else {
      // The field is a single => "set" behavior
      $this->setPosition($sender, $data, $field);
    }

    // Store the updated data
    $sender->getAttributes()->setAttribute("scrimboData", $data);
  }

  /**
   * Adds the player's current (floor) position to an array field.
   */
  private function addPosition(SwimPlayer $player, array &$data, string $field): void
  {
    $pos = $player->getPosition()->floor();
    $vector = [
      "x" => $pos->getX(),
      "y" => $pos->getY(),
      "z" => $pos->getZ()
    ];

    $data[$field][] = $vector;

    $count = count($data[$field]);
    $player->sendMessage(
      TextFormat::GREEN .
      "Appended position (#{$count}) to {$field} => ({$vector['x']}, {$vector['y']}, {$vector['z']})"
    );
  }

  /**
   * Sets the player's current (floor) position in a single field.
   */
  private function setPosition(SwimPlayer $player, array &$data, string $field): void
  {
    $pos = $player->getPosition()->floor();
    $vector = [
      "x" => $pos->getX(),
      "y" => $pos->getY(),
      "z" => $pos->getZ()
    ];

    $data[$field] = $vector;
    $player->sendMessage(
      TextFormat::GREEN .
      "Set {$field} => ({$vector['x']}, {$vector['y']}, {$vector['z']})"
    );
  }

  /**
   * Saves the data to a JSON file in the plugin's data folder.
   */
  private function saveData(SwimPlayer $player, array $data): void
  {
    $dateTime = new DateTime();
    $timestamp = $dateTime->format('m_d_Y_H_i');

    $pluginDataFolder = rtrim($this->core->getDataFolder(), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
    $filename = "scrimbo_{$timestamp}.json";
    $filePath = $pluginDataFolder . $filename;

    // Wrap the data in the "stub" as requested:
    $output = [
      "stub" => $data
    ];

    $json = json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    file_put_contents($filePath, $json);

    $player->sendMessage(
      TextFormat::GOLD . "Scrimbo data saved to file: {$filePath}"
    );
  }

  public function getPermission(): ?string
  {
    return "use.op";
  }

}
