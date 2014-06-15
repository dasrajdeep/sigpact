<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class CacheManager {
	
	const CONTENT_TYPE_GRAPHICS = "GRAPHIC";
	const CONTENT_TYPE_SCRIPT = "SCRIPT";
	const CONTENT_TYPE_STYLESHEET = "STYLESHEET";
	const CONTENT_TYPE_FONT = "FONT";
	
	private static $cacheRegistry=array();
	
	private static $persistenceTime=1800;
	
	public static function init() {}
	
	public static function moveToCache($resourcePath) {
		
		$filename = pathinfo($resourcePath, PATHINFO_BASENAME);
		
		if(file_exists(PATH_CACHE.$filename)) {
			$modifyTime = filemtime($resourcePath);
			$copyTime = filemtime(PATH_CACHE.$filename);
			if($modifyTime >= $copyTime) copy($resourcePath, PATH_CACHE.$filename);
		} else {
			copy($resourcePath, PATH_CACHE.$filename);
		}
		
		self::$cacheRegistry[$filename]=time();
		
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
}

?>
