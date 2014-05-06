<?php
	
	/*
	 * ======================================================
	 * 						BOOT SCRIPT
	 * ======================================================
	 */
	
	$mode = php_sapi_name();
	
	if($mode !== 'cli') {
		die('YOU ARE NOT ALLOWED TO ACCESS THIS RESOURCE');
	}
	
	define('SYSTEM_STARTED', TRUE);
	
	require_once('app/environment.php');
	
	setlocale(LC_ALL,$env_locale);
	date_default_timezone_set($env_time_zone);
	
	require_once('core/bootstrap.php');
	
	$app_config = parse_ini_file('app/app.ini');
	
	$db_host = $app_config['database_host'];
	$db_name = $app_config['database_name'];
	$db_user = $app_config['database_username'];
	$db_pass = $app_config['database_password'];
	
	R::setup(sprintf('mysql:host=%s;dbname=%s',$db_host,$db_name),$db_user,$db_pass);

	/*
	 * ===============================================================================
	 * 								CUSTOM TEST SCRIPT
	 * ===============================================================================
	 */
	 
	$meeting = new Meeting();
	
	$dataset = R::getAll('SELECT email FROM account');
	
	print_r($dataset);
?>