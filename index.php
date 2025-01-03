<!doctype html>
<html class="no-js" lang="hu">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex, nofollow, noarchive">
		<link rel="stylesheet" href="/styles/main.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/program.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/css-grid-template.php?<?php echo date('U'); ?>">
		<title>Program - Made in Pécs Fesztivál</title>
	</head>
	<body>
		<header>
			<img class="mipf-logo" src="/images/made-in-pecs-fesztival-logo-purple.svg" data-src="https://madeinpecsfesztival.hu/wp-content/themes/mipf-child/assets/images/made-in-pecs-fesztival-logo-purple.svg" alt="Made in Pécs Fesztivál logó">
		</header>
		<main>
			<?php include($_SERVER['DOCUMENT_ROOT'] . '/kanban.php'); ?>
		</main>
		<footer>

			<p>
				<a href="/sharing.php" class="monospace">Események megosztása</a> 
				<a href="/data-source/program-json.php" class="monospace">Adatforrás (JSON)</a>
			</p>

			<p>
				<img class="invertocat" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABeklEQVRIidXUPU8VURSF4YeLgIQES0JhQSeQGPA3mChfkQgVhR1/g4QQNVJaameorCy0sLO2JRAQOoNKTEhosJJLMTO5w+YMM5eOlZzcj73Wu+ec2TncdvXU1HvxFMuYxv088xvf8Rmf8P8mzZ9gH+2adYi5bsA9WMd5A3ixzrGp/kTARhfguDbq4HMh8AgL2E7AfmAJD8L/M1XwO7LzLJv78togpvLPQTzEvbzWGzJ7pdwlLSaecqxuyxhJ5BaKYqtkXArBA9k41ulUdlxlRRbYCU/xvAG80LOQ3U6Z/gbTcBcNhkP2pCiUj6i/C2BUnP+7qQY/g6ly3BKaDb+PU6Ytl7d5hPEG8An8CtmPKWNqTP/hVQ6JmsTr3BNzL1IN+nQutzV8KQXeJvwfEuC2bLQHqrY7L7u4zjCKr/iTf0/tINVgpQpe6GVufFPjayXg7+rgdK7rNnbx7RpvGf5edp811mOdd3Jdg2MVL7WJWq7OeFmrGLop/HboAtvUneYxMJW3AAAAAElFTkSuQmCC"/>
				<a class="monospace" href="https://github.com/borbasmatyas" target="_blank">@borbasmatyas</a>

				<svg class="repository" aria-hidden="true" height="16" viewBox="0 0 16 16" version="1.1" width="16" data-view-component="true">
					<path fill-rule="evenodd" d="M11.75 2.5a.75.75 0 100 1.5.75.75 0 000-1.5zm-2.25.75a2.25 2.25 0 113 2.122V6A2.5 2.5 0 0110 8.5H6a1 1 0 00-1 1v1.128a2.251 2.251 0 11-1.5 0V5.372a2.25 2.25 0 111.5 0v1.836A2.492 2.492 0 016 7h4a1 1 0 001-1v-.628A2.25 2.25 0 019.5 3.25zM4.25 12a.75.75 0 100 1.5.75.75 0 000-1.5zM3.5 3.25a.75.75 0 111.5 0 .75.75 0 01-1.5 0z"></path>
				</svg>
				<a class="monospace" href="https://github.com/borbasmatyas/mipf-program/tree/dev">mipf-program</a>

				


			</p>
			<p>
				A "Made in Pécs fesztivál" logó és név a fesztivál szervezőjének tulajdona.<br>
				<a href="https://madeinpecsfesztival.hu/" target="_blank">madeinpecsfesztival.hu</a>
			</p>


		</footer>

		<script src="/scripts/current-time.js"></script>
		<link rel="stylesheet" href="/styles/current-time.css?<?php echo date('U'); ?>">

		<script src="/scripts/past-events.js"></script>
		<link rel="stylesheet" href="/styles/past-events.css?<?php echo date('U'); ?>">

		<script src="/scripts/highlight.js"></script>
		<script src="/scripts/highlight-shared.js"></script>
		<link rel="stylesheet" href="/styles/highlight.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/highlight-shared.css?<?php echo date('U'); ?>">


		<script src="/scripts/canceled.js"></script>

	</body>
</html>