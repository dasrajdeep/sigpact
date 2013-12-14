<?php

class Registry {
	
	/**
		Contains registry entries of the form:
		(<media_name>,<media_url>)
	*/
	private static $multimedia_registry=array();
	
	/**
		Contains registry entries of the form:
		(<script_name>,<script_path>)
	*/
	private static $script_registry=array();
	
	/**
		Contains registry entries of the form:
		(<style_name>,<style_path>)
	*/
	private static $style_registry=array();
	
	/**
		Contains registry entries of the form:
		(<graphics_name>,<graphics_path>)
	*/
	private static $graphics_registry=array();
	
	/**
		Contains registry entries of the form:
		(<controller_name>,<method_name>)
	*/
	private static $rpc_registry=array();
	
	public static function loadRegistry() {
		
		$config_app=parse_ini_file('app/app.ini',true);
		$config_content=parse_ini_file('app/content.ini',true);
		
		$routes=$config_app['routes'];
		
		foreach(array_keys($routes) as $command) {
			$routeConfig=$routes[$command];
			$routeConfig=explode(':',$routeConfig);
			self::$rpc_registry[$command]=array($routeConfig[0],$routeConfig[1]);
		}
		
		self::$style_registry=$config_content['stylesheets'];
		self::$script_registry=$config_content['scripts'];
		self::$graphics_registry=$config_content['graphics'];
		self::$multimedia_registry=$config_content['multimedia'];
	}
	
	public static function lookupRPC($rpcName) {
	
		if(isset(self::$rpc_registry[$rpcName])) return self::$rpc_registry[$rpcName];
		else return null;
	}
	
	public static function lookupGraphics($graphicsName) {
		
		if(isset(self::$graphics_registry[$graphicsName])) return self::$graphics_registry[$graphicsName];
		else return null;
	}
	
	public static function lookupStyle($stylesheetName) {
	
		if(isset(self::$style_registry[$stylesheetName])) return self::$style_registry[$stylesheetName];
		else return null;
	}
	
	public static function lookupScript($scriptName) {
	
		if(isset(self::$script_registry[$scriptName])) return self::$script_registry[$scriptName];
		else return null;
	}
 	
	public static function lookupMultimedia($mediaName) {
	
		if(isset(self::$multimedia_registry[$mediaName])) return self::$multimedia_registry[$mediaName];
		else return null;
	}
	
}

?>
