<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Megosztott események</title>
    <link rel="stylesheet" href="/styles/main.css"> <!-- A közös stílusfájl -->
    <style>
        .sharing-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
        }

        .event-card {
            margin-bottom: 15px;
            padding: 10px;
            background-color: #342b55;
            color: white;
            border-left: 4px solid #4f359b;
            border-radius: 4px;
        }

        .event-card.highlighted {
            background-color: #ffd700;
            border-left-color: #b08900;
        }

        .event-details {
            font-size: 0.9rem;
        }

        .buttons {
            display: flex;
            gap: 10px;
        }

        #shareURL {
            margin-top: 10px;
            word-break: break-word;
        }
    </style>
</head>
<body>
    <header>
        <h1><?= $name ?> megosztott eseményei</h1>
    </header>

    <main class="sharing-container">
        <section>
            <h2>Megosztott események</h2>
            <div id="eventList">
                <?php if (count($data) > 0): ?>
                    <?php foreach ($data as $event): ?>
                        <div class="event-card">
                            <h3 class="event-title"><?= htmlspecialchars($event['venueHash']) ?></h3>
                            <div class="event-details">
                                <strong>Kezdés:</strong> <?= htmlspecialchars($event['startTime']) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nincsenek megosztott események.</p>
                <?php endif; ?>
            </div>
        </section>

        <section>
            <h2>Mentés lehetőségek</h2>
            <div class="buttons">
                <button id="saveOwn">Mentés sajátként</button>
                <button id="saveNew">Mentés új barátként</button>
            </div>
        </section>

        <section class="share-section">
            <h2>Saját események megosztása</h2>
            <?php if (count($ownHighlighted) > 0): ?>
                <button id="generateShareURL">Megosztási URL generálása</button>
                <p id="shareURL"></p>
            <?php else: ?>
                <p>Nincsenek saját kiemelt eseményeid a megosztáshoz.</p>
            <?php endif; ?>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Made in Pécs Fesztivál</p>
    </footer>

    <script src="/scripts/sharing.js"></script>
</body>
</html>
