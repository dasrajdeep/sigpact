<?php

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
	
	$mailer = new Mailer();
	
	echo "Mail spool flusher service started.\n";
	
	while(true) {
		
		sleep(10);
		
		$mailer->sendSpooledMails();
	}

?>