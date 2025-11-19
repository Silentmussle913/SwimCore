<?php

namespace core\commands\debugCommands;

use core\scenes\duel\Duel;
use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\permission\DefaultPermissions;
use pocketmine\utils\TextFormat;

class CrashServerCommand extends Command
{

    private SwimCore $core;

    public function __construct(SwimCore $core)
    {
        parent::__construct("crashserver", "Force crash server");
        $this->core = $core;
        $this->setPermission("use.op");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args): bool
    {
        throw new \ErrorException(message: "/crashserver executed");
    }

}