document.addEventListener("DOMContentLoaded", function () {
    const DEBUG = false;
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine); // Hozzáadjuk a gridhez

    const TEST_MODE = false;
    const TEST_TIME = "2025-01-04T11:09:00";

    // Mentjük az aktuális pozíciót, hogy ne mozduljon el érvénytelen helyre
    let lastValidTimeRow = null;

    function updateCurrentTimeLine() {
        const now = TEST_MODE ? new Date(TEST_TIME) : new Date(); // Minden hívásnál új időpont
        const pad = (num) => num.toString().padStart(2, "0");

        const hours = pad(now.getHours());
        const minutes = pad(now.getMinutes());
        const timeRow = `time-${hours}${minutes}`; // Pl. "time-1109"

        // Ellenőrizzük, hogy a kívánt `time-xxxx` létezik-e a grid-ben
        const gridRows = getComputedStyle(schedule).gridTemplateRows.split(" ");
        if (!gridRows.includes(`[${timeRow}]`)) {
            if (DEBUG) {
                console.warn(`A ${timeRow} pozíció nem létezik a grid-ben. A vonal nem mozdul.`);
            }
            return; // Ha nem létezik, ne változtassunk a vonal helyzetén
        }

        // Ha létezik, frissítsük a pozíciót és mentjük azt
        currentTimeLine.style.gridRow = timeRow; // Az aktuális időhöz tartozó sor
        currentTimeLine.style.gridColumn = "1 / -1"; // Az elsőtől az utolsó oszlopig
        lastValidTimeRow = timeRow; // Mentjük a legutóbbi érvényes időpozíciót
        if (DEBUG) {
            console.log(`Vonal pozíciója frissítve: ${timeRow}`);
        }
    }

    // Frissítjük a vonalat, és percenként ismételjük
    updateCurrentTimeLine();
    setInterval(updateCurrentTimeLine, 60000); // Frissítés percenként

    // Ablakméret-változás esetén azonnal frissítjük a pozíciót
    window.addEventListener("resize", updateCurrentTimeLine);
});
