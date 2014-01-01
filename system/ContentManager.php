<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class ContentManager {
	
	private static $cache_location='cache/';
	
	/**
	 * One of:
	 * 1. proxy
	 * 2. legacy
	 * 3. cloudstore
	 */
	private static $cdn_type='';
	
	private static $cdn_proxy_suffix='';
	
	private static $cdn_legacy_url='';
	
	private static $cdn_cloud_url='';
	
	private static $contentTypes=array(
		'graphics'=>array('jpg','jpeg','png','gif','bmp','svg'),
		'stylesheets'=>array('css'),
		'scripts'=>array('js'),
		'fonts'=>array('eot','ttf','woff'),
		'all'=>array('jpg','jpeg','png','gif','bmp','svg','css','js','eot','ttf','woff')
	);
	
	public static function init() {
		
		self::$cdn_type=$GLOBALS['cdn_type'];
		self::$cdn_proxy_suffix=$GLOBALS['cdn_proxy_domain_suffix'];
		self::$cdn_legacy_url=$GLOBALS['cdn_legacy_base_url'];
		self::$cdn_cloud_url=$GLOBALS['cdn_cloud_base_url'];
	}
	
	public static function getResourceLink($resourceName) {
		
		$contentInfo=pathinfo($resourceName);
		
		if(!isset($contentInfo['extension'])) return '';
		
		$ext=$contentInfo['extension'];
		
		$resourceLink='';
		
		if(PRODUCTION && in_array($ext,self::$contentTypes['all'])) return self::generateCDNLink($resourceName);
		else if(!PRODUCTION && in_array($ext,self::$contentTypes['all'])) {
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
	
	private static function generateCDNLink($resourceName) {
		
		$url=parse_url(BASE_URI);
		
		if(self::$cdn_type==='proxy') {
			if(!self::$cdn_proxy_suffix) return BASE_URI.$resourceName;
			$domain=$url['host'].self::$cdn_proxy_suffix;
			return $url['scheme'].'://'.$domain.$url['path'].$resourceName; 
		} else if(self::$cdn_type==='legacy') {
			return self::$cdn_legacy_url.$resourceName;
		} else if(self::$cdn_type==='cloudstore') {
			return self::$cdn_cloud_url.$resourceName;
		}
	}
}

?>
