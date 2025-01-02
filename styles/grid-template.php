<?php 
header("Content-type: text/css");

set_include_path($_SERVER['DOCUMENT_ROOT']);
include ('e/modules/mysql/mysql.php');



$day = $_GET['day'];
$first = $_GET['first_time'];
$last = $_GET['last_time'];
#$venues = $_GET['venues'];

$v_space = '5fr';
$end_space = '10px';
$gap ='5'; // percek
$timing_space = '5px';




echo '
	@media screen and (min-width:600px), print {
		.schedule {

			grid-template-columns:
			[times] 50px
			
';


$sql = 'SELECT vid,merged FROM venues';
$result = $mysqli->query($sql);

//Az egyesítéseket számolja az oszlopszám korrekcióhoz.
$m=0;
$venue_before = 0;
while($row = $result->fetch_assoc()) {

	// Korrigált oszlopszám (ha van egyesített helyszín)
	$venue = $row["vid"];

	if($venue_before==0) {
		echo '[venue-' . $row["vid"] . '-start] '.$v_space.chr(13);
		$venue_before = $row["vid"];
	}	else {

		if($row['merged']) {
		} else {
			echo '[venue-' . $venue_before . '-end venue-' . $row['vid'] . '-start] ' . $v_space . chr(13);
			$venue_before = $row["vid"];
		}
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
						echo '	[time-' . date('Hi', $t) . '] '. $timing_space . chr(13);
						$t = $t + ($gap * 60);

			} while( $t <= $last);

echo '
			;
		}
	}
';


$mysqli->close();
?>