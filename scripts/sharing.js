document.addEventListener("DOMContentLoaded", function () {
    const COOKIE_NAME = "myHighlightedSessions"; // Saját események sütije
    const COOKIE_PREFIX = "friendHighlight_"; // Barátok kiemelt eseményei előtag

    document.getElementById("saveOwn").addEventListener("click", () => {
        const data = JSON.parse(new URLSearchParams(window.location.search).get("data") || "[]");
        CookieUtils.setCookieJson(COOKIE_NAME, data, 7);
        alert("Az események mentve lettek sajátként!");
    });

    document.getElementById("saveNew").addEventListener("click", () => {
        const data = JSON.parse(new URLSearchParams(window.location.search).get("data") || "[]");
        const name = prompt("Add meg a barát nevét:", "Barát neve") || "Ismeretlen";
        const cookieName = COOKIE_PREFIX + name.replace(/\s+/g, "_");
        CookieUtils.setCookieJson(cookieName, data, 7);
        alert(`${name} eseményei mentve lettek!`);
    });

    const shareButton = document.getElementById("generateShareURL");
    if (shareButton) {
        shareButton.addEventListener("click", () => {
            const ownHighlighted = CookieUtils.getCookieJson(COOKIE_NAME, []);
            if (ownHighlighted.length > 0) {
                const baseURL = `${window.location.origin}${window.location.pathname}`;
                const shareURL = `${baseURL}?data=${encodeURIComponent(JSON.stringify(ownHighlighted))}&name=Saját`;
                const shareURLParagraph = document.getElementById("shareURL");
                shareURLParagraph.textContent = shareURL;
                shareURLParagraph.style.color = "blue";
                shareURLParagraph.style.cursor = "pointer";
                shareURLParagraph.addEventListener("click", () => {
                    navigator.clipboard.writeText(shareURL);
                    alert("URL másolva a vágólapra!");
                });
            }
        });
    }

    // Mentett megosztások törlése
    const clearButton = document.getElementById("removeSaved");
    if (clearButton) {
        clearButton.addEventListener("click", () => {
            const confirmed = confirm("Biztosan törölni szeretnéd az összes megosztott eseményt?");
            if (confirmed) {

                // Mentett megosztott eseményeinek törlése
                document.cookie.split("; ").forEach((cookie) => {
                    const [name] = cookie.split("=");
                    if (name.startsWith(COOKIE_PREFIX)) {
                        CookieUtils.deleteCookie(name);
                    }
                });

                alert("Az összes mentett esemény törölve lett!");
            }
        });
    }
});
