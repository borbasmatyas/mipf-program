document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine);

    // Tesztidő: Használj valódi időt éles helyzetben
    const TEST_MODE = true;
    const TEST_TIME = "2025-01-04T11:09:00";
    const now = TEST_MODE ? new Date(TEST_TIME) : new Date();

    function updateCurrentTimeLine() {
        const gridStyles = window.getComputedStyle(schedule);
        const gridRows = gridStyles.getPropertyValue("grid-template-rows").split(" ");

        // Az időt `time-XXXX` formátumú cellákhoz kell igazítani
        const totalMinutes = now.getHours() * 60 + now.getMinutes(); // Teljes percek az éjfél óta
        const startRow = 1000; // Pl. 10:00 kezdő értéke
        const gap = 1; // Percek közti távolság a gridben

        // Kiszámítjuk, melyik grid sorhoz tartozik az aktuális idő
        const currentRowIndex = Math.floor((totalMinutes - startRow) / gap);

        // Ellenőrizzük, hogy a számított index a grid határain belül van-e
        if (currentRowIndex >= 0 && currentRowIndex < gridRows.length) {
            // A grid-row pozíció beállítása
            const position = gridRows[currentRowIndex];
            currentTimeLine.style.top = `${parseFloat(position)}px`; // A grid sor értékét használjuk
            console.log("Az aktuális idő a(z) ", currentRowIndex, ". sorban van.");
        } else {
            console.warn("Az idő kívül esik a grid tartományán.");
        }
    }

    // Frissítjük a vonalat, és percenként ismételjük
    updateCurrentTimeLine();
    setInterval(updateCurrentTimeLine, 60000); // Frissítés percenként
});
