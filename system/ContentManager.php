<?php

class ContentManager {
	
	private static $cache_location='cache/';
	
	private static $cdn_url='';
	
	private static $contentTypes=array(
		'graphics'=>array('jpg','jpeg','png','gif','bmp','svg'),
		'stylesheets'=>array('css'),
		'scripts'=>array('js'),
		'fonts'=>array('eot','ttf','woff')
	);
	
	public static function getResourceLink($resourceName) {
		
		$contentInfo=pathinfo($resourceName);
		
		if(!isset($contentInfo['extension'])) return '';
		
		$ext=$contentInfo['extension'];
		
		if(in_array($ext,self::$contentTypes['graphics'])) {
			if($GLOBALS['production']) return self::$cdn_url.'graphics/'.$resourceName;
			else return Registry::lookupGraphics($resourceName);
		} else if(in_array($ext,self::$contentTypes['stylesheets'])) {
			if($GLOBALS['production']) return self::$cdn_url.'stylesheets/'.$resourceName;
			else return Registry::lookupStyle($resourceName);
		} else if(in_array($ext,self::$contentTypes['scripts'])) {
			if($GLOBALS['production']) return self::$cdn_url.'scripts/'.$resourceName;
			else return Registry::lookupScript($resourceName);
		} else if(in_array($ext,self::$contentTypes['fonts'])) {
			if($GLOBALS['production']) return self::$cdn_url.'fonts/'.$resourceName;
			else return BASE_URI.PATH_FONTS.$resourceName;
		} else return '';
	}
	
	public static function serveContent($contentName) {
		
		global $vendor_content;
		
		$fileInfo=pathinfo($contentName);
		
		if(in_array($fileInfo['basename'],array_keys($vendor_content))) {
			header('Location: '.$vendor_content[$fileInfo['basename']]);
			return;
		}
		
		$contentFound=true;
		
		if(!file_exists(self::$cache_location.$contentName)) {
			$location=self::getResourceLink($contentName);
			if($location && file_exists($location)) copy($location,self::$cache_location.$contentName);
			else $contentFound=false; 
		}
		
		if($contentFound) header('Location: '.BASE_URI.self::$cache_location.$contentName);
		else header('HTTP/1.1 404 Not Found');
	}
	
}

?>
