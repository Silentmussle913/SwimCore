# Installation Guide

This section describes how to setup SwimCore locally and on a server.

Requirements
- PHP 8.2 or newer (8.4 recommended)
- PocketMine MP (NGPM fork recommended for multi-version support)
- Virions listed in `.poggit.yml` or downloaded from poggit
- MariaDB / MySQL database for production

Steps
1. Install NGPM (recommended):
   - See the `README.md` for links and instructions.
2. Configure `plugin.yml` and required virions in `virions/` folder.
3. Copy the `config.yml` and `localDatabase.yml` in `resources/` into `resources/config.yml` (or adjust accordingly).
4. Prepare the `savedWorlds` and `worlds` folders with a `hub` world at minimum.
5. Set database credentials in `localDatabase.yml` or `config.yml`.
6. Start PocketMine using NGPM and enable the plugin.

Notes
- Without a database configured, you must adjust the code (SwimPlayer) if you want to run in a non-db environment.
- For development, use `localDatabase.yml` and ensure all `worker-limit` values are appropriate for your host.
- PostgreSQL / MariaDB configurations are supported via libasynql (see `.poggit.yml` virions list).

Troubleshooting
1. MySQL connection fails: ensure the database credentials in `localDatabase.yml` are correct and accessible.
2. Virions missing: download and place in `virions` folder or use Poggit to build the plugin with virions.
3. Missing `hub` world: copy `worlds/hub` into `savedWorlds` and adjust `worlds` folder.
