# Custom Module

This module contains custom prefabs, items, actors, blocks and behavior scripts.

Key areas
- `prefabs/` — Item and actor prefabs (pearls, bows, soups, fireworks, etc.)
- `blocks/` — Custom blocks: `CustomBlock`, `BoomBoxBlock`, `CustomBlockData`.
- `behaviors/` — Player and entity behaviors (e.g., `DoubleJump`, `NoFall`, `ParticleEmitter`, `SimpleMover`, `SimpleFollow`, `SimpleCombat`.)
- `bases` — Reusable base classes for prefabs like `ItemHolderActor`, `MainHandInventory`.

Examples:
- `SwimBow` and `SwimArrow` extend vanilla projectile item to add features such as custom damage and re-usage.
- `HubEntities` contains entities to be shown in the hub as actors, such as `FinnEntity`.
- `KnockerBox` / `ThrowingTNT` demonstrate Boombox-related custom bombs and behaviors.

---

Suggestion: For a developer guide, we can add a `docs/custom/how-to-create-prefab.md` walk-through that explains how to add a custom item and register it to the swimplugin.