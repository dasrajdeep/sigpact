<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	require_once('core/errorhandler.php');
	
	set_error_handler('global_error_handler');
	
	require_once('core/globals.php');
	require_once('core/autoload.php');
	require_once('core/common.php');
	require_once('core/resolver.php');
	require_once('vendor/autoload.php');
	
	spl_autoload_register('load_system');
	spl_autoload_register('load_module');
	spl_autoload_register('load_controller');
	spl_autoload_register('load_redbean');
	
	register_shutdown_function('shutdown_system');

	if(!PRODUCTION) build_view_registry();
	if(!PRODUCTION) build_helper_registry();
	if(!PRODUCTION) build_library_registry();
	
?>
