# SwimDB

File: `src/core/database/SwimDB.php`

Summary:
- Central database class for registering and executing queries via libasynql.
- Provides helper functions for queries, prepared statements, and connection management.

Public API:
- `executeQuery(string $query, array $params)` — Executes a query asynchronously.
- `createConnection(array $config)` — Initializes a connection using libasynql.

Notes:
- `resources/mysql.sql` contains a sample schema for SwimCore.
