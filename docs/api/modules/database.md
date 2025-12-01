# Database Module

This module provides database connectivity and queries.

- `SwimDB` — `src/core/database/SwimDB.php` — Database manager; connects to the database and handles libasynql queries.
- `ConnectionHandler` — `src/core/database/queries/ConnectionHandler.php` — Manages connection handlers.
- `TableManager` — `src/core/database/queries/TableManager.php` — Contains SQL table creation and management queries.
- `KeepAlive` — `src/core/database/KeepAlive.php` — DB keepalive task to keep connections from timing out.

Important: Before running, set up your DB and apply `mysql.sql` in `resources/` (if present) to set up the database schema.
