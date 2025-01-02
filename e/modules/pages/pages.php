<?php
$pages_dir = './e/pages/';
$_SERVER['REQUEST_URI_PATH'] = preg_replace('/\?.*/', '', $_SERVER['REQUEST_URI']);
$segments = array_slice (explode('/', trim($_SERVER['REQUEST_URI_PATH'], '/')), URI_IGNORE);
$page['name'] = !empty( $segments[0] ) ? $segments[0] : 'home';
$page['file'] = $pages_dir . $page['name'] . '.php';
$page['segments'] = $segments;


if( !file_exists($page['file']) and $page['name'] != 'kilepes' ):
  header('Location: /hiba/404');
  exit;
endif;

?>