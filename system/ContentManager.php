<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class ContentManager {
	
	private static $cache_location='cache/';
	
	private static $contentTypes=array(
		'graphics'=>array('jpg','jpeg','png','gif','bmp','svg'),
		'stylesheets'=>array('css'),
		'scripts'=>array('js'),
		'fonts'=>array('eot','ttf','woff'),
		'all'=>array('jpg','jpeg','png','gif','bmp','svg','css','js','eot','ttf','woff')
	);
	
	public static function init() {}
	
	public static function getResourceLink($resourceName) {
		
		$contentInfo=pathinfo($resourceName);
		
		if(!isset($contentInfo['extension'])) return '';
		
		$ext=$contentInfo['extension'];
		
		$resourceLink='';
		
		if(in_array($ext,self::$contentTypes['all'])) {
			if(in_array($ext,self::$contentTypes['graphics'])) {
				$resourceLink=Registry::lookupGraphics($resourceName);
			} else if(in_array($ext,self::$contentTypes['stylesheets'])) {
				$resourceLink=Registry::lookupStyle($resourceName);
			} else if(in_array($ext,self::$contentTypes['scripts'])) {
				$resourceLink=Registry::lookupScript($resourceName);
			} else if(in_array($ext,self::$contentTypes['fonts'])) {
				$resourceLink=PATH_FONTS.$resourceName;
			}
		}
		
		if($resourceLink && file_exists(BASE_DIR.$resourceLink)) {
			CacheManager::moveToCache($resourceName);
			$resourceLink=BASE_URI.self::$cache_location.$resourceName;
		} else if($resourceLink && !file_exists(BASE_DIR.$resourceLink)) $resourceLink='';
		
		return $resourceLink;
	}
	
	public static function serveContent($contentName) {
		
		global $vendor_content;
		
		$fileInfo=pathinfo($contentName);
		
		if(in_array($fileInfo['basename'],array_keys($vendor_content))) {
			header('Location: '.$vendor_content[$fileInfo['basename']]);
			return;
		}
		
		if(CacheManager::lookupCache($contentName)) $contentFound=true;
		else $contentFound=CacheManager::moveToCache($contentName);
		
		if($contentFound) header('Location: '.BASE_URI.self::$cache_location.$contentName);
		else header('HTTP/1.1 404 Not Found');
	}
}

?>
