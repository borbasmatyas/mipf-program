<?php
// Saját események sütijének neve
$COOKIE_NAME = "myHighlightedSessions";

// Süti beolvasása
function getCookieData($name) {
    $cookieString = $_COOKIE[$name] ?? null;
    if (!$cookieString) {
        return [];
    }
    $decodedString = urldecode($cookieString); // URL-dekódolás
    return json_decode($decodedString, true) ?: []; // JSON dekódolás
}

// Saját kiemelt események betöltése
$ownHighlighted = getCookieData($COOKIE_NAME);

// Beolvasás GET paraméterekből (megosztott események)
$data = isset($_GET['data']) ? json_decode($_GET['data'], true) : [];
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "Ismeretlen megosztó";

// Ellenőrzés: érvényes-e az adatszerkezet
if (!is_array($data)) {
    die("Hibás megosztott adatstruktúra!");
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megosztott események</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0d091a;
            color: white;
            margin: 20px;
        }
        h1, h2 {
            color: #ffd700;
        }
        .highlighted {
            background-color: #ffd700;
            color: #000;
        }
        .session-list, .share-section {
            margin: 20px 0;
        }
        .session-list ul {
            list-style-type: none;
            padding: 0;
        }
        .session-list li {
            background-color: #342b55;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .button {
            background-color: #ffd700;
            color: #000;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }
        .button:hover {
            background-color: #e6c200;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>

    <div class="session-list">
        <h2>Események:</h2>
        <?php if (count($data) > 0): ?>
            <ul>
                <?php foreach ($data as $event): ?>
                    <li>
                        <strong>Helyszín:</strong> <?= htmlspecialchars($event['venueHash']) ?> <br>
                        <strong>Kezdés:</strong> <?= htmlspecialchars($event['startTime']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Nincsenek megosztott események.</p>
        <?php endif; ?>
    </div>

    <div id="saveOptions">
        <h2>Mentés lehetőségek:</h2>
        <button class="button" id="saveOwn">Mentés sajátként</button>
        <button class="button" id="saveNew">Mentés új barátként</button>
    </div>

    <div class="share-section">
        <h2>Saját események megosztása</h2>
        <?php if (count($ownHighlighted) > 0): ?>
            <button class="button" id="generateShareURL">Megosztási URL generálása</button>
            <p id="shareURL" class="hidden"></p>
        <?php else: ?>
            <p>Nincsenek saját kiemelt eseményeid a megosztáshoz.</p>
        <?php endif; ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const COOKIE_NAME = "myHighlightedSessions";

            // Süti beolvasása
            function getCookie(name) {
                const cookieString = document.cookie
                    .split("; ")
                    .find((row) => row.startsWith(name + "="));
                return cookieString ? JSON.parse(decodeURIComponent(cookieString.split("=")[1])) : [];
            }

            // Megosztási URL generálása
            const generateShareButton = document.getElementById("generateShareURL");
            if (generateShareButton) {
                generateShareButton.addEventListener("click", function () {
                    const highlighted = getCookie(COOKIE_NAME);
                    const shareData = JSON.stringify(highlighted);
                    const shareURL = `https://mipf.dev.borbasmatyas.hu/sharing.php?data=${encodeURIComponent(shareData)}`;

                    const shareURLElement = document.getElementById("shareURL");
                    shareURLElement.textContent = shareURL;
                    shareURLElement.classList.remove("hidden");
                });
            }
        });
    </script>
	<script src="/scripts/sharing.js"></script>
</body>
</html>

