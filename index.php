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
				
			</p>

			<p>
				A "Made in Pécs fesztivál" logó és név, valamint a betűtípus a fesztivál szervezőjének tulajdona.<br>
				<a href="https://madeinpecsfesztival.hu/" target="_blank">madeinpecsfesztival.hu</a>
			</p>

			<p>
				<a href="/data-source/program-json.php" class="monospace">Adatforrás (JSON)</a>
			</p>

			<div class="tech-info">
				<p>
					<img class="invertocat" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAABmJLR0QA/wD/AP+gvaeTAAABeklEQVRIidXUPU8VURSF4YeLgIQES0JhQSeQGPA3mChfkQgVhR1/g4QQNVJaameorCy0sLO2JRAQOoNKTEhosJJLMTO5w+YMM5eOlZzcj73Wu+ec2TncdvXU1HvxFMuYxv088xvf8Rmf8P8mzZ9gH+2adYi5bsA9WMd5A3ixzrGp/kTARhfguDbq4HMh8AgL2E7AfmAJD8L/M1XwO7LzLJv78togpvLPQTzEvbzWGzJ7pdwlLSaecqxuyxhJ5BaKYqtkXArBA9k41ulUdlxlRRbYCU/xvAG80LOQ3U6Z/gbTcBcNhkP2pCiUj6i/C2BUnP+7qQY/g6ly3BKaDb+PU6Ytl7d5hPEG8An8CtmPKWNqTP/hVQ6JmsTr3BNzL1IN+nQutzV8KQXeJvwfEuC2bLQHqrY7L7u4zjCKr/iTf0/tINVgpQpe6GVufFPjayXg7+rgdK7rNnbx7RpvGf5edp811mOdd3Jdg2MVL7WJWq7OeFmrGLop/HboAtvUneYxMJW3AAAAAElFTkSuQmCC"/>
					<a class="monospace" href="https://github.com/borbasmatyas" target="_blank">@borbasmatyas</a>
				</p>
			</div>

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