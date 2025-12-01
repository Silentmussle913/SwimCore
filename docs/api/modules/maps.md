# Maps Module

This module contains map pools and map info classes used by the Map System.

- `BasicDuelMaps` — `src/core/maps/pool/BasicDuelMaps.php` — Map pool used for duels.
- `FourTeamMapInfo` — `src/core/maps/info/FourTeamMapInfo.php` — Map info format for 4-team maps.

Add new map pools by deriving from `MapPool` and registering them in `MapsData`.
