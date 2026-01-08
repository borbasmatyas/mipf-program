document.addEventListener("DOMContentLoaded", function () {
    const COOKIE_PREFIX = "friendHighlight_"; // Barátok eseményeinek sütielőtagja

    // Összes barát kiemelt eseményének feldolgozása
    function applyFriendHighlights() {
        const allCookies = document.cookie.split("; ");
        allCookies.forEach((cookie) => {
            const [key, value] = cookie.split("=");
            if (key.startsWith(COOKIE_PREFIX)) {
                const friendName = key.replace(COOKIE_PREFIX, "").replace(/_/g, " ");
                const friendEvents = CookieUtils.parseCookieValue(value, []);
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
                // Ha még nincs saját kiemelésként jelölve
                if (!session.classList.contains("highlighted")) {
                    session.classList.add("friend-highlight"); // Barátok kiemelése
                }

                // Hozzáadjuk a barát nevét az esemény megjelenítéséhez
                let friendsListElement = session.querySelector(".friends-list");
                if (!friendsListElement) {
                    friendsListElement = document.createElement("p");
                    friendsListElement.classList.add("friends-list");
                    friendsListElement.textContent = "Friends: "; // Alap szöveg
                    session.appendChild(friendsListElement);
                }

                // Nevek hozzáadása, ha még nem szerepelnek
                const currentFriends = friendsListElement.textContent.replace("Friends: ", "").split(", ").filter(Boolean);
                if (!currentFriends.includes(friendName)) {
                    currentFriends.push(friendName);
                    friendsListElement.textContent = "" + currentFriends.join(", ");
                }
            }
        });
    }

    // Jelölések alkalmazása betöltéskor
    applyFriendHighlights();
});
