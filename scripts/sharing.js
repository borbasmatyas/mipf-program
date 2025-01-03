document.addEventListener("DOMContentLoaded", function () {
    const COOKIE_NAME = "myHighlightedSessions"; // Saját események sütije
    const COOKIE_PREFIX = "friendHighlight_"; // Barátok kiemelt eseményei előtag

    function getCookie(name) {
        const cookieString = document.cookie
            .split("; ")
            .find((row) => row.startsWith(name + "="));
        return cookieString ? JSON.parse(decodeURIComponent(cookieString.split("=")[1])) : [];
    }

    function saveToCookie(cookieName, value) {
        const expires = new Date();
        expires.setDate(expires.getDate() + 7);
        document.cookie = `${cookieName}=${encodeURIComponent(JSON.stringify(value))}; expires=${expires.toUTCString()}; path=/`;
    }

    document.getElementById("saveOwn").addEventListener("click", () => {
        const data = JSON.parse(new URLSearchParams(window.location.search).get("data") || "[]");
        saveToCookie(COOKIE_NAME, data);
        alert("Az események mentve lettek sajátként!");
    });

    document.getElementById("saveNew").addEventListener("click", () => {
        const data = JSON.parse(new URLSearchParams(window.location.search).get("data") || "[]");
        const name = prompt("Add meg a barát nevét:", "Barát neve") || "Ismeretlen";
        const cookieName = COOKIE_PREFIX + name.replace(/\s+/g, "_");
        saveToCookie(cookieName, data);
        alert(`${name} eseményei mentve lettek!`);
    });

    const shareButton = document.getElementById("generateShareURL");
    if (shareButton) {
        shareButton.addEventListener("click", () => {
            const ownHighlighted = getCookie(COOKIE_NAME);
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
});
