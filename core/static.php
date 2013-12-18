<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	require_once('app/ContentManager.php');
	
	$manager=new ContentManager();
	
	$manager->serveContent($info['basename']);
	
	die();

?>
