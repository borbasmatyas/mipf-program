document.addEventListener("DOMContentLoaded", function () {
    const TEST_MODE = false; // Teszt mód: kézi idő beállítása
    const TEST_TIME = "2025-01-04T11:30:00";

    function updateSessionClasses() {
        const now = TEST_MODE ? new Date(TEST_TIME) : new Date(); // Aktuális idő
        const sessions = document.querySelectorAll(".session");

        sessions.forEach((session) => {
            const dataStart = session.getAttribute("data-start"); // Esemény kezdete
            const dataEnd = session.getAttribute("data-end"); // Esemény vége

            if (dataStart && dataEnd) {
                // Átalakítjuk a dátumokat JavaScript Date objektumokká
                const startDate = new Date(dataStart);
                const endDate = new Date(dataEnd);

                // Ellenőrizzük, hogy az aktuális idő meghaladta-e az esemény végét
                if (now.getTime() > endDate.getTime()) {
                    // Hozzáadjuk a "past" osztályt, ha az esemény véget ért
                    session.classList.add("past");
                } else {
                    // Eltávolítjuk a "past" osztályt, ha már nem releváns
                    session.classList.remove("past");
                }
            }
        });

        console.log(`Események frissítve: ${now.toLocaleTimeString()}`);

        console.log(`Frissített idő: ${now} | Teszt mód: ${TEST_MODE}`);        


    }

    // Első frissítés az oldal betöltésekor
    updateSessionClasses();

    // 5 percenkénti frissítés (300000 ms = 5 perc)
    setInterval(updateSessionClasses, 300000);
});
