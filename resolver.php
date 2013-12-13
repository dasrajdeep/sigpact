<?php
	
	$action=$_REQUEST['action'];
	
	$view_path='app/views/';
	$script_path='app/scripts/';
	$style_path='app/styles/';
	
	if($action) {
		if($action==='loadview') {
			if(!isset($_REQUEST['view_name'])) die('view name not specified');
			$viewName=$_REQUEST['view_name'].'.php';
			if(!file_exists($view_path.$viewName)) die('specified view does not exist');
			require_once($view_path.$viewName);
		} else if($action==='loadstyle') {
			if(!isset($_REQUEST['style_name'])) die('style name not specified');
			$styleName=$_REQUEST['style_name'].'.css';
			if(!file_exists($style_path.$styleName)) die('specified stylesheet does not exist');
			header('Location: '.$style_path.$styleName);
		} else if($action==='loadscript') {
			if(!isset($_REQUEST['script_name'])) die('script name not specified');
			$scriptName=$_REQUEST['script_name'].'.js';
			if(!file_exists($script_path.$scriptName)) die('specified script does not exist');
			header('Location: '.$script_path.$scriptName);
		} else if($action==='loadimage') {
			//To be defined.
		} else if($action==='rpc') {
			//To be defined.
		} else {
			echo 'invalid command';
		}
	} else die('invalid command');

?>