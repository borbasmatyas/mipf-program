document.addEventListener("DOMContentLoaded", function () {
    const schedule = document.querySelector(".schedule"); // A grid tartalmazó elem
    const currentTimeLine = document.createElement("div"); // Létrehozzuk a vonalat
    currentTimeLine.classList.add("current-time-line");
    schedule.appendChild(currentTimeLine);

    function updateCurrentTimeLine() {
        //const now = new Date(); // Aktuális idő
        const now = new Date("2025-01-04T10:45:00"); // Példa: manuális idő
        const hours = now.getHours();
        const minutes = now.getMinutes();
        const totalMinutes = hours * 60 + minutes;

        // Számoljuk ki, hogy melyik időréstől indul
        const firstSlot = 600; // 10:00 = 600 perc (példa)
        const gap = 30; // Például 30 percenként van egy időrés
        const rowHeight = 50; // Példa: minden időrés 50px magas

        const relativeMinutes = totalMinutes - firstSlot;
        if (relativeMinutes >= 0) {
            const topPosition = (relativeMinutes / gap) * rowHeight;
            currentTimeLine.style.top = `${topPosition}px`;
        } else {
            // Ha az idő a schedule előtt van
            currentTimeLine.style.top = `0px`;
        }
    }

    // Frissítsük a vonal pozícióját időnként
    updateCurrentTimeLine();
    setInterval(updateCurrentTimeLine, 60000); // Frissítés percenként
});
