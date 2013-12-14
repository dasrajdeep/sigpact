<?php
	
	require_once('app/ContentManager.php');
	
	$manager=new ContentManager();
	
	$manager->serveContent($info['basename']);
	
	die();

?>
