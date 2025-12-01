# Utils Module

This module contains helper classes, loaders, particle utilities, and low-level systems for SwimCore.

Main classes and short descriptions:
- `Colors` — `src/core/utils/Colors.php` — Text color utilities.
- `FileUtil` — `src/core/utils/FileUtil.php` — File read/write utility functions.
- `CustomDamage` — `src/core/utils/CustomDamage.php` — Custom damage utilities.
- `FilterHelper` — `src/core/utils/FilterHelper.php` — Filtering utilities.
- `InventoryUtil` — `src/core/utils/InventoryUtil.php` — Inventory helpers.
- `MathUtils` — `src/core/utils/MathUtils.php` — Math helper functions.
- `PacketsHelper` — `src/core/utils/PacketsHelper.php` — Crafting and sending packet methods.
- `PlayerInfoHelper` — `src/core/utils/PlayerInfoHelper.php` — Player info table helpers.
- `TimeHelper` — `src/core/utils/TimeHelper.php` — Time parsing helpers.
- `TaskUtils` — `src/core/utils/TaskUtils.php` — Task utilities.
- `SkinHelper` / `SkinInfo` — `src/core/utils/SkinHelper.php` & `SkinInfo.php` — Raw skin manipulation helpers.
- `SwimCoreInstance` — `src/core/utils/SwimCoreInstance.php` — Singleton or helper to retrieve the plugin instance.
- `VoidGenerator` — `src/core/utils/VoidGenerator.php` — World generation helpers.

Subfolders of interest:
- `loaders/` — Auto-loading utilities (WorldLoader, CommandLoader, CustomItemLoader).
- `raklib/` — RakLib integration (network layer changes, custom Raklib classes, net stack adapters).
- `config/` — configuration classes that load typed config structures.
- `particles/` — custom particle classes.
- `libpmquery/` — pinger/query logic.
- `acktypes/` — types representing acknowledgements used in networking.

---

Note: If you want detailed method documentation or docblocks for functions in these classes, I can add per-class files under `docs/api/classes/<ClassName>.md` with method parameters and usage examples.