<?php
	
	function get_content_link($contentName) {
		
		if(!isset($GLOBALS['content_manager'])) $GLOBALS['content_manager']=new ContentManager();
		
		$rel_link=$GLOBALS['content_manager'].getResourceLink($contentName);
		
		if($rel_link) return $GLOBALS['rootPath'].$rel_link;
		else return $rel_link;
	}

	function add_view_component($componentName) {
		
		if(!isset($GLOBALS['view_registry'])) {
			$reg=parse_ini_file($GLOBALS['path_views'].'.views',true);
			$GLOBALS['view_registry']=$reg['view_registry'];
		}
		
		if(!isset($GLOBALS['view_registry'][$componentName])) return false;
		
		$path=$GLOBALS['view_registry'][$componentName];
		
		if(file_exists($path)) {
			require_once($path);
			return true;
		} else return false;
	}

	function add_dependancy($dependancyName) {
		
		$pathInfo=pathinfo($dependancyName);
		
		if(!isset($GLOBALS['view_config'])) $GLOBALS['view_config']=array('lib'=>array(),'scripts'=>array(),'styles'=>array(),'vars'=>array());
		
		if(!isset($pathInfo['extension'])) {
			array_push($GLOBALS['view_config']['lib'],$dependancyName);
		} else if($pathInfo['extension']==='js') {
			array_push($GLOBALS['view_config']['scripts'],$dependancyName);
		} else if($pathInfo['extension']==='css') {
			array_push($GLOBALS['view_config']['styles'],$dependancyName);
		}
	}
	
	function set_complete_view()  {
		
		$GLOBALS['view_type']='complete';
	}

?>
