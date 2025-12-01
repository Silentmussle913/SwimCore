# Listeners Module

Event listeners that integrate with the PocketMine event system:

- `PlayerListener` — `src/core/listeners/PlayerListener.php` — Player-related events (login, quit, move, etc.).
- `WorldListener` — `src/core/listeners/WorldListener.php` — World-related events (blocks, unloads, level events).
- `AntiCheatListener` — `src/core/listeners/AntiCheatListener.php` — Anticheat event hooks for player behavior detection.

These listeners are registered on plugin enable and call into the various systems/components.
