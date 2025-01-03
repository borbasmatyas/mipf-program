<?php
header("Content-type: text/css");

// A JSON formátumú adat betöltése az include segítségével
$return_json = true;
include($_SERVER['DOCUMENT_ROOT'] . '/data-source/program-json.php'); // Add meg a pontos elérési utat
$jsonData = $raw_json;
$jsonData = json_decode($jsonData, true);
if (!$jsonData) {
    die("Hiba: Nem sikerült betölteni a JSON adatot.");
}

// A JSON alapú értékek beállítása
$first = strtotime($jsonData[0]['programs'][0]['startTime']); // Első program kezdési időpontja
$last = strtotime(end($jsonData[0]['programs'])['endTime']);  // Utolsó program befejezési időpontja

$v_space = '5fr';
$end_space = '10px';
$gap = '2'; // percek
$timing_space = '1px';

echo '
@media screen and (min-width:600px), print {
    .schedule {
        grid-template-columns:
        [times] 50px
';

$venue_before = null;
foreach ($jsonData as $location) {
    $venueHash = $location['locationHash'];

    if ($venue_before === null) {
        echo '[venue-' . $venueHash . '-start] ' . $v_space . PHP_EOL;
        $venue_before = $venueHash;
    } else {
        echo '[venue-' . $venue_before . '-end venue-' . $venueHash . '-start] ' . $v_space . PHP_EOL;
        $venue_before = $venueHash;
    }
}

echo '[venue-' . $venue_before . '-end] ' . $end_space . PHP_EOL;

echo '
        ;

        grid-template-rows:
            [venues] auto
';

$t = $first;
while ($t <= $last) {
    echo '[time-' . date('Hi', $t) . '] ' . $timing_space . PHP_EOL;
    $t += ($gap * 60);
}

echo '
        ;
    }
}
';
?>
