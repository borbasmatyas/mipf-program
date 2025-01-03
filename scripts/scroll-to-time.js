document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine);

    const TEST_MODE = true; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-05T11:30:00";

    // Ellenőrizzük, hogy mobil nézetben vagyunk-e
    const isWideScreen = () => window.matchMedia("(min-width: 600px)").matches;

    // Időt jelző vonal pozíciójának frissítése
    function updateCurrentTimeLine() {
        if (!isWideScreen()) {
            currentTimeLine.style.display = "none"; // Idővonal elrejtése mobil nézetben
            return;
        }

        currentTimeLine.style.display = ""; // Idővonal megjelenítése nagy képernyőn
        const now = TEST_MODE ? new Date(TEST_TIME) : new Date();
        const gridStyles = window.getComputedStyle(schedule);
        const gridRows = gridStyles.getPropertyValue("grid-template-rows").split(" ");

        const pad = (num) => num.toString().padStart(2, "0");

        const hours = pad(now.getHours());
        const minutes = pad(now.getMinutes());
        const timeRow = `time-${hours}${minutes}`; // Például: time-1130

        currentTimeLine.style.gridRow = timeRow; // Az aktuális idő grid pozíciója
        currentTimeLine.style.gridColumn = "1 / -1"; // Az oszlopok szélessége

        console.log(`Az időt jelző vonal pozíciója: ${timeRow}`);
    }

    // Segédfüggvény: Görgessen az aktuális időhöz
    function scrollToCurrentTime() {
        if (!isWideScreen()) return; // Görgetés kikapcsolása kis képernyőn
        const currentTimeElement = document.querySelector(".current-time-line");
        if (currentTimeElement) {
            currentTimeElement.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    }

    // Görgetés az aktuális időhöz oldal betöltésekor
    updateCurrentTimeLine();
    scrollToCurrentTime();

    // Csak nagy képernyőn frissítünk időszakosan
    let refreshInterval = null;
    if (isWideScreen()) {
        refreshInterval = setInterval(() => {
            updateCurrentTimeLine();
            scrollToCurrentTime();
        }, 60000); // Frissítés percenként
    }

    // Ablak méretének változását figyelő eseménykezelő
    window.addEventListener("resize", () => {
        if (isWideScreen() && !refreshInterval) {
            // Ha nagy képernyőre váltunk, indítsuk el a frissítést
            refreshInterval = setInterval(() => {
                updateCurrentTimeLine();
                scrollToCurrentTime();
            }, 60000);
        } else if (!isWideScreen() && refreshInterval) {
            // Ha kis képernyőre váltunk, állítsuk le a frissítést
            clearInterval(refreshInterval);
            refreshInterval = null;
        }
        updateCurrentTimeLine(); // Azonnal frissítsük az idővonal állapotát
    });
});
