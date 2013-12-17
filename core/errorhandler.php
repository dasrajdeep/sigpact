<?php

function global_error_handler($error_level,$error_message,$error_file,$error_line,$error_context) {
	
	if(!file_exists('errors.log')) file_put_contents('errors.log','');
	
	$log_message='';
	
	if($error_level==1) $log_message='[PHP_ERROR]';
	else if($error_level==2) $log_message='[PHP_WARNING]';
	else if($error_level==4) $log_message='[PHP_PARSE]';
	else if($error_level==8) $log_message='[PHP_NOTICE]';
	else if($error_level==256) $log_message='[APP_ERROR]';
	else if($error_level==512) $log_message='[APP_WARNING]';
	else if($error_level==1024) $log_message='[APP_NOTICE]';
	
	$log_message.=sprintf(' "%s" (on file %s at line %s)',$error_message,$error_file,$error_line);
	
	error_log($log_message,3,'errors.log');
	
	die('An error occurred. Could not continue.');
}

?>
