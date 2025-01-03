document.addEventListener("DOMContentLoaded", () => {
    // Minden esemény elem kiválasztása
    const sessions = document.querySelectorAll(".session");

    // Egy objektum a grid pozíciók nyomon követésére
    const gridPositions = {};

    sessions.forEach(session => {
        // Grid pozíció meghatározása (oszlop és sor)
        const column = session.style.gridColumn;
        const row = session.style.gridRow;

        // Grid azonosító létrehozása
        const position = `${column}-${row}`;

        // Ha az azonosító még nincs a gridPositions-ben, adjuk hozzá
        if (!gridPositions[position]) {
            gridPositions[position] = [];
        }

        // Hozzáadjuk az aktuális eseményt a megfelelő pozícióhoz
        gridPositions[position].push(session);
    });

    // Ellenőrzés: vannak-e azonos pozíción több események
    Object.keys(gridPositions).forEach(position => {
        const events = gridPositions[position];
        if (events.length > 1) {
            // Ha egynél több esemény van az adott pozícióban
            events.forEach(event => {
                // Csak az elmaradt eseményekhez adjunk osztályt
                if (event.classList.contains("canceled")) {
                    event.classList.add("overlapping-canceled");
                }
            });
        }
    });
});
