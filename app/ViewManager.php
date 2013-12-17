<?php

class ViewManager {
	
	public static function renderView($viewName,$view_vars=null) {
		
		global $path_views;
		
		$GLOBALS['view_type']='partial';
		
		$view_registry=parse_ini_file($path_views.'.views',true);
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
	
}

?>
