# Scene (abstract)

File: `src/core/systems/scene/Scene.php`

Summary:
- Base abstract class representing a gameplay scene (Hub, Duel, FFA, Movie, etc.)
- Manages players in the scene, spawn points, scene lifecycle, and per-tick updates.

Common methods:
- `init()` — Called to initialize the scene.
- `onPlayerJoin(SwimPlayer $player)` — Called when a player joins the scene.
- `onPlayerLeave(SwimPlayer $player)` — Called on player leave.
- `tick()` and `second()` — Update methods executed by the `SystemManager`.

Notes:
- Scenes register themselves with the `SceneSystem` and can be auto-loaded if they contain a static `AutoLoad()` function.
