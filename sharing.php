<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Események Megosztása és Kezelése</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .highlighted {
            background-color: yellow;
        }
    </style>
</head>
<body>
    <h1>Események Megosztása és Kezelése</h1>

    <!-- Saját események kezelése -->
    <div class="section" id="manage-own">
        <h2>Saját Kiemelt Események</h2>
        <label for="your-name">Az Ön neve:</label>
        <input type="text" id="your-name" placeholder="Adja meg a nevét">
        <button id="save-name">Név Mentése</button>
        <ul id="highlighted-list"></ul>
        <button id="clear-events">Minden Esemény Törlése</button>
    </div>

    <!-- Megosztás -->
    <div class="section" id="share-events">
        <h2>Események Megosztása</h2>
        <button id="generate-url">Megosztási URL Generálása</button>
        <p id="share-url"></p>
    </div>

    <!-- Megosztott események fogadása -->
    <div class="section" id="receive-events">
        <h2>Megosztott Események Fogadása</h2>
        <label for="shared-url">Megosztott URL:</label>
        <input type="text" id="shared-url" placeholder="Illessze be az URL-t">
        <button id="process-url">Feldolgozás</button>
        <div id="received-actions">
            <p>Ez kinek az eseménye?</p>
            <button id="override-own">Saját Eseményként Mentés</button>
            <button id="add-new-friend">Új Barát Hozzáadása</button>
        </div>
    </div>

    <script>
        // LocalStorage kulcsok
        const OWN_EVENTS_KEY = "highlighted_my_events";
        const FRIEND_EVENTS_PREFIX = "highlighted_friend_";

        // Segédfüggvények
        const loadEvents = (key) => JSON.parse(localStorage.getItem(key)) || [];
        const saveEvents = (key, events) => localStorage.setItem(key, JSON.stringify(events));
        const clearEvents = (key) => localStorage.removeItem(key);

        // Saját név mentése
        document.getElementById("save-name").addEventListener("click", () => {
            const name = document.getElementById("your-name").value;
            localStorage.setItem("user_name", name);
            alert("Név elmentve: " + name);
        });

        // Saját események kezelése
        const renderOwnEvents = () => {
            const events = loadEvents(OWN_EVENTS_KEY);
            const list = document.getElementById("highlighted-list");
            list.innerHTML = "";
            events.forEach((event, index) => {
                const li = document.createElement("li");
                li.textContent = `${event.venueHash} - ${event.startTime}`;
                li.addEventListener("click", () => {
                    events.splice(index, 1);
                    saveEvents(OWN_EVENTS_KEY, events);
                    renderOwnEvents();
                });
                list.appendChild(li);
            });
        };
        document.getElementById("clear-events").addEventListener("click", () => {
            clearEvents(OWN_EVENTS_KEY);
            renderOwnEvents();
        });
        renderOwnEvents();

        // Megosztási URL generálása
        document.getElementById("generate-url").addEventListener("click", () => {
            const events = loadEvents(OWN_EVENTS_KEY);
            const userName = localStorage.getItem("user_name") || "Ismeretlen";
            const url = `${window.location.origin}?data=${encodeURIComponent(JSON.stringify(events))}&name=${encodeURIComponent(userName)}`;
            document.getElementById("share-url").textContent = url;
        });

        // Megosztott események fogadása
        document.getElementById("process-url").addEventListener("click", () => {
            const url = document.getElementById("shared-url").value;
            const params = new URLSearchParams(url.split("?")[1]);
            const data = JSON.parse(decodeURIComponent(params.get("data")));
            const name = decodeURIComponent(params.get("name")) || "Barát";

            document.getElementById("override-own").addEventListener("click", () => {
                saveEvents(OWN_EVENTS_KEY, data);
                alert("Saját események frissítve.");
            });

            document.getElementById("add-new-friend").addEventListener("click", () => {
                const friendKey = `${FRIEND_EVENTS_PREFIX}${name}`;
                saveEvents(friendKey, data);
                alert(`Események mentve barátként: ${name}`);
            });
        });
    </script>
</body>
</html>
