<?php

namespace core\custom\blocks;

use customiesdevs\customies\block\CustomiesBlockFactory;
use customiesdevs\customies\block\Material;
use customiesdevs\customies\block\Model;
use customiesdevs\customies\item\CreativeInventoryInfo;
use pocketmine\block\BlockBreakInfo;
use pocketmine\block\BlockIdentifier;
use pocketmine\block\BlockTypeIds;
use pocketmine\block\BlockTypeInfo;
use pocketmine\block\Opaque;
use pocketmine\math\Vector3;
use Throwable;

abstract class CustomBlock extends Opaque //implements BlockComponents
{

  // use BlockComponentsTrait;

  /*
  public function __construct(BlockIdentifier $idInfo, string $name, BlockTypeInfo $typeInfo)
  {
    $data = BoomBoxBlock::getCustomBlockData();

    parent::__construct($idInfo, $data->customName ?? $name, $typeInfo);

    // $this->initComponent($data->customTexture); // false if no custom geo or remove this line and use the below stuff
    // $this->addComponent(new GeometryComponent($data->customGeo ?? "minecraft:geometry.full_block"));
  }
  */

  abstract public static function getCustomBlockData(): CustomBlockData;

  public static final function registerCustomBlock(string $classPath): void
  {
    /** @var CustomBlockData $data */
    $data = call_user_func([$classPath, "getCustomBlockData"]);

    $creativeInfo = new CreativeInventoryInfo(
      CreativeInventoryInfo::CATEGORY_ITEMS,
      CreativeInventoryInfo::GROUP_MINECRAFT
    );

    try {
      // Cache these to use as copies since blockFunc can be called from separate threads.
      $customName = $data->customName;
      $customIdentifier = $data->customIdentifier;

      $material = new Material(Material::TARGET_ALL, $data->customTexture, Material::RENDER_METHOD_OPAQUE);
      $model = new Model([$material], $data->customGeo, new Vector3(-8, 0, -8), new Vector3(16, 16, 16));

      CustomiesBlockFactory::getInstance()->registerBlock(
        static function () use ($classPath, $customName) {
          // blockFunc:
          $classPath = "\\" . $classPath;
          return new $classPath(
            new BlockIdentifier(BlockTypeIds::newId()),
            $customName,
            new BlockTypeInfo(new BlockBreakInfo(1))
          );
        },
        $customIdentifier,
        $model,
        $creativeInfo
      );
    } catch (Throwable $e) {
      echo("Custom Block Reg: " . $e->getMessage() . "\n");
    }
  }

}
