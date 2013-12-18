<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	require_once('core/errorhandler.php');
	
	set_error_handler('global_error_handler');
	
	require_once('core/globals.php');
	require_once('core/audit.php');
	require_once('core/registry.php');
	require_once('core/common.php');
	require_once('core/helpers.php');
	require_once('core/resolver.php');
	
	require_once('app/Registry.php');
	require_once('app/Session.php');
	
	Registry::loadRegistry();

	if(!PRODUCTION) build_view_registry();
	
?>
