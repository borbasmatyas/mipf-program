document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggleHighlighted");
    const rootElement = document.documentElement; 
    const COOKIE_NAME = "toggleFilterState";
    const COOKIE_EXPIRY_DAYS = 10;

    function isMobileView() {
        return window.innerWidth <= 600;
    }

    function saveState(isOnlyHighlighted) {
        if (window.CookieUtils) {
            window.CookieUtils.setCookieJson(COOKIE_NAME, isOnlyHighlighted, COOKIE_EXPIRY_DAYS);
        }
    }

    function loadState() {
        if (window.CookieUtils) {
            return window.CookieUtils.getCookieJson(COOKIE_NAME, false);
        }
        return false;
    }

    function updateUI(isOnlyHighlighted) {
        if (isOnlyHighlighted) {
            rootElement.classList.add("only-highlighted");
            toggleButton.textContent = "Összes esemény megjelenítése";
            toggleButton.classList.add("active");
        } else {
            rootElement.classList.remove("only-highlighted");
            toggleButton.textContent = "Kiemelt események megjelenítése";
            toggleButton.classList.remove("active");
        }
    }

    // Restore state from cookie on page load
    if (isMobileView()) {
        const savedState = loadState();
        updateUI(savedState);
    }

    toggleButton.addEventListener("click", () => {
        if (!isMobileView()) {
            console.log("Ez a funkció csak mobil nézetben érhető el!");
            return;
        }

        // Toggle class on root element
        rootElement.classList.toggle("only-highlighted");

        // Get new state and save it
        const isOnlyHighlighted = rootElement.classList.contains("only-highlighted");
        saveState(isOnlyHighlighted);

        // Update button text
        updateUI(isOnlyHighlighted);
    });
});
