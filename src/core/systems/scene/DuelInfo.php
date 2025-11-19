<?php

namespace core\systems\scene;

class DuelInfo
{

  // $classPath is the one field NOT saved in JSON as Queue scene helps find this for us based on mode name.
  public function __construct
  (
    public string $modeName, // for example: "bedfight"
    public string $decoratedName, // for colored use in forms and text fields, such as: "§4Midfight"
    public string $classPath, // for class loading such as: new $classPath(...)
    public string $worldFolderName, // for example: "duels"
    public bool   $isMisc, // if the duel uses miscDuels and duels world (legacy SwimCore jank)
    public bool   $isRanked, // if it is a ranked duel queue as well
    public bool   $enabled // basically just if Queue should use this or not
  )
  {
  }

}
