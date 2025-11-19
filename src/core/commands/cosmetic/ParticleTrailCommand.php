<?php

namespace core\commands\cosmetic;

use core\SwimCore;
use core\systems\player\components\Rank;
use core\systems\player\SwimPlayer;
use core\utils\ArrayEnumArgument;
use core\utils\particles\ParticleTrails;
use CortexPE\Commando\BaseCommand;
use CortexPE\Commando\exception\ArgumentOrderException;
use jojoe77777\FormAPI\CustomForm;
use pocketmine\command\CommandSender;
use pocketmine\utils\TextFormat;

class ParticleTrailCommand extends BaseCommand
{

  private SwimCore $swimCore;

  public function __construct(SwimCore $swimCore)
  {
    $this->swimCore = $swimCore;
    $this->setPermission("use.all");
    $this->setUsage("if you wish to reset your particle trail, simply only run /particletrail with no arguments afterwards");
    parent::__construct($swimCore, "particletrail", "Set particle trail (VIP Rank+) | Run only /particletrail with no arguments after to reset it");
  }

  /**
   * @inheritDoc
   * @throws ArgumentOrderException
   */
  protected function prepare(): void
  {
    $this->registerArgument(0, new ArrayEnumArgument("particletrail", ParticleTrails::PARTICLE_LIST, true));
  }

  /**
   * @inheritDoc
   */
  public function onRun(CommandSender $sender, string $aliasUsed, array $args): void
  {
    if ($sender instanceof SwimPlayer) {

      // hub check
      if (!$sender->isInScene("Hub")) {
        $sender->sendMessage(TextFormat::RED . "You must be in the hub to use this!");
        return;
      }

      $rank = $sender->getRank()->getRankLevel();
      if ($rank >= Rank::VIP) {
        // check if resetting by passing no arguments
        if (!isset($args["particletrail"])) {
          $sender->getCosmetics()->setHubParticleEffect("");
          $sender->sendMessage(TextFormat::GRAY . "particle trail reset to default");
          return;
        }

        $particleTrails = $args["particletrail"];
        self::handleParticleTrail($sender, $particleTrails);
      } else {
        $sender->sendMessage(TextFormat::YELLOW . "You need VIP or MVP Rank to use this: " . TextFormat::AQUA . "swim.tebex.io");
      }
    }
  }

  public static function particleTrailForm(SwimPlayer $SwimPlayer): void
  {
    $particleTrails = ParticleTrails::PARTICLE_LIST;
    $form = new CustomForm(function (SwimPlayer $player, $data) use ($particleTrails) {
      if ($data === null) return;

      if (!isset($data[0])) return;

      $message = $particleTrails[$data[0]] ?? "";
      self::handleParticleTrail($player, $message);
    });

    $form->setTitle("Set Particle Trail");
    $previous = $SwimPlayer->getCosmetics()->getHubParticleEffect();

    $options = array_map(function ($particle) {
      return str_replace("_", " ", ucfirst($particle));
    }, ParticleTrails::PARTICLE_LIST);

    $form->addDropdown("Particle", $options, array_search($previous, $particleTrails));
    $SwimPlayer->sendForm($form);
  }

  private static function handleParticleTrail(SwimPlayer $sender, string $particle): void
  {
    $sender->sendMessage(TextFormat::GRAY . "Set your particle trail to: " . $particle);
    if ($particle == "none") { // fix for setting hub particle effect
      $particle = "";
    }
    $sender->getCosmetics()->setHubParticleEffect($particle);
  }

  public function getPermission(): ?string
  {
    return "use.all";
  }

}