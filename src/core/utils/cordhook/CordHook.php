<?php

namespace core\utils\cordhook;

use core\communicator\packet\types\embed\Embed;
use core\communicator\packet\types\embed\Footer;
use core\SwimCoreInstance;

class CordHook
{

  // to keep track of when the last time we sent a message was
  public static int $lastMessageTime = 0;

  public static function sendEmbed(string $description, string $title, string $footer = "Made by Swim Services", int $color = 0x0000ff): void
  {
    self::$lastMessageTime = time();

    $core = SwimCoreInstance::getInstance();
    $embed = new Embed(title: $title, description: $description, color: $color);
    if ($footer !== "") {
      $embed->footer = new Footer($footer);
    }
    $core->getCommunicator()->sendEmbed($core->getCommunicator()->getDiscordInfo()->acChannel, $embed);
  }

}