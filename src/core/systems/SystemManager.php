<?php

namespace core\systems;

use core\SwimCore;
use core\systems\entity\EntitySystem;
use core\systems\event\EventSystem;
use core\systems\map\MapsData;
use core\systems\party\PartiesSystem;
use core\systems\player\PlayerSystem;
use core\systems\player\SwimPlayer;
use core\systems\scene\SceneSystem;
use ReflectionException;

class SystemManager
{

  private array $systems;
  private SwimCore $core;

  private PlayerSystem $playerSystem;
  private SceneSystem $sceneSystem;
  private PartiesSystem $partySystem;
  private MapsData $mapsData;
  private EventSystem $eventSystem;
  private EntitySystem $entitySystem;

  public function __construct(SwimCore $core)
  {
    $this->core = $core;
  }

  public function getPlayerSystem(): PlayerSystem
  {
    return $this->playerSystem;
  }

  public function getSceneSystem(): SceneSystem
  {
    return $this->sceneSystem;
  }

  public function getPartySystem(): PartiesSystem
  {
    return $this->partySystem;
  }

  public function getMapsData(): MapsData
  {
    return $this->mapsData;
  }

  public function getEventSystem(): EventSystem
  {
    return $this->eventSystem;
  }

  public function getEntitySystem(): EntitySystem
  {
    return $this->entitySystem;
  }

  // create all the systems

  /**
   * @throws ReflectionException
   */
  public function init(): void
  {
    $this->playerSystem = new PlayerSystem($this->core);
    $this->systems[] = $this->playerSystem;

    $this->sceneSystem = new SceneSystem($this->core);
    $this->systems[] = $this->sceneSystem;

    $this->partySystem = new PartiesSystem($this->core);
    $this->systems[] = $this->partySystem;

    $this->mapsData = new MapsData($this->core);
    $this->systems[] = $this->mapsData;

    $this->eventSystem = new EventSystem($this->core);
    $this->systems[] = $this->eventSystem;

    $this->entitySystem = new EntitySystem($this->core);
    // We need to init this first right away since we need our entities registered ASAP before our scene system inits and creates actors.
    // It would probably make more sense to just construct the entity system before anything else, but that would change the order of tick updates.
    // This has been in this order for 2 years now so I don't want to modify our servers update logic order, hence this hack.
    $this->entitySystem->init();

    // Then init all the systems (except the entity system we already did that, this is scuffed design deferring its addition to the systems array)
    foreach ($this->systems as $system) {
      $system->init();
    }

    // Then add to systems array since we didn't want to double init it (this is scuffed)
    $this->systems[] = $this->entitySystem;
  }

  public function updateTick(): void
  {
    foreach ($this->systems as $system) {
      $system->updateTick();
    }
  }

  public function updateSecond(): void
  {
    foreach ($this->systems as $system) {
      $system->updateSecond();
    }
  }

  public function handlePlayerLeave(SwimPlayer $swimPlayer): void
  {
    foreach ($this->systems as $system) {
      $system->handlePlayerLeave($swimPlayer);
    }
  }

  public function exit(): void
  {
    foreach ($this->systems as $system) {
      $system->exit();
    }
    $this->systems = [];
  }

}