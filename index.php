<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

?><!doctype html>
<html class="no-js" lang="hu">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex, nofollow, noarchive">
		<link rel="manifest" href="/manifest.json">
		<link rel="apple-touch-icon" href="/images/icons/apple-touch-icon.png">
		<link rel="stylesheet" href="/styles/main.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/program.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/css-grid-template.php?<?php echo date('U'); ?>">

		<title>Program - Made in Pécs Fesztivál</title>
	</head>
	<body>
		<header>
			<img class="mipf-logo" 
				src="https://madeinpecsfesztival.hu/wp-content/themes/mipf-child/assets/images/made-in-pecs-fesztival-logo-purple.svg" 
				data-src="https://madeinpecsfesztival.hu/wp-content/themes/mipf-child/assets/images/made-in-pecs-fesztival-logo-purple.svg" 
				alt="Made in Pécs Fesztivál">
		</header>

	


		<main>
			<?php include($_SERVER['DOCUMENT_ROOT'] . '/src/kanban.php'); ?>
		</main>
		<footer>

			<!--p>
				<a href="/sharing.php" class="monospace">Események megosztása</a> 
				
			</p-->

			<button id="toggleHighlighted" class="highlight-toggle">Kiemelt események megjelenítése</button>

			<p>
				A "Made in Pécs fesztivál" logó és név, valamint a betűtípus a fesztivál szervezőjének tulajdona.<br>
				<a href="https://madeinpecsfesztival.hu/" target="_blank">madeinpecsfesztival.hu</a>
			</p>

			<p>
				Ez az oldal személyes célra készült, azaz nem a Made in Pécs fesztivál hivatalos weboldala, de szabadon bárki használhatja.
				Az adatok forrása a madeinpecsfesztival.hu webhelyen található program.
				A megjelenített programok pontosságáért sem az oldal készítője, sem a fesztivál szervezői nem vállalnak felelősséget.
			</p>
			<p>
				Az oldal működéséhez kizárólag az események kiemeléséhez és a megosztott események megjelenítéséhez szükséges sütiket használ, 
				amelyek élettartama 10 nap. Az oldal használatával elfogadod ezeknek a sütiknek a használatát. 
				Az oldalon semmilyen statisztikai adatgyűjtés, profilalkotás vagy követőkód alkalmazása nem történik, és adatkezelés sem valósul meg.
			</p>

			<?php include($_SERVER['DOCUMENT_ROOT'] . '/src/dev-footer.php'); ?>

		</footer>

		


		<script src="/scripts/cookies.js"></script>
		<script src="/scripts/current-time.js"></script>
		<link rel="stylesheet" href="/styles/current-time.css?<?php echo date('U'); ?>">

		<script src="/scripts/past-events.js"></script>
		<link rel="stylesheet" href="/styles/past-events.css?<?php echo date('U'); ?>">

		<script src="/scripts/highlight.js"></script>
		<script src="/scripts/highlight-shared.js"></script>
		<link rel="stylesheet" href="/styles/highlight.css?<?php echo date('U'); ?>">
		<link rel="stylesheet" href="/styles/highlight-shared.css?<?php echo date('U'); ?>">

		<link rel="stylesheet" href="/styles/toggle-filter.css?<?php echo date('U'); ?>">
		<script src="/scripts/toggle-filter.js"></script>

		<script src="/scripts/canceled.js"></script>

	</body>
</html>
