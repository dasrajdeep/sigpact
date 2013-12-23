<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class ViewManager {
	
	public static function renderView($viewName,$view_vars=null) {
		
		$GLOBALS['view_type']='partial';
		
		$view_registry=parse_ini_file(PATH_VIEWS.'.views',true);
		$view_registry=$view_registry['view_registry'];
		
		if(isset($view_registry[$viewName])) {
			ob_start();
			require_once($view_registry[$viewName]);
			$html_body=ob_get_clean();
			
			if(!isset($GLOBALS['view_config'])) $GLOBALS['view_config']=array('lib'=>array(),'scripts'=>array(),'styles'=>array());
			
			if($GLOBALS['view_type']==='complete') require_once('core/container.php');
			else echo $html_body;
			
			return true;
		} else return false;
	}
	
	public static function add_libraries() {
		
		global $libraries;
		
		$libraryNames=array('jquery');
		
		if(isset($GLOBALS['view_config'])) $libraryNames=array_merge($libraryNames,$GLOBALS['view_config']['lib']);
		
		foreach($libraryNames as $lib) {
			if(isset($libraries[$lib])) {
				$lib_link=$libraries[$lib];
				
				if(PRODUCTION) $lib_link=$lib_link['cdn'];
				else $lib_link=$lib_link['local'];
				
				foreach($lib_link as $link) {
					$info=pathinfo($link);
					if($info['extension']==='js') echo sprintf('<script type="text/javascript" src="%s"></script>',$link);
					else if($info['extension']==='css') echo sprintf('<link rel="stylesheet" href="%s" />',$link);
				}
			}
		}
	}
	
	public static function add_dependancies() {
		
		if(!isset($GLOBALS['view_config'])) return;
		
		$view_config=$GLOBALS['view_config'];
		
		foreach($view_config['styles'] as $dep) {
			
			$resourceLink=ContentManager::getResourceLink($dep);
			
			echo sprintf('<link rel="stylesheet" href="%s" />',$resourceLink);
		}
		
		foreach($view_config['scripts'] as $dep) {
			
			$resourceLink=ContentManager::getResourceLink($dep);
			
			echo sprintf('<script type="text/javascript" src="%s"></script>',$resourceLink);
		}
	}
	
	public static function add_bootscript() {
		
		$bootScript="
			var baseURI='%s';
		";
		
		$bootScript=sprintf($bootScript,BASE_URI);
		
		echo sprintf('<script type="text/javascript">%s</script>',$bootScript);
	}
	
}

?>
