# Forms Module

Forms are UI elements used in the hub, duels, and parties systems.

Main forms:
- `FormServerSelector` — `src/core/forms/hub/FormServerSelector.php` — Server/hub selector.
- `FormFFA` — `src/core/forms/hub/FormFFA.php` — FFA settings and join forms.
- `FormDuels`, `FormDuelRequests` — Duel queueing and request UI forms.
- Party forms: `FormPartySettings`, `FormPartyCreate`, `FormPartyInvite`, `FormPartyManagePlayers`, `FormPartyExit`, `FormPartyDuels`.

Forms use the underlying `FormAPI` virion and are designed for quick UI building.
