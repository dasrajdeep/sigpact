<?php
	
	define('DS',DIRECTORY_SEPARATOR);

	ini_set('display_errors',false);

	session_start();
	
	require_once('bootstrap.php');
	require_once('globals.php');
	
	if(isset($_REQUEST['action'])) require_once('resolver.php');
	else require_once('container.php');

?>