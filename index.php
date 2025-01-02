<?php

require_once ('e/config/config.php');

ob_start();
session_start();



//require_once ('e/modules/mysql/mysql.php');
require_once ('e/modules/pages/pages.php');

header('X-Robots-Tag: noindex, nofollow, noarchive');
?>
<!doctype html>
<html class="no-js" lang="hu">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex, nofollow, noarchive">
		<link rel="stylesheet" href="/styles/main.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/menu.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/form.css?<?php echo date('U'); ?>">
		<?php 
			if($page['name']=='program') {

				$day = ( isset($page['segments'][1]) and is_numeric($page['segments'][1]) ) ? $page['segments'][1] : 1;


				$sql = <<<SQL

					SELECT 
						`events`.`id` AS "program_id"
						,`events`.`vid` AS "vid"
						,`start_date`
						,ADDTIME(start_date, duration) AS "end_date"
					FROM `events`
					LEFT JOIN `venues`
						ON `events`.`vid` = `venues`.`vid`
					WHERE `did` = %s
						AND `events`.`status` > 0
					ORDER BY `start_date` ASC
					LIMIT 1

				SQL;
				$sql = sprintf($sql, $day);
				$result = $mysqli->query($sql);
				$row = $result->fetch_assoc();
				$first_time = $row['start_date'];
				$result->free();

				$sql = <<<SQL

					SELECT 
						`events`.`id` AS "program_id"
						,`events`.`vid` AS "vid"
						,`start_date`
						,ADDTIME(start_date, duration) AS "end_date"

					FROM `events`
					LEFT JOIN `venues`
						ON `events`.`vid` = `venues`.`vid`
					WHERE `did` = %s
						AND `events`.`status` > 0
					ORDER BY `start_date` DESC
					LIMIT 1

				SQL;
				$sql = sprintf($sql, $day);
				$result = $mysqli->query($sql);
				$row = $result->fetch_assoc();
				$last_time = $row['end_date'];
				$result->free();


				$sql = <<<SQL

					SELECT 
						COALESCE(`venues`.`merged`,`venues`.`vid`) AS "vid"
					FROM venues
					GROUP BY COALESCE(`venues`.`merged`,`venues`.`vid`)

				SQL;
		
				$result = $mysqli->query($sql);
				$venues = $result->num_rows;
				$result->free();

				if($page['name']=='program' AND !isset($_POST['program_id'])) {

					echo 
						'<link rel="stylesheet" href="/styles/grid-template.php?'
							.date('U')
							.'&day=' . $day
							.'&first_time=' . date('U', strtotime($first_time))
							.'&last_time=' . date('U', strtotime($last_time))
							.'&venues=' . $venues .'"
						>'.chr(13);

						echo '<link rel="stylesheet" href="/styles/program.css?' . date('U') . '">'.chr(13);
				}


			}
		?>
		
		<?php 
		if($page['name'] != 'program') {
			echo '<link rel="stylesheet" href="/styles/' . $page['name'] .'.css?' . date('U') . '">'.chr(13);
		}
		?>

		<title><?php echo $title ?></title>
		<meta name="description" content="Weboldal">
	</head>

<?php

if($page['name'] == 'program' and isset($_POST)) {
	$body_class = $page['name'].'-center';
} else {
	$body_class = $page['name'];
}

?>

	<body class="<?php echo $body_class; ?>">
			<header>
				<a class="foo-logo" href="/">
					<img src="/images/logo.png">
				</a>

				<?php include('./e/includes/_menu.php'); ?>

			</header>
			<main>
				<?php
					if($allow) {
						include $page['file'];
					}
				?>
			</main>

			<footer>

				<p>
					<img class="invertocat" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABeklEQVRIidXUPU8VURSF4YeLgIQES0JhQSeQGPA3mChfkQgVhR1/g4QQNVJaameorCy0sLO2JRAQOoNKTEhosJJLMTO5w+YMM5eOlZzcj73Wu+ec2TncdvXU1HvxFMuYxv088xvf8Rmf8P8mzZ9gH+2adYi5bsA9WMd5A3ixzrGp/kTARhfguDbq4HMh8AgL2E7AfmAJD8L/M1XwO7LzLJv78togpvLPQTzEvbzWGzJ7pdwlLSaecqxuyxhJ5BaKYqtkXArBA9k41ulUdlxlRRbYCU/xvAG80LOQ3U6Z/gbTcBcNhkP2pCiUj6i/C2BUnP+7qQY/g6ly3BKaDb+PU6Ytl7d5hPEG8An8CtmPKWNqTP/hVQ6JmsTr3BNzL1IN+nQutzV8KQXeJvwfEuC2bLQHqrY7L7u4zjCKr/iTf0/tINVgpQpe6GVufFPjayXg7+rgdK7rNnbx7RpvGf5edp811mOdd3Jdg2MVL7WJWq7OeFmrGLop/HboAtvUneYxMJW3AAAAAElFTkSuQmCC"/>
					<a class="monospace" href="https://github.com/borbasmatyas" target="_blank">@borbasmatyas</a>
					<?php if($_SERVER['SERVER_NAME'] == 'mipf.dev.borbasmatyas.hu') { ?>
						<svg class="repository" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true">
							<path fill-rule="evenodd" d="M11.75 2.5a.75.75 0 100 1.5.75.75 0 000-1.5zm-2.25.75a2.25 2.25 0 113 2.122V6A2.5 2.5 0 0110 8.5H6a1 1 0 00-1 1v1.128a2.251 2.251 0 11-1.5 0V5.372a2.25 2.25 0 111.5 0v1.836A2.492 2.492 0 016 7h4a1 1 0 001-1v-.628A2.25 2.25 0 019.5 3.25zM4.25 12a.75.75 0 100 1.5.75.75 0 000-1.5zM3.5 3.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0z"></path>
						</svg>
						<a class="monospace" href="">mipf-program</a>
					<?php } ?>
					<a href="/data-source/program-json.php" target="_blank">Adatforrás (JSON)</a>
				</p>
				<p>
					<a href="https://madeinpecsfesztival.hu" target="_blank">Made in Pécs fesztivál</a>
				</p>
				<p>A "Made in Pécs fesztivál" logó és név a fesztivál szervezőjének tulajdona.</p>

			</footer>

		<!-- Scriptek -->  
		<!-- Scriptek (vége) -->

	</body>
</html>
<?php


$mysqli->close();

?>