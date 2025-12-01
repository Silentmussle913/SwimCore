# Communicator Module

Cross-server and external integrations using a packet model.

Key elements:
- `Communicator` — `src/core/communicator/Communicator.php` — Main class used to send and receive packets.
- `CommunicatorThread` — `src/core/communicator/CommunicatorThread.php` — Worker thread used for communication across systems.
- `Packet` (abstract), `PacketSerializer` — base types for binary packet implementations.
- `Discord`-related packets: `DiscordUserRequestPacket`, `DiscordUserResponsePacket`, `DiscordLinkInfoPacket`, `DiscordLinkRequestPacket`, `DiscordEmbedSendPacket`, `DiscordCommandMessagePacket`, `DiscordCommandExecutePacket`, and other `Packet` types.
- `PacketPool`, `PacketDecoder` — helper utilities to decode and parse incoming packets.

This module encapsulates cross-server RPC for features such as updating roles on Discord, retrieving server lists, and sending embed messages.
