<?php


include($_SERVER['DOCUMENT_ROOT'] . '/data-source/program-utils.php');
$jsonData = load_program_json();
[$first_time, $last_time] = get_program_time_range($jsonData);
$gap = 10; // percek

// HTML Kanban tábla generálása
echo '<div class="schedule" aria-labelledby="schedule-heading">';

// Időrések megjelenítése
$t = $first_time;
while ($t <= $last_time) {
    $class = (date('i', $t) == '00') ? 'time-primary' : 'time-secondary';
    echo '<span class="time-slot monospace ' . $class . '" style="grid-row: time-' . date('Hi', $t) . ';">' . date('H:i', $t) . '</span>' . PHP_EOL;
    $t += $gap * 60;
}

// Helyszínek megjelenítése
foreach ($jsonData as $location) {
    $venueHash = $location['locationHash'];
    $venueName = $location['locationName'];
    echo '<span class="venue-slot mipfeszt" aria-hidden="true" style="grid-column: venue-' . $venueHash . '; grid-row: venues;">' . $venueName . '</span>' . PHP_EOL;

    // Programok megjelenítése
    foreach ($location['programs'] as $program) {
		$start_time = date('Hi', strtotime($program['startTime']));
		$end_time = date('Hi', strtotime($program['endTime']));
		$title = htmlspecialchars($program['title'], ENT_QUOTES, 'UTF-8');
	
		// Esemény elmaradásának ellenőrzése
		$isCanceled = $program['isCanceled'];
	
		// Elmaradt esemény esetén cancel class hozzáadása
		$canceledClass = $isCanceled ? ' canceled' : '';
	
		echo '<div class="session' . $canceledClass . '" data-venue="' . $venueHash . '" data-start="' . date('Y-m-d\TH:i', strtotime($program['startTime'])) . '" data-end="' . date('Y-m-d\TH:i', strtotime($program['endTime'])) . '" style="grid-column: venue-' . $venueHash . '; grid-row: time-' . $start_time . ' / time-' . $end_time . ';">' . PHP_EOL;
		echo '<span class="session-time monospace">' . date('H:i', strtotime($program['startTime'])) . '</span>' . PHP_EOL;
		echo '<h3 class="session-title mipfeszt">' . $title . '</h3>' . PHP_EOL;
		echo '</div>' . PHP_EOL;
	}
}

echo '</div>'; // schedule vége
