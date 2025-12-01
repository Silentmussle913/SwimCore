# Communicator

File: `src/core/communicator/Communicator.php`

Summary:
- Handles packet-based communication for cross-server features and discord interactions.
- Creates `CommunicatorThread` and manages serialization/deserialization of packets.

Public API:
- `sendPacket(Packet $packet)` — Send a packet.
- `registerPacketType(string $id, string $class)` — Register a packet class in the pool.

Notes:
- Packets are used for updating discord role sync, server info, and remote queries.
- Extend `Packet` to create new packet types and implement `serialize()`/`deserialize()`.
