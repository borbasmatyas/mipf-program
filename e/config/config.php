<?php


/** PHP hibakijelzés
 * 
 * Bővebben: https://www.php.net/manual/en/errorfunc.configuration.php
 *
 */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);


ini_set("session.cookie_secure", 1);

/** Title
 * 
 * Az oldal neve
 * 
 */
$title = "Made in Pécs fesztivál program";


/** REDIRECT_URL
 * 
 * Elutasított hozzáférés esetén ide irányítja a látogatót.
 * 
 * Formátum: https://valami.hu
 * 
 */
define("REDIRECT_URL", "https://do.borbasmatyas.hu");


/** ParseURI / URI_IGNORE
 * 
 * Az URI elejének figyelmenkívülhagyása, ha szükséges
 * Bővebben: /e/modules/parse_uri/README.md
 * 
 */
define("URI_IGNORE", 0);




$magyar_napok=array(
	0 => 'vasárnap',
	1 => 'hétfő',
	2 => 'kedd',
	3 => 'szerda',
	4 =>'csütörtök',
	5 => 'péntek',
	6 => 'szombat'
);

$magyar_honapok=array(
	'01' => 'január',
	'02' => 'február',
	'03' => 'március',
	'04' => 'április',
	'05' => 'május',
	'06' => 'június',
	'07' => 'július',
	'08' => 'augusztus',
	'09' => 'szeptember',
	'10' => 'október',
	'11' => 'november',
	'12' => 'december'
);


?>