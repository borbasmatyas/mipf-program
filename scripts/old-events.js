document.addEventListener("DOMContentLoaded", function () {
    const TEST_MODE = false; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-04T11:30:00";
    const now = TEST_MODE ? new Date(TEST_TIME) : new Date();

    // Formázó funkció: 2 számjegyű óra és perc
    const pad = (num) => num.toString().padStart(2, "0");

    // Az aktuális idő teljes formátumban
    const nowHours = pad(now.getHours());
    const nowMinutes = pad(now.getMinutes());
    const nowTotalMinutes = parseInt(nowHours) * 60 + parseInt(nowMinutes);

    // Minden session elem feldolgozása
    const sessions = document.querySelectorAll(".session");
    sessions.forEach((session) => {
        const timeEnd = session.getAttribute("data-end"); // Példa: "11:45"
        if (timeEnd) {
            // A végidő átalakítása percekké
            const [endHour, endMinute] = timeEnd.split(":").map((v) => parseInt(v));
            const endTotalMinutes = endHour * 60 + endMinute;

            // Ha az aktuális idő nagyobb, mint a session vége, csökkentjük az átlátszatlanságot
            if (nowTotalMinutes > endTotalMinutes) {
                session.style.opacity = "0.25";
                console.log(`Átlátszóvá tettük: ${session.textContent.trim()} (${timeEnd})`);
            }
        }
    });
});
