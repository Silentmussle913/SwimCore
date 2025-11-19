<?php

namespace core\systems\scene\replay;

use core\SwimCore;
use core\systems\player\SwimPlayer;
use pocketmine\block\Block;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\math\Vector3;

class SceneRecorder
{

  private bool $isRecording = false;

  // the idea is on startRecording being called, we set this and start writing to it, and then on stopRecording, we save it and nullify this
  private ?SceneReplay $activeReplayRecording = null;

  public function startRecording(string $name, string $modeName, string $mapName, string $worldName, Vector3 $origin): void
  {
    if ($this->isRecording) {
      echo "You are already recording this scene!\n"; // TODO: this is very important handling to need to care about for FFA clipping for anti cheat replays
      return;
    }

    echo "Starting scene recording $name \n";
    $this->isRecording = true;
    $this->activeReplayRecording = new SceneReplay($name, $modeName, $mapName, $worldName, $origin);
  }

  public function stopRecording(): void
  {
    if (!$this->isRecording) {
      echo "This scene is not currently being recorded!\n";
      return;
    }

    $this->isRecording = false;
    $this->activeReplayRecording?->save();
    $this->activeReplayRecording = null; // is now null, save() should serialize this to the database as a blob
  }

  public function onReceive(DataPacketReceiveEvent $event, SwimPlayer $player): void
  {
    $this->internalGet()?->onReceive($event, $player);
  }

  public function onBlockAdd(Block $block, Vector3 $pos): void
  {
    $this->internalGet()?->onBlockAdd($block, $pos);
  }

  public function onBlockRemove(Block $block, Vector3 $pos): void
  {
    $this->internalGet()?->onBlockRemove($block, $pos);
  }

  public function addChunkLoader(Vector3 $position): void
  {
    $this->internalGet()?->addChunkLoader($position);
  }

  private function internalGet(): ?SceneReplay
  {
    if ($this->isRecording) {
      if ($this->activeReplayRecording) {
        return $this->activeReplayRecording;
      } else {
        if (SwimCore::$DEBUG) echo "Recording has not properly been started yet!\n";
      }
    } else {
      if (SwimCore::$DEBUG) echo "This scene is not currently being recorded!\n";
    }

    return null;
  }

  public function isRecording(): bool
  {
    return $this->isRecording;
  }

}
