# SwimCore (Plugin Entry)

File: `src/core/SwimCore.php`

Summary:
- Main plugin class extending `PluginBase`.
- Responsible for initialization of `SystemManager`, plugin configuration, enabling/disabling services, and registering commands.

Public API:
- lifecycle hooks: `onEnable`, `onLoad`, `onDisable`.
- `getSystemManager()` — Returns the `SystemManager`.

Examples:
- Use `getServer()->getPluginManager()->registerEvents()` to register listeners.

TODO:
- Add example code snippets of enabling systems and registering scenes.