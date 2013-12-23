<?php

function load_module($class_name) {
	
	$file_name=PATH_MODULES.$class_name.'.php';
	
	if(is_readable($file_name)) {
		require_once($file_name);
		if(method_exists($class_name,'init')) $class_name::init();
	}
}

function load_system($class_name) {
	
	$file_name=PATH_SYSTEM.$class_name.'.php';
	
	if(is_readable($file_name)) {
		require_once($file_name);
		if(method_exists($class_name,'init')) $class_name::init();
	}
}

function load_controller($class_name) {
	
	$file_name=PATH_CONTROLLERS.$class_name.'.php';
	
	if(is_readable($file_name)) {
		require_once($file_name);
		if(method_exists($class_name,'init')) $class_name::init();
	}
}

function _load_redbean($class_name) {
	
	if($class_name!=='R') return;
	
	$class_path=$GLOBALS['php_libraries']['redbean'][0];
	
	require_once($class_path);
	
	$db_host=Registry::lookupConfig('database_host');
	$db_user=Registry::lookupConfig('database_username');
	$db_pass=Registry::lookupConfig('database_password');
	$db_name=Registry::lookupConfig('database_name');
	
	R::setup(sprintf('mysql:host=%s;dbname=%s',$db_host,$db_name),$db_user,$db_pass);
}

?>