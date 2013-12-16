<?php

class Registry {
	
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
	
	/**
	 * Contains registry entries of the form:
	 * <key>=<value>
	 */
	private static $app_config=array();
	
	public static function loadRegistry() {
		
		$config_app=parse_ini_file('app/app.ini',true);
		$config_content=parse_ini_file('app/content.ini',true);
		
		$routes=$config_app['routes'];
		
		foreach(array_keys($routes) as $command) {
			$routeConfig=$routes[$command];
			$routeConfig=explode(':',$routeConfig);
			self::$rpc_registry[$command]=array($routeConfig[0],$routeConfig[1]);
		}
		
		self::$app_config=$config_app['config'];
		
		self::$style_registry=$config_content['stylesheets'];
		self::$script_registry=$config_content['scripts'];
		self::$graphics_registry=$config_content['graphics'];
	}
	
	public static function lookupRPC($rpcName) {
	
		if(isset(self::$rpc_registry[$rpcName])) return self::$rpc_registry[$rpcName];
		else return null;
	}
	
	public static function lookupGraphics($graphicsName) {
		
		if(file_exists($GLOBALS['path_graphics'].$graphicsName)) return $GLOBALS['path_graphics'].$graphicsName;
		else if(isset(self::$graphics_registry[$graphicsName])) return self::$graphics_registry[$graphicsName];
		else return null;
	}
	
	public static function lookupStyle($stylesheetName) {
	
		if(file_exists($GLOBALS['path_styles'].$stylesheetName)) return $GLOBALS['path_styles'].$stylesheetName;
		else if(isset(self::$style_registry[$stylesheetName])) return self::$style_registry[$stylesheetName];
		else return null;
	}
	
	public static function lookupScript($scriptName) {
	
		if(file_exists($GLOBALS['path_scripts'].$scriptName)) return $GLOBALS['path_scripts'].$scriptName;
		else if(isset(self::$script_registry[$scriptName])) return self::$script_registry[$scriptName];
		else return null;
	}
	
	public static function lookupConfig($configKey) {
		
		if(isset(self::$app_config[$configKey])) return self::$app_config[$configKey];
		else return null;
	}
	
}

?>
