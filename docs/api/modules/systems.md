# Systems Module

High-level systems that run core functionality.

- `System` (abstract) — Base system for the manager: `src/core/systems/System.php`
- `SystemManager` — Runs and registers core systems: `src/core/systems/SystemManager.php`
- `SceneSystem` — Manages scenes: `src/core/systems/scene/SceneSystem.php`
- `PlayerSystem` — Manages player objects and components: `src/core/systems/player/PlayerSystem.php`
- `EntitySystem` — Entity registry and behaviors: `src/core/systems/entity/EntitySystem.php`
- `EventSystem` — Server events and game events: `src/core/systems/event/EventSystem.php`
- `MapsData` — Map registry and pools: `src/core/systems/map/MapsData.php`
- `PartiesSystem` — Party management: `src/core/systems/party/PartiesSystem.php`

Scene-related types:
- `Scene` — Base abstract scene used to create Hub, Duel scenes, and FFA scenes.
- `SceneReplay`, `SceneRecorder` — Replay and camera related classes.
- `Team`, `TeamManager` — Team helper classes for team based scenes.

Player subsystem includes components for features such as:
- `Settings`, `Rank`, `Nicks`, `Attributes`, `ChatHandler`, `Invites`, `Kits`, `AckHandler`, and `AntiCheatData`.

---

Would you like a per-system deeper dive with method docs and sample code usage?