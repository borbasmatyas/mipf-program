document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule");
    const currentTimeLine = document.createElement("div");
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine);

    const TEST_MODE = true; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-05T11:30:00";
    const now = TEST_MODE ? new Date(TEST_TIME) : new Date();

    // Segédfüggvény: Görgessen az aktuális időhöz
    function scrollToCurrentTime() {
        const currentTimeElement = document.querySelector(".current-time-line");
        if (currentTimeElement) {
            currentTimeElement.scrollIntoView({ behavior: "smooth", block: "center" });
        }
    }

    // Időt jelző vonal pozíciójának frissítése
    function updateCurrentTimeLine() {
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

    // Görgetés az aktuális időhöz oldal betöltésekor
    updateCurrentTimeLine();
    scrollToCurrentTime();

    // Időszakos frissítés (pl. percenként)
    setInterval(() => {
        updateCurrentTimeLine();
        scrollToCurrentTime();
    }, 60000); // Frissítés percenként
});
