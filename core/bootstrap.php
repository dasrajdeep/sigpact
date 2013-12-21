<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	require_once('core/errorhandler.php');
	
	set_error_handler('global_error_handler');
	
	require_once('core/globals.php');
	require_once('core/audit.php');
	require_once('core/autoload.php');
	require_once('core/registry.php');
	require_once('core/common.php');
	require_once('core/helpers.php');
	require_once('core/resolver.php');
	
	spl_autoload_register('load_system');
	spl_autoload_register('load_module');
	spl_autoload_register('load_bean');
	spl_autoload_register('load_controller');
	
	register_shutdown_function('shutdown_system');

	if(!PRODUCTION) build_view_registry();
	
	require_once($GLOBALS['php_libraries']['redbean'][0]);
	
	$db_host=Registry::lookupConfig('database_host');
	$db_user=Registry::lookupConfig('database_username');
	$db_pass=Registry::lookupConfig('database_password');
	$db_name=Registry::lookupConfig('database_name');
	
	R::setup(sprintf('mysql:host=%s;dbname=%s',$db_host,$db_name),$db_user,$db_pass);
	
?>
