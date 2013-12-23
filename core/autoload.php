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

?>
