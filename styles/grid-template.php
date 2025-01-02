<?php 
header("Content-type: text/css");

           // JSON fájl beolvasása a program-json.php-ból
		   $jsonFile = 'data-source/program-json.php';
		   include $jsonFile;
		   $jsonData = $raw_json;
		   $data = json_decode($jsonData, true);

if (!$data) {
	die("Nem sikerült beolvasni a JSON fájlt.");
}

$day = $_GET['day'];
$first = $_GET['first_time'];
$last = $_GET['last_time'];

$v_space = '5fr';
$end_space = '10px';
$gap = '5'; // percek
$timing_space = '5px';

echo '
	@media screen and (min-width:600px), print {
		.schedule {
			grid-template-columns:
			[times] 50px
';

$venue_before = 0;
foreach ($data as $location) {
	$venue = $location["locationHash"];

	if ($venue_before == 0) {
		echo '[venue-' . $venue . '-start] ' . $v_space . chr(13);
		$venue_before = $venue;
	} else {
		echo '[venue-' . $venue_before . '-end venue-' . $venue . '-start] ' . $v_space . chr(13);
		$venue_before = $venue;
	}
}

echo '[venue-' . $venue . '-end] ' . $end_space . chr(13);

echo '
			;
			grid-template-rows:
				[venues] auto
';

$t = $first;
do {
	echo '[time-' . date('Hi', $t) . '] ' . $timing_space . chr(13);
	$t = $t + ($gap * 60);
} while ($t <= $last);

echo '
			;
		}
	}
';
?>