document.addEventListener("DOMContentLoaded", function () {
    const COOKIE_PREFIX = "friendHighlight_"; // Barátok eseményeinek sütielőtagja

    // Süti beolvasása
    function getCookie(name) {
        const cookieString = document.cookie
            .split("; ")
            .find((row) => row.startsWith(name + "="));
        return cookieString ? JSON.parse(decodeURIComponent(cookieString.split("=")[1])) : [];
    }

    // Összes barát kiemelt eseményének feldolgozása
    function applyFriendHighlights() {
        const allCookies = document.cookie.split("; ");
        allCookies.forEach((cookie) => {
            const [key, value] = cookie.split("=");
            if (key.startsWith(COOKIE_PREFIX)) {
                const friendName = key.replace(COOKIE_PREFIX, "").replace(/_/g, " ");
                const friendEvents = JSON.parse(decodeURIComponent(value));
                highlightFriendEvents(friendName, friendEvents);
            }
        });
    }

    // Egy barát eseményeinek feldolgozása
    function highlightFriendEvents(friendName, events) {
        events.forEach(({ venueHash, startTime }) => {
            const session = document.querySelector(
                `.session[data-venue="${venueHash}"][data-start="${startTime}"]`
            );
            if (session) {
                session.classList.add("friend-highlight"); // Barátok kiemelése
                const currentFriends = session.getAttribute("data-friends") || "";
                const friendList = currentFriends ? currentFriends.split(", ") : [];
                if (!friendList.includes(friendName)) {
                    friendList.push(friendName);
                }
                session.setAttribute("data-friends", friendList.join(", "));
            }
        });
    }

    // Jelölések alkalmazása betöltéskor
    applyFriendHighlights();
});
