document.addEventListener("DOMContentLoaded", function () {
    const COOKIE_NAME = "myHighlightedSessions"; // Az új saját süti neve
    const COOKIE_EXPIRY_DAYS = 7; // Süti élettartama napokban

    // Frissítjük a jelöléseket a süti alapján
    function applyHighlights() {
        const highlighted = CookieUtils.getCookieJson(COOKIE_NAME, []);
        highlighted.forEach(({ venueHash, startTime }) => {
            const session = document.querySelector(
                `.session[data-venue="${venueHash}"][data-start="${startTime}"]`
            );
            if (session) {
                session.classList.add("highlighted");
            }
        });
    }

    // Kattintás kezelése
    document.querySelectorAll(".session").forEach((session) => {
        session.addEventListener("click", () => {
            const venueHash = session.getAttribute("data-venue");
            const startTime = session.getAttribute("data-start");
            const highlighted = CookieUtils.getCookieJson(COOKIE_NAME, []);

            const index = highlighted.findIndex(
                (item) => item.venueHash === venueHash && item.startTime === startTime
            );

            if (index === -1) {
                // Ha még nincs jelölve, hozzáadjuk
                highlighted.push({ venueHash, startTime });
                session.classList.add("highlighted");
            } else {
                // Ha már jelölve van, eltávolítjuk
                highlighted.splice(index, 1);
                session.classList.remove("highlighted");
            }

            // Süti frissítése
            CookieUtils.setCookieJson(COOKIE_NAME, highlighted, COOKIE_EXPIRY_DAYS);
        });
    });

    // Jelölések alkalmazása betöltéskor
    applyHighlights();
});
