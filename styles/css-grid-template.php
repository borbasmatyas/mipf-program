<?php
header("Content-type: text/css");

include($_SERVER['DOCUMENT_ROOT'] . '/data-source/program-utils.php');
$jsonData = load_program_json();
[$first, $last] = get_program_time_range($jsonData);

$v_space = '5fr';
$end_space = '10px';
$gap = '1'; // percek
$timing_space = '0px';

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
