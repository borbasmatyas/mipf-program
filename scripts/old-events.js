document.addEventListener("DOMContentLoaded", function () {
    const TEST_MODE = true; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-04T11:30:00";
    const now = TEST_MODE ? new Date(TEST_TIME) : new Date(); // Aktuális idő

    // Minden session elem feldolgozása
    const sessions = document.querySelectorAll(".session");
    sessions.forEach((session) => {
        const dataStart = session.getAttribute("data-start"); // Esemény kezdete
        const dataEnd = session.getAttribute("data-end"); // Esemény vége

        if (dataStart && dataEnd) {
            // Átalakítjuk a dátumokat JavaScript Date objektumokká
            const startDate = new Date(dataStart);
            const endDate = new Date(dataEnd);

            // Ha az aktuális idő nagyobb, mint az esemény vége
            if (now > endDate) {
                session.style.opacity = "0.5"; // Átlátszóság beállítása
                console.log(
                    `Átlátszóvá tettük: ${session.textContent.trim()} (kezdete: ${dataStart}, vége: ${dataEnd})`
                );
            }
        }
    });
});
