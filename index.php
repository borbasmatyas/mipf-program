<!doctype html>
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
		<link rel="stylesheet" href="/styles/repo-footer.css?<?php echo date('U'); ?>">

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
			<?php include($_SERVER['DOCUMENT_ROOT'] . '/kanban.php'); ?>
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

			<div class="repo-footer-links">

                    <!-- GitHub user link -->
                    <a href="https://github.com/borbasmatyas" target="_blank" rel="noopener noreferrer" title="Borbás Mátyás" class="repo-footer-link-item">
                        <svg aria-hidden="true" height="18" viewBox="0 0 24 24" version="1.1" width="18" data-view-component="true" fill="currentColor">
                            <path d="M12 1C5.923 1 1 5.923 1 12c0 4.867 3.149 8.979 7.521 10.436.55.096.756-.233.756-.522 0-.262-.013-1.128-.013-2.049-2.764.509-3.479-.674-3.699-1.292-.124-.317-.66-1.293-1.127-1.554-.385-.207-.936-.715-.014-.729.866-.014 1.485.797 1.691 1.128.99 1.663 2.571 1.196 3.204.907.096-.715.385-1.196.701-1.471-2.448-.275-5.005-1.224-5.005-5.432 0-1.196.426-2.186 1.128-2.956-.111-.275-.496-1.402.11-2.915 0 0 .921-.288 3.024 1.128a10.193 10.193 0 0 1 2.75-.371c.936 0 1.871.123 2.75.371 2.104-1.43 3.025-1.128 3.025-1.128.605 1.513.221 2.64.111 2.915.701.77 1.127 1.747 1.127 2.956 0 4.222-2.571 5.157-5.019 5.432.399.344.743 1.004.743 2.035 0 1.471-.014 2.654-.014 3.025 0 .289.206.632.756.522C19.851 20.979 23 16.854 23 12c0-6.077-4.922-11-11-11Z"></path>
                        </svg>
                        <span>@borbasmatyas</span>
                    </a>

                    <a href="https://github.com/borbasmatyas/mipf-program" target="_blank" rel="noopener noreferrer" title="time-tracker" class="repo-footer-link-item">
                        <svg aria-hidden="true" height="18" viewBox="0 0 16 16" version="1.1" width="18" data-view-component="true" fill="currentColor">
                            <path d="M2 2.5A2.5 2.5 0 0 1 4.5 0h8.75a.75.75 0 0 1 .75.75v12.5a.75.75 0 0 1-.75.75h-2.5a.75.75 0 0 1 0-1.5h1.75v-2h-8a1 1 0 0 0-.714 1.7.75.75 0 1 1-1.072 1.05A2.495 2.495 0 0 1 2 11.5Zm10.5-1h-8a1 1 0 0 0-1 1v6.708A2.486 2.486 0 0 1 4.5 9h8ZM5 12.25a.25.25 0 0 1 .25-.25h3.5a.25.25 0 0 1 .25.25v3.25a.25.25 0 0 1-.4.2l-1.45-1.087a.249.249 0 0 0-.3 0L5.4 15.7a.25.25 0 0 1-.4-.2Z"></path>
                        </svg>
                        <span>mipf-program</span>
                    </a>

					<?php
						// Branch neve (ha van .git könyvtár)
						$branchName = false;
						if (is_dir(__DIR__ . '/.git')) {
							$headFile = file_get_contents(__DIR__ . '/.git/HEAD');
							if (preg_match('/ref: refs\/heads\/(.+)/', $headFile, $matches)) {
								$branchName = $matches[1];
							}
						}

						if ($branchName):

					?>
					<a href="https://github.com/borbasmatyas/mipf-program/tree/<?php echo urlencode($branchName); ?>" target="_blank" rel="noopener noreferrer" title="Aktuális ág: <?php echo htmlspecialchars($branchName); ?>" class="repo-footer-link-item">
						<svg aria-hidden="true" focusable="false" class="octicon octicon-git-branch" viewBox="0 0 16 16" width="16" height="16" fill="currentColor" display="inline-block" overflow="visible" style="vertical-align:text-bottom">
							<path d="M9.5 3.25a2.25 2.25 0 1 1 3 2.122V6A2.5 2.5 0 0 1 10 8.5H6a1 1 0 0 0-1 1v1.128a2.251 2.251 0 1 1-1.5 0V5.372a2.25 2.25 0 1 1 1.5 0v1.836A2.493 2.493 0 0 1 6 7h4a1 1 0 0 0 1-1v-.628A2.25 2.25 0 0 1 9.5 3.25Zm-6 0a.75.75 0 1 0 1.5 0 .75.75 0 0 0-1.5 0Zm8.25-.75a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM4.25 12a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5Z">
							</path>
						</svg>
						<span class="repo-footer-link-item"><?php echo htmlspecialchars($branchName); ?></span>
					</a>
					<?php
						endif;
					?>

				<a href="/data-source/program-json.php" target="_blank" rel="noopener noreferrer" title="time-tracker" class="repo-footer-link-item">
                    <svg aria-hidden="true" height="18" viewBox="0 0 24 24" width="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<path d="M9 4c-2 0-3 1-3 3v2c0 1-1 2-2 2 1 0 2 1 2 2v2c0 2 1 3 3 3"/>
						<path d="M15 4c2 0 3 1 3 3v2c0 1 1 2 2 2-1 0-2 1-2 2v2c0 2-1 3-3 3"/>
					</svg>
					<span>Adatforrás (JSON)</span>
				</a>

			</div>


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
