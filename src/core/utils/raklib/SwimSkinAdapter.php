<?php

namespace core\utils\raklib;

use core\utils\SteveSkin;
use JsonException;
use pocketmine\entity\InvalidSkinException;
use pocketmine\entity\Skin;
use pocketmine\network\mcpe\convert\LegacySkinAdapter;
use pocketmine\network\mcpe\protocol\types\skin\SkinData;
use pocketmine\network\mcpe\protocol\types\skin\SkinImage;

class SwimSkinAdapter extends LegacySkinAdapter
{

  /**
   * @throws JsonException
   */
  public function toSkinData(Skin $skin): SkinData
  {
    $capeData = $skin->getCapeData();
    $capeImage = $capeData === "" ? new SkinImage(0, 0, "") : new SkinImage(32, 64, $capeData);
    $geometryName = $skin->getGeometryName();
    if ($geometryName === "") {
      $geometryName = "geometry.humanoid.custom";
    }
    return new SkinData(
      $skin->getSkinId(),
      "", //TODO: playfab ID
      json_encode(["geometry" => ["default" => $geometryName]], JSON_THROW_ON_ERROR),
      SkinImage::fromLegacy($skin->getSkinData()), [],
      $capeImage,
      $skin->getGeometryData()
    );
  }

  /**
   * @throws JsonException
   */
  public function fromSkinData(SkinData $data): Skin
  {
    if ($data->isPersona()) {
      return SteveSkin::getInstance()->getSkin();
    }

    $capeData = $data->getCapeImage()->getData();

    $resourcePatch = json_decode($data->getResourcePatch(), true);
    if (is_array($resourcePatch) && isset($resourcePatch["geometry"]["default"]) && is_string($resourcePatch["geometry"]["default"])) {
      $geometryName = $resourcePatch["geometry"]["default"];
    } else {
      throw new InvalidSkinException("Missing geometry name field");
    }

    return new Skin($data->getSkinId(), $data->getSkinImage()->getData(), $capeData, $geometryName, $data->getGeometryData());
  }

}