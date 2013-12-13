<?php
	
	require_once('bootstrap.php');
	require_once('globals.php');
	
	if(isset($_REQUEST['action'])) require_once('resolver.php');
	else require_once('container.php');

?>