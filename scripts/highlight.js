document.addEventListener("DOMContentLoaded", function () {
    const OWN_COOKIE_NAME = "highlightedSessions"; // Saját események sütije
    const SHARED_COOKIE_PREFIX = "shared_"; // Megosztott események előtagja
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

    // Minden releváns sütit beolvasása (saját + megosztott)
    function getAllHighlights() {
        const cookies = document.cookie.split("; ");
        const highlights = [];

        cookies.forEach((cookie) => {
            const [name, value] = cookie.split("=");
            if (name.startsWith(OWN_COOKIE_NAME) || name.startsWith(SHARED_COOKIE_PREFIX)) {
                const data = JSON.parse(decodeURIComponent(value));
                highlights.push({ name, data });
            }
        });

        return highlights;
    }

    // Jelölések alkalmazása
    function applyHighlights() {
        const highlights = getAllHighlights();

        highlights.forEach(({ name, data }) => {
            const isOwn = name === OWN_COOKIE_NAME;

            data.forEach(({ venueHash, startTime }) => {
                const session = document.querySelector(
                    `.session[data-venue="${venueHash}"][data-start="${startTime}"]`
                );
                if (session) {
                    session.classList.add(isOwn ? "highlighted-own" : "highlighted-shared");
                }
            });
        });
    }

    // Kattintás kezelése saját eseményekhez
    document.querySelectorAll(".session").forEach((session) => {
        session.addEventListener("click", () => {
            const venueHash = session.getAttribute("data-venue");
            const startTime = session.getAttribute("data-start");
            const highlighted = getCookie(OWN_COOKIE_NAME);

            const index = highlighted.findIndex(
                (item) => item.venueHash === venueHash && item.startTime === startTime
            );

            if (index === -1) {
                // Ha még nincs jelölve, hozzáadjuk
                highlighted.push({ venueHash, startTime });
                session.classList.add("highlighted-own");
            } else {
                // Ha már jelölve van, eltávolítjuk
                highlighted.splice(index, 1);
                session.classList.remove("highlighted-own");
            }

            // Süti frissítése
            setCookie(OWN_COOKIE_NAME, highlighted, COOKIE_EXPIRY_DAYS);
        });
    });

    // Jelölések alkalmazása betöltéskor
    applyHighlights();
});
