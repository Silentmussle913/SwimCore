# Scenes Module

Scenes represent gameplay areas or behaviours inside the server.

Key Scenes & classes
- `Scene` — (abstract) Base class for scenes in `src/core/systems/scene/Scene.php`.
- `Hub`, `Loading`, `Queue`, `EventQueue` — Hub-related scenes in `src/core/scenes/hub/*`
- `PvP`, `Duel`, `SkyGoalGame`, `Boxing`, `Midfight`, `Nodebuff` — PvP & Duel scene classes in `src/core/scenes/` with implementations for duels.
- `FFA`, `NodebuffFFA`, `MidFightFFA` — Free-For-All scenes in `src/core/scenes/ffas/*`.
- Replay & Movie Scenes: `SceneRecorder`, `SceneReplay`, `MovieScene`.

Scene behaviors
- Scenes can register `managers` for things like blocks, chests, dropped items, cell spawn positions, join requests, and team/ffa logic.
- Scenes should be registered with `SceneSystem` to auto-load and be accessible via the plugin.

Would you like me to produce a usage example for creating a new scene and registering it?