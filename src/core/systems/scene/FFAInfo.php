<?php

namespace core\systems\scene;

class FFAInfo
{

  public function __construct
  (
    public string $sceneName, // for example: "skywarsffa"
    public string $decoratedName, // for colored use in forms and text fields, such as: "§4Midfight"
    public string $worldFolderName, // for example: "duels"
    public int    $preferredSlot, // what to sort the ffa scenes by for things like the ffa selection form
    public bool   $enabled = true
  )
  {
  }

}
