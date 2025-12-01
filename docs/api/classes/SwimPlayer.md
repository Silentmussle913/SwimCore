# SwimPlayer

File: `src/core/systems/player/SwimPlayer.php`

Summary:
- Extends the Player object to add SwimCore-specific components and per-player state.
- Holds components such as `Settings`, `Rank`, `Nicks`, `Kits`, `ChatHandler`, `AntiCheatData`, `AckHandler` etc.

Public API:
- `getComponent(string $componentClass)` — Access player components.
- `isInScene()` — Whether the player is currently in a scene.

Notes:
- SwimPlayer is the main object representing an online player and is managed by `PlayerSystem`.
- Many subsystems rely on player components for state.
