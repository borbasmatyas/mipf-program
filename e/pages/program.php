<?php
/*
// JSON fájl beolvasása
$jsonFile = 'path/to/your/jsonfile.json';
$jsonData = file_get_contents($jsonFile);
$data = json_decode($jsonData, true);
*/
if (!$data) {
	die("Nem sikerült beolvasni a JSON fájlt.");
}

echo('----');

if (
	isset($page['segments'][1])
	and is_numeric($page['segments'][1])
	and $page['segments'][1] > 0
	and $page['segments'][1] <= $days
) {
	if (isset($_POST['program_id']) and is_numeric($_POST['program_id'])) {
		include('./e/includes/program_munkatars_kapcsolat.php');
	} else {
		?>

		<form id="program" method="post" action="<?php echo $_SERVER['REQUEST_URI_PATH']; ?>">
		</form>
		<?php

		echo '
			<div class="nap_cim">
				<h1>' . $day . '. nap</h1>
				<p><span class="nap_datum">' .  $magyar_honapok[date('m', strtotime($first_time))] . ' ' .  date('d.', strtotime($first_time)) . '</span><br>
				<span class="nap_nap">'. $magyar_napok[date('w', strtotime($first_time))] . '</span></p>
			</div>
		';

		?>
		<div class="schedule" aria-labelledby="schedule-heading">
		<?php
		$first = date('U', strtotime($first_time));
		$last = date('U', strtotime($last_time));
		$t = $first;

		$gap = 15; // percek

		do {
			if (date('i', $t) == '00') {
				$class = 'egeszora';
			} else {
				$class = 'nem_egeszora';
			}

			echo '    <span class="time-slot monospace ' . $class . '" style="grid-row: time-' . date('Hi', $t) . ';">' . date('H:i', $t) . '</span>' . chr(13);
			$t = $t + ($gap * 60);
		} while ($t <= $last);

		?>

		<?php
		foreach ($data as $location) {
			echo '<span class="venue-slot" aria-hidden="true" style="grid-column: venue-' . $location["locationHash"] . '; grid-row: venues;">' . $location['locationName'] . '</span>';

			foreach ($location['programs'] as $program) {
				$start_time = date('Hi', strtotime($program['startTime']));
				$end_time = date('Hi', strtotime($program['endTime']));

				$title = '<h3 class="session-title">' . $program['title'] . '</h3>';
				$highlighted = 'highlighted';

				if ($auth === true AND $user['level'] != NULL) {
					$title = '<button class="session-title" form="program" name="program_id" value="' . $program['program_id'] . '">' . $program['title'] . '</button>';
				}

				if ($auth === true) {
					if ($user['forevents'] == 1 AND $user['uid'] == $program['event_user_id']) {
						$highlighted = 'highlighted';
					} else if ($user['forevents'] == 0 AND $program['event_user_id'] != NULL) {
						$highlighted = 'highlighted';
					} else {
						$highlighted = '';
					}

					if ($program['event_user_name'] != NULL) {
						$color_attrib = ((isset($program['event_user_color'])) and ($program['event_user_color'] != NULL)) ? ('style="border-right-color: ' . $program['event_user_color'] . ';"') : '';
						$event_user_label = '<span class="person" ' . $color_attrib . ' >' . $program['event_user_name'] . '</span>';
					} else {
						$event_user_label = '';
					}

				} else {
					$event_user_label = '';
				}

				if ($program['status'] == 2) {
					$elmarad = 'elmarad';
				} else {
					$elmarad = '';
				}

				if (date('U', strtotime($program['endTime'])) < date('U')) {
					$vege = 'vege';
				} else {
					$vege = '';
				}

				echo '
					<div class="session ' . $elmarad . ' ' . $highlighted . ' ' . $vege . ' session-' . $i . ' venue" style="grid-column: venue-' . $program['vid'] . '; grid-row: time-' . $start_time . ' / time-' . $end_time . ';">
					<span class="session-time monospace">' . date('H:i', strtotime($program['startTime'])) . '</span>
					' . $event_user_label . '
					' . $title . '
					<span class="venue">' . $program['venue'] . '</span>
					</div>
				';
			}
		}

		$now = date('U');
		$now = ceil($now / 300) * 300;
		if (
			$now > date('U', strtotime($first_time))
			and
			$now < date('U', strtotime($last_time))
		) {
			echo '<hr class="now" style="grid-column: venue-1 / venue-' . $venues . '; grid-row: time-' . date('Hi', $now) . '">';
		}

		?>

		</div>

		<?php
	}
} else {
	header('Location: /program/1');
}

?>