<?php


// JSON adat betöltése
$return_json = true;
include($_SERVER['DOCUMENT_ROOT'] . '/data-source/program-json.php'); // Add meg a pontos elérési utat
$jsonData = $raw_json;
$jsonData = json_decode($jsonData, true);

if (!$jsonData) {
    die("Hiba: Nem sikerült betölteni a JSON adatot.");
}

// Kezdési és végidőpontok meghatározása
$first_time = strtotime($jsonData[0]['programs'][0]['startTime']);
$last_time = strtotime(end($jsonData[0]['programs'])['endTime']);
$gap = 30; // percek

// HTML Kanban tábla generálása
echo '<div class="schedule" aria-labelledby="schedule-heading">';

// Időrések megjelenítése
$t = $first_time;
while ($t <= $last_time) {
    $class = (date('i', $t) == '00') ? 'egeszora' : 'nem_egeszora';
    echo '<span class="time-slot monospace ' . $class . '" style="grid-row: time-' . date('Hi', $t) . ';">' . date('H:i', $t) . '</span>' . PHP_EOL;
    $t += $gap * 60;
}

// Helyszínek megjelenítése
foreach ($jsonData as $location) {
    $venueHash = $location['locationHash'];
    $venueName = $location['locationName'];
    echo '<span class="venue-slot" aria-hidden="true" style="grid-column: venue-' . $venueHash . '; grid-row: venues;">' . $venueName . '</span>' . PHP_EOL;

    // Programok megjelenítése
    foreach ($location['programs'] as $program) {
        $start_time = date('Hi', strtotime($program['startTime']));
        $end_time = date('Hi', strtotime($program['endTime']));
        $title = htmlspecialchars($program['title'], ENT_QUOTES, 'UTF-8');

        echo '<div class="session" style="grid-column: venue-' . $venueHash . '; grid-row: time-' . $start_time . ' / time-' . $end_time . ';">' . PHP_EOL;
        echo '<span class="session-time monospace">' . date('H:i', strtotime($program['startTime'])) . '</span>' . PHP_EOL;
        echo '<h3 class="session-title">' . $title . '</h3>' . PHP_EOL;
        echo '</div>' . PHP_EOL;
    }
}

echo '</div>'; // schedule vége
