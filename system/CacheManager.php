<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class CacheManager {
	
	private static $cacheRegistry=array();
	
	private static $persistenceTime=1800;
	
	public static function init() {}
	
	public static function moveToCache($resourceName) {
		
		if(self::getResourceType($resourceName)==='graphics') {
			$filePath=Registry::lookupGraphics($resourceName);
		} else if(self::getResourceType($resourceName)==='stylesheet') {
			$filePath=Registry::lookupStyle($resourceName);
		} else if(self::getResourceType($resourceName)==='script') {
			$filePath=Registry::lookupScript($resourceName);
		} else $filePath=null;
		
		if(!$filePath) return false;
		
		$info=pathinfo($filePath);
		
		if(file_exists(PATH_CACHE.$info['basename'])) {
			$modifyTime=filemtime($filePath);
			$copyTime=filemtime(PATH_CACHE.$info['basename']);
			if($modifyTime>$copyTime) copy($filePath,PATH_CACHE.$info['basename']);
		} else {
			copy($filePath,PATH_CACHE.$info['basename']);
		}
		
		self::$cacheRegistry[$resourceName]=time();
		
		return true;
	}
		
	public static function removeFromCache($fileName) {
	
		if(file_exists(PATH_CACHE.$fileName)) unlink(PATH_CACHE.$fileName);
		
	}
	
	public static function lookupCache($fileName) {
	
		if(file_exists(PATH_CACHE.$fileName)) return PATH_CACHE.$fileName;
		else return null;
		
	}
	
	public static function removeOldItems() {
		
		$allowedAge=time()-self::$persistenceTime;
		
		foreach(array_keys(self::$cacheRegistry) as $resource) if(self::$cacheRegistry[$resource]<$allowedAge) unset(self::$cacheRegistry[$resource]);
	}
	
	public static function writeRegistry() {
		
		$regFileData='';
		
		foreach(array_keys(self::$cacheRegistry) as $resource) $regFileData=$resource.','.self::$cacheRegistry[$resource]."\n";
		
		file_put_contents(PATH_CACHE.'.cache',$regFileData);
	}
	
	private static function getResourceType($resourceName) {
	
		$info=pathinfo($resourceName);
		
		if(in_array($info['extension'],array('jpg','jpeg','png','gif','bmp','svg'))) return 'graphics';
		else if($info['extension']==='css') return 'stylesheet';
		else if($info['extension']==='js') return 'script';
		else return 'unknown';
	}
}

?>
