document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.getElementById("toggleHighlighted");
    const rootElement = document.documentElement; 

    function isMobileView() {
        return window.innerWidth <= 600;
    }

    toggleButton.addEventListener("click", () => {
        if (!isMobileView()) {
            console.log("Ez a funkció csak mobil nézetben érhető el!");
            return;
        }

        // Toggle class on root element
        rootElement.classList.toggle("only-highlighted");

        // Update button text
        if (rootElement.classList.contains("only-highlighted")) {
            toggleButton.textContent = "Összes esemény megjelenítése";
            toggleButton.classList.add("active");
        } else {
            toggleButton.textContent = "Kiemelt események megjelenítése";
            toggleButton.classList.remove("active");
        }
    });
});
