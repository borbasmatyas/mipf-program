document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine); // Hozzáadjuk a gridhez

    const TEST_MODE = false;
    const TEST_TIME = "2025-01-04T11:09:00";
    const now = TEST_MODE ? new Date(TEST_TIME) : new Date();

    function updateCurrentTimeLine() {
        const pad = (num) => num.toString().padStart(2, "0");

        const hours = pad(now.getHours());
        const minutes = pad(now.getMinutes());
        const timeRow = `time-${hours}${minutes}`; // Pl. "time-1109"

        // Beállítjuk a vonal helyét a gridben
        currentTimeLine.style.gridRow = timeRow; // Az aktuális időhöz tartozó sor
        currentTimeLine.style.gridColumn = "1 / -1"; // Az elsőtől az utolsó oszlopig

        console.log(`Vonal pozíciója: ${timeRow}`);
    }

    // Frissítjük a vonalat, és percenként ismételjük
    updateCurrentTimeLine();
    setInterval(updateCurrentTimeLine, 60000); // Frissítés percenként
});
