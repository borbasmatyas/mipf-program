document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine); // Hozzáadjuk a gridhez

    const TEST_MODE = false;
    const TEST_TIME = "2025-01-04T11:09:00";
    const now = TEST_MODE ? new Date(TEST_TIME) : new Date();

    // Ellenőrizzük, hogy mobil nézetben vagyunk-e
    const isWideScreen = () => window.innerWidth >= 600;

    function updateCurrentTimeLine() {
        if (!isWideScreen()) {
            // Ha mobil nézetben vagyunk, rejtsük el a vonalat
            currentTimeLine.style.display = "none";
            return;
        }

        // Nagyobb képernyőn megjelenítjük a vonalat
        currentTimeLine.style.display = ""; // Megjelenítés
        const pad = (num) => num.toString().padStart(2, "0");

        const hours = pad(now.getHours());
        const minutes = pad(now.getMinutes());
        const timeRow = `time-${hours}${minutes}`; // Pl. "time-1109"

        // Beállítjuk a vonal helyét a gridben
        currentTimeLine.style.gridRow = timeRow; // Az aktuális időhöz tartozó sor
        currentTimeLine.style.gridColumn = "1 / -1"; // Az elsőtől az utolsó oszlopig

        console.log(`Vonal pozíciója: ${timeRow}`);
    }

    // Frissítjük a vonalat
    updateCurrentTimeLine();

    // Csak nagy képernyőn ismételjük a frissítést
    let refreshInterval = null;
    if (isWideScreen()) {
        refreshInterval = setInterval(updateCurrentTimeLine, 60000); // Frissítés percenként
    }

    // Ablakméret változás figyelése
    window.addEventListener("resize", () => {
        if (isWideScreen() && !refreshInterval) {
            // Ha nagyobb képernyőre váltunk, indítsuk el a frissítést
            refreshInterval = setInterval(updateCurrentTimeLine, 60000);
        } else if (!isWideScreen() && refreshInterval) {
            // Ha mobil nézetre váltunk, állítsuk le a frissítést
            clearInterval(refreshInterval);
            refreshInterval = null;
        }
        updateCurrentTimeLine(); // Azonnal frissítjük a vonalat
    });
});
