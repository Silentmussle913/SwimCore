# SwimCore Architecture Overview

SwimCore is designed as a modular game engine for PocketMine-based Minecraft servers. The main architectural concepts are:

- Systems: The `SystemManager` updates the active `Systems` each tick and per second. Systems encapsulate domain-specific responsibilities like Players, Scenes, Entities, Events, Party system, and Map management.
- Scenes: Scenes represent major gameplay areas (Hub, Duels, FFAs, Events) and encapsulate logic, world loading, and per-scene updates.
- ECS (Entity Component System): Players and custom actors use ECS-style components and behaviors to store state and logic.
- Custom Entities: The `custom/prefabs` folder contains actors and items used in gameplay, with full control over skin, geometry, and behavior.
- Communicator: A cross-server communicator (Discord/Server linking) using packetized structures in `core/communicator`.
- Database: `core/database` houses async database connection management and common queries.
- Auto-loading: SwimCore supports auto-loading of commands, scenes, and prefabs by discovering classes with specific static methods or namespaces.

Key folders
- `src/core/commands` — Command handlers and CLI utilities
- `src/core/scenes` — Scenes and gameplay logic
- `src/core/systems` — Systems and services used across scenes and players
- `src/core/custom` — Custom prefabs and behaviors for items and entities
- `src/core/utils` — Utilities, helper classes, and low-level platform integration
- `src/core/communicator` — Packet-based system for cross-server or discord communication
- `src/core/database` — Database connection and SQL query wrappers

This documentation includes an API-level module reference for each of the above folders. Refer to `docs/api/TOC.md` for more details.