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

        // Formázás: Óra és perc mindig 2 számjegyű legyen
        const pad = (num) => num.toString().padStart(2, "0");

        const hours = pad(now.getHours()); // Például "09" vagy "11"
        const minutes = pad(now.getMinutes()); // Például "05" vagy "45"
        const timeRow = `time-${hours}${minutes}`; // Például "time-0905"

        // Kezdő idő (pl. 10:00) percekben
        const startHour = 10; // Példa: kezdő óra 10:00
        const startRow = startHour * 60; // 10:00 = 600 perc

        // Aktuális idő percekben
        const totalMinutes = now.getHours() * 60 + now.getMinutes();

        // Grid rések közötti idő (gap) percekben
        const gap = 1; // Példa: 1 perc per grid-rész

        // Kiszámítjuk, hogy melyik sorhoz tartozik az aktuális idő
        const currentRowIndex = Math.floor((totalMinutes - startRow) / gap);

        // Ellenőrizzük, hogy a számított index a grid határain belül van-e
        if (currentRowIndex >= 0 && currentRowIndex < gridRows.length) {
            const position = gridRows[currentRowIndex];
            currentTimeLine.style.top = `${parseFloat(position)}px`; // A grid sor pozíciója pixelben
            console.log("Az aktuális idő a(z) ", currentRowIndex, ". sorban van: ", timeRow);
        } else {
            console.warn(
                "Az idő kívül esik a grid tartományán: ",
                currentRowIndex,
                " az aktuális óra és perc: ",
                hours,
                ":",
                minutes
            );
        }
    }

    // Frissítjük a vonalat, és percenként ismételjük
    updateCurrentTimeLine();
    setInterval(updateCurrentTimeLine, 60000); // Frissítés percenként
});
