<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class CacheManager {
	
	private static $cacheRegistry;
	
	public static function init() {}
	
	public static function moveToCache($filePath) {}
		
	public static function removeFromCache($fileName) {}
	
	public static function lookupCache($fileName) {}
	
	public static function removeOldItems() {}
	
}

?>
