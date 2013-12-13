<?php
	
	$action=$_REQUEST['action'];
	
	if($action) {
		if($action==='loadview') {
			if(!isset($_REQUEST['view_name'])) die('view name not specified');
			$viewName=$_REQUEST['view_name'].'.php';
			if(!file_exists('views/'.$viewName)) die('specified view does not exist');
			require_once('views/'.$viewName);
		} else if($action==='loadstyle') {
			if(!isset($_REQUEST['style_name'])) die('style name not specified');
			$styleName=$_REQUEST['style_name'].'.css';
			if(!file_exists('stylesheets/'.$styleName)) die('specified stylesheet does not exist');
			header('Location: stylesheets/'.$styleName);
		} else if($action==='loadscript') {
			if(!isset($_REQUEST['script_name'])) die('script name not specified');
			$scriptName=$_REQUEST['script_name'].'.js';
			if(!file_exists('scripts/'.$scriptName)) die('specified script does not exist');
			header('Location: scripts/'.$scriptName);
		} else {
			echo 'invalid command';
		}
	} else die('invalid command');

?>