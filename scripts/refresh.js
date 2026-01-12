(() => {
    const DEBUG = false;
    const REFRESH_INTERVAL_MS = 15 * 60 * 1000; // 15 perc milliszekundumban
    const LAST_REFRESH_KEY = "lastPageRefresh";

    // Utolsó frissítés idejének lekérése sessionStorage-ból
    function getLastRefreshTime() {
        const stored = sessionStorage.getItem(LAST_REFRESH_KEY);
        return stored ? parseInt(stored, 10) : null;
    }

    // Utolsó frissítés idejének mentése sessionStorage-ba
    function setLastRefreshTime() {
        const now = Date.now();
        sessionStorage.setItem(LAST_REFRESH_KEY, now.toString());
        if (DEBUG) {
            console.log(`Utolsó frissítés időpontja mentve: ${new Date(now).toLocaleTimeString()}`);
        }
    }

    // Ellenőrzi, hogy kell-e frissíteni
    function shouldRefresh() {
        const lastRefresh = getLastRefreshTime();
        if (!lastRefresh) {
            if (DEBUG) {
                console.log("Nincs korábbi frissítési időpont, nem frissítünk.");
            }
            return false;
        }

        const now = Date.now();
        const timeSinceLastRefresh = now - lastRefresh;
        const shouldRefresh = timeSinceLastRefresh >= REFRESH_INTERVAL_MS;

        if (DEBUG) {
            console.log(`Utolsó frissítés óta eltelt idő: ${Math.floor(timeSinceLastRefresh / 1000)} másodperc`);
            console.log(`Frissítés szükséges: ${shouldRefresh}`);
        }

        return shouldRefresh;
    }

    // Oldal újratöltése
    function refreshPage() {
        if (DEBUG) {
            console.log("Oldal újratöltése...");
        }
        window.location.reload();
    }

    // Ellenőrzi és szükség esetén frissíti az oldalt
    function checkAndRefresh() {
        if (shouldRefresh()) {
            refreshPage();
        }
    }

    // Inicializálja az oldal betöltési időpontját
    function initialize() {
        setLastRefreshTime();
        if (DEBUG) {
            console.log("refresh.js inicializálva");
        }
    }

    // visibilitychange esemény figyelése
    document.addEventListener("visibilitychange", function () {
        if (document.visibilityState === "visible") {
            if (DEBUG) {
                console.log("Oldal láthatóvá vált (visibilitychange)");
            }
            checkAndRefresh();
        }
    });

    // pageshow esemény figyelése (főleg Safari/iOS miatt fontos)
    window.addEventListener("pageshow", function (event) {
        // Ha az oldal a bfcache-ből jön vissza
        if (event.persisted) {
            if (DEBUG) {
                console.log("Oldal visszatért bfcache-ből (pageshow)");
            }
            checkAndRefresh();
        }
    });

    // focus esemény figyelése
    window.addEventListener("focus", function () {
        if (DEBUG) {
            console.log("Ablak fókuszt kapott (focus)");
        }
        checkAndRefresh();
    });

    // Oldal betöltésekor inicializálás
    if (document.readyState === "loading") {
        document.addEventListener("DOMContentLoaded", initialize);
    } else {
        initialize();
    }
})();
