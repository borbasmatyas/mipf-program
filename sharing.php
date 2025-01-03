<?php
// Beolvasás GET paraméterekből
$data = isset($_GET['data']) ? json_decode($_GET['data'], true) : [];
$name = isset($_GET['name']) ? htmlspecialchars($_GET['name']) : "Ismeretlen megosztó";

// Ellenőrzés: érvényes-e az adatszerkezet
if (!is_array($data)) {
    die("Hibás megosztott adatstruktúra!");
}

// Saját sütik neve (saját események)
$COOKIE_NAME = "myHighlightedSessions";

// Süti beolvasása
function getCookieData($name) {
    $cookieString = $_COOKIE[$name] ?? null;
    return $cookieString ? json_decode($cookieString, true) : [];
}

// Saját kiemelt események betöltése
$ownHighlighted = getCookieData($COOKIE_NAME);
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megosztott események</title>
    <style>
        .highlighted { background-color: #ffd700; } /* Kiemelt események */
        .share-section { margin-top: 20px; }
    </style>
</head>
<body>
    <h1><?= $name ?> megosztott eseményei</h1>

    <div id="eventList">
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
        <h2>Mentés lehetőségek</h2>
        <button id="saveOwn">Mentés sajátként</button>
        <button id="saveNew">Mentés új barátként</button>
    </div>

    <div class="share-section">
        <h2>Saját események megosztása</h2>
        <?php if (count($ownHighlighted) > 0): ?>
            <button id="generateShareURL">Megosztási URL generálása</button>
            <p id="shareURL" style="margin-top: 10px;"></p>
        <?php else: ?>
            <p>Nincsenek saját kiemelt eseményeid a megosztáshoz.</p>
        <?php endif; ?>
    </div>

    <script src="/scripts/sharing.js"></script>
</body>
</html>
