# SystemManager

File: `src/core/systems/SystemManager.php`

Summary:
- Central system registry used to register and manage `System` instances.
- Runs system updates each tick and per second.

Public API:
- `registerSystem(System $system)` — Register a new system with the manager.
- `getSystem(string $id)` — Get a registered system.
- `tick()` — Per-tick update call.
- `second()` — Per-second update call.

Notes:
- Systems should extend the abstract `System` class to integrate with lifecycle hooks.
