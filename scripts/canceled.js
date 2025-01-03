document.addEventListener("DOMContentLoaded", function () {
    const sessions = document.querySelectorAll(".session");

    const sessionMap = new Map();

    // Események feldolgozása
    sessions.forEach((session) => {
        const startTime = session.getAttribute("data-start");
        const endTime = session.getAttribute("data-end");
        const key = `${startTime}-${endTime}`;

        if (!sessionMap.has(key)) {
            sessionMap.set(key, []);
        }
        sessionMap.get(key).push(session);
    });

    // Több esemény kezelése azonos időben
    sessionMap.forEach((sessionList) => {
        if (sessionList.length > 1) {
            sessionList.forEach((session) => {
                session.setAttribute("data-overlay", "true");
                if (!session.classList.contains("canceled")) {
                    // A nem elmaradt esemény kap prioritást
                    session.style.zIndex = "2";
                }
            });
        }
    });
});
