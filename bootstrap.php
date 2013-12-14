<?php

function build_view_registry() {
	
	global $path_views;
	
	$dir_listing=scandir($path_views);
	
	$registry_file=$path_views.'.views';
	
	$view_registry="[view_registry]\n\n";
	
	foreach($dir_listing as $entry) {
		if(is_file($path_views.$entry) || $entry==='.' || $entry==='..') continue;
		$view_files=scandir($path_views.$entry);
		foreach($view_files as $file) if(strpos($file,'.php')>0) $view_registry.=sprintf("%s=%s/%s\n",substr($file,0,strpos($file,'.php')),$path_views.$entry,$file);
	}
	
	file_put_contents($registry_file,$view_registry);
}

function load_module($moduleName) {
	
	$moduleFile=$moduleName.'.php';
	
	$path=$GLOBALS['path_modules'].$moduleFile;
	
	require_once($path);
}

function add_image_link($imageFileName) {
	
	$path=$GLOBALS['path_graphics'].$imageFileName;
	
	if(file_exists($path)) echo $path;
	else if(Registry::lookupGraphics($imageFileName)) echo Registry::lookupGraphics($imageFileName);
	else echo ''; // To be replaced by broken content inline image.
}

function get_image_link($imageFileName) {
	
	$path=$GLOBALS['path_graphics'].$imageFileName;
	
	if(file_exists($path)) return $path;
	else if(Registry::lookupGraphics($imageFileName)) return Registry::lookupGraphics($imageFileName);
	else return ''; 
}

function get_script_link($scriptFileName) {
	
	$path=$GLOBALS['path_scripts'].$scriptFileName;
	
	if(file_exists($path)) return $path;
	else if(Registry::lookupScript($scriptFileName)) return Registry::lookupScript($scriptFileName);
	else return '';
}

function get_style_link($stylesheetFileName) {
	
	$path=$GLOBALS['path_styles'].$stylesheetFileName;
	
	if(file_exists($path)) return $path;
	else if(Registry::lookupStyle($stylesheetFileName)) return Registry::lookupStyle($stylesheetFileName);
	else return '';
}

function add_view_component($componentName) {
	
	if(!isset($GLOBALS['view_registry'])) {
		$reg=parse_ini_file($GLOBALS['path_views'].'.views');
		$GLOBALS['view_registry']=$reg['view_registry'];
	}
	
	if(!isset($GLOBALS['view_registry'][$componentName])) return false;
	
	$path=$GLOBALS['view_registry'][$componentName];
	
	if(file_exists($path)) {
		require_once($path);
		return true;
	} else return false;
}

function addDependancy($dependancyName) {
	
	$fileNameParts=explode('.',$dependancyName);
	$fileNameParts=array_filter($fileNameParts);
	
	$ext=$fileNameParts[count($fileNameParts)-1];
	
	if($ext==='js') {
		echo sprintf('<script type="text/javascript" src="%s"></script>',get_script_link($dependancyName));
	} else if($ext==='css') {
		echo sprintf('<link rel="stylesheet/css" href="%s" />',get_style_link($dependancyName));
	}
}

?>
