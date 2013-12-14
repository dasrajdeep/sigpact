<?php

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

	$path=$GLOBALS['path_views'].$componentName.'.php';
	
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