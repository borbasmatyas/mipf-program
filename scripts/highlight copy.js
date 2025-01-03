document.addEventListener("DOMContentLoaded", function () {
    const COOKIE_NAME = "highlightedSessions"; // Süti neve
    const COOKIE_EXPIRY_DAYS = 7; // Süti élettartama napokban

    // Süti beolvasása
    function getCookie(name) {
        const cookieString = document.cookie
            .split("; ")
            .find((row) => row.startsWith(name + "="));
        return cookieString ? JSON.parse(decodeURIComponent(cookieString.split("=")[1])) : [];
    }

    // Süti mentése
    function setCookie(name, value, days) {
        const expires = new Date();
        expires.setDate(expires.getDate() + days);
        document.cookie = `${name}=${encodeURIComponent(
            JSON.stringify(value)
        )}; expires=${expires.toUTCString()}; path=/`;
    }

    // Frissítjük a jelöléseket a süti alapján
    function applyHighlights() {
        const highlighted = getCookie(COOKIE_NAME);
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
            const highlighted = getCookie(COOKIE_NAME);

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
            setCookie(COOKIE_NAME, highlighted, COOKIE_EXPIRY_DAYS);
        });
    });

    // Jelölések alkalmazása betöltéskor
    applyHighlights();
});
