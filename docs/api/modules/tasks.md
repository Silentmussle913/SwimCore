# Tasks Module

Periodically scheduled tasks running in the plugin.

- `SystemUpdateTask` — `src/core/tasks/SystemUpdateTask.php` — Updates systems each tick/second.
- `RandomMessageTask` — `src/core/tasks/RandomMessageTask.php` — Send random messages or rotate MOTD.

Notes
- Use `TaskScheduler` to schedule custom tasks or extend these tasks.
