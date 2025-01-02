<?php

	$sql = <<<SQL
		SELECT did
		FROM events
		GROUP BY did
		HAVING MAX(ADDTIME(start_date, duration)) > now()
		ORDER BY did ASC
	SQL;

	$result = $mysqli->query($sql);
	$days_left = $result->num_rows;

	$result->free();
	#$mysqli->next_result();

	$sql = <<<SQL
		SELECT 
			MAX(did) AS "last_day"
		FROM events
	SQL;


	$result = $mysqli->query($sql);
	$row = $result->fetch_assoc();
	$last_day = $row['last_day'];

	$result->free();
	#$mysqli->next_result();

	$actual_day= ($last_day - $days_left + 1);


?>

<article class="box">

		<?php 
			if($auth === true) { 

				echo '<h2>Szia ' . $user['name'] .'!</h2>';

				$sql = 'SELECT 
									event,
									start_date,
									venue
								FROM events
								LEFT JOIN users_events
									ON users_events.eid = events.id
								LEFT JOIN venues
									ON venues.vid = events.vid
								
								WHERE users_events.uid = %s
								AND events.start_date > NOW()
								ORDER BY start_date
								LIMIT 1';

				$sql = sprintf($sql,$user['uid']);
				$result = $mysqli->query($sql);
				$rows = $result->num_rows;

				if($rows==1) {
					$row = $result->fetch_assoc();
					$last_day = $row['last_day'];

					echo '<p class="center">
						Következik: <span class="bold">' . $row['event'] . '</span><br>
						' . date('H:i', strtotime($row['start_date'])) . ' ' . $row['venue'] . '
					</p>';

				}
				$result->free();



			} else { 
		?>
			<p>
					Ez egy saját, személyes célra készült oldal, mely a Made in Pécs fesztivál programját jeleníti meg.
			</p>

		<?php
			}
		?>
</article>

<nav>
	<ul>

		<?php if(!$auth): ?>
			<li><a href="/belepes" class="gomb normal belepes">Belépés</a></li>
		<?php endif; ?>

		<li><a href="/program/<?php echo $actual_day; ?>" class="gomb normal program">Program</a></li>

		<li>
			<a class="link" href="https://madeinpecsfesztival.hu" target="_blank">Tovább a fesztivál weboldalára</a>
		</li>
	</ul>
</nav>

<article>
	<p>
		Az oldal a működéséhez feltétlenül szükséges (munkamenet) süti(ke)t használ, de semmilyen adatgyűjtés vagy profilalkotás nem történik.
	</p>
</article> 
