<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class Helper {
	
	public static function __callStatic($name, $arguments) {
		
		$registry=parse_ini_file(PATH_HELPERS.'.helpers',true);
		
		if(isset($registry['helper_registry'][$name])) {
			require_once(PATH_HELPERS.$registry['helper_registry'][$name]);
			return call_user_func_array($name,$arguments);
		} else trigger_error('Called helper method does not exist.',512);
	}
	
	public static function get_content_link($contentName) {
		
		$rel_link=ContentManager::getResourceLink($contentName);
		
		if($rel_link) return BASE_URI.$rel_link;
		else return $rel_link;
	}

	public static function add_view_component($componentName) {
		
		if(!isset($GLOBALS['view_registry'])) {
			$reg=parse_ini_file(PATH_VIEWS.'.views',true);
			$GLOBALS['view_registry']=$reg['view_registry'];
		}
		
		if(!isset($GLOBALS['view_registry'][$componentName])) return false;
		
		$path=$GLOBALS['view_registry'][$componentName];
		
		if(file_exists($path)) {
			require_once($path);
			return true;
		} else return false;
	}

	public static function add_dependancy($dependancyName) {
		
		$pathInfo=pathinfo($dependancyName);
		
		if(!isset($GLOBALS['view_config'])) $GLOBALS['view_config']=array('lib'=>array(),'scripts'=>array(),'styles'=>array());
		
		if(!isset($pathInfo['extension'])) {
			array_push($GLOBALS['view_config']['lib'],$dependancyName);
		} else if($pathInfo['extension']==='js') {
			array_push($GLOBALS['view_config']['scripts'],$dependancyName);
		} else if($pathInfo['extension']==='css') {
			array_push($GLOBALS['view_config']['styles'],$dependancyName);
		}
	}
	
	public static function set_complete_view()  {
		
		$GLOBALS['view_type']='complete';
	}
	
}

?>
