document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine);

    const TEST_MODE = false; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-05T11:30:00";

    // Ellenőrizzük, hogy mobil nézetben vagyunk-e
    const isWideScreen = () => window.innerWidth >= 600;

    // Időt jelző vonal pozíciójának frissítése
    function updateCurrentTimeLine() {
        if (!isWideScreen()) {
            currentTimeLine.style.display = "none"; // Idővonal elrejtése mobil nézetben
            return;
        }

        currentTimeLine.style.display = ""; // Idővonal megjelenítése nagy képernyőn
        const now = TEST_MODE ? new Date(TEST_TIME) : new Date();
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

    function startInterval() {
        refreshInterval = setInterval(() => {
            updateCurrentTimeLine();
            scrollToCurrentTime();
        }, 60000);
    }

    function stopInterval() {
        if (refreshInterval) {
            clearInterval(refreshInterval);
            refreshInterval = null;
        }
    }

    if (isWideScreen()) {
        startInterval();
    }

    // Ablak méretének változását figyelő eseménykezelő
    window.addEventListener("resize", () => {
        if (isWideScreen()) {
            if (!refreshInterval) {
                startInterval();
            }
        } else {
            stopInterval();
        }
        updateCurrentTimeLine(); // Azonnal frissítsük az idővonal állapotát
    });
});
