document.addEventListener("DOMContentLoaded", function () {
    const TEST_MODE = true; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-05T11:30:00";
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

            // Ellenőrizzük, hogy az aktuális idő meghaladta-e az esemény végét
            if (now.getTime() > endDate.getTime()) { // Precíz időösszehasonlítás
                session.style.opacity = "0.25"; // Átlátszóság beállítása
                console.log(
                    `Átlátszóvá tettük: ${session.textContent.trim()} (kezdete: ${dataStart}, vége: ${dataEnd})`
                );
            }
        }
    });
});
