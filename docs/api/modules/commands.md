# Commands Module

This document lists command classes under `src/core/commands`.

Notes:
- `BaseCommand` / `Command` derived classes register themselves and implement the plugin commands.

Classes & Files

(If you'd like detailed per-class docs, I can expand these entries.)

- `AcceptSceneJoinCommand` — src/core/commands/AcceptSceneJoinCommand.php — Accept a scene join request.
- `DiscordCmd` — src/core/commands/DiscordCmd.php — Admin command for communicator/discord.
- `DuelCommand` — src/core/commands/DuelCommand.php — Duel management command.
- `FlyCmd` — src/core/commands/FlyCmd.php — Toggle flight for players.
- `HubCmd` — src/core/commands/HubCmd.php — Teleport to hub.
- `InfoCommand` — src/core/commands/InfoCommand.php — General info and server status.
- `KickCommand` — src/core/commands/KickCommand.php — Kick players.
- `ListCommand` — src/core/commands/ListCommand.php — List online players/servers.
- `NickCmd` — src/core/commands/NickCmd.php — Nickname management.
- `PartyCommand` — src/core/commands/PartyCommand.php — Party system command.
- `PingCmd` — src/core/commands/PingCmd.php — Return ping stats.
- `QuickBan` — src/core/commands/QuickBan.php — Quickly ban players.
- `RankCmd` — src/core/commands/RankCmd.php — Rank/permission handling.
- `RegionCommand` — src/core/commands/RegionCommand.php — Region/world management.
- `ReplyCommand` — src/core/commands/ReplyCommand.php — Reply to messages.
- `SeeNick` — src/core/commands/SeeNick.php — Reveal players' nicknames.
- `SettingsCommand` — src/core/commands/SettingsCommand.php — Command to change settings for a player.
- `SpectateCommand` — src/core/commands/SpectateCommand.php — Force or start spectate mode.
- `StaffTP` — src/core/commands/StaffTP.php — Teleport staff members.
- `StopCommand` — src/core/commands/StopCommand.php — Halt the server.
- `TebexAlert` / `TebexRank` — src/core/commands/TebexAlert.php, src/core/commands/TebexRank.php — Provide integrations for Tebex (donation storefront).
- `TellCmd` — src/core/commands/TellCmd.php — Send a private message.

Additional subfolders include:
- `cosmetic/` (cosmetic commands such as particle trails, chat colors, tags) — src/core/commands/cosmetic/*
- `debugCommands/` — contains debug tools such as `RestartCommand`, `ScenesCommand`, `MapDebug`, `SpawnEntityCmd`, `DebugReplayCommand`, and others.
- `Punish/` and `Unpunish/` — punishment commands (Ban, Mute, Unban, Unmute, etc.).

---

If you want more detailed descriptions (methods, arguments, behaviors) I can expand individual classes into dedicated pages with method lists and code examples.