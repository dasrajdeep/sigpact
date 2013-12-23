<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	ContentManager::serveContent($info['basename']);
	
	die();

?>
