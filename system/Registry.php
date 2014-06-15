<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class Registry {
	
	const CONFIG_TYPE_DATABASE = "DATABASE";
	const CONFIG_TYPE_MAIL = "MAIL";
	const CONFIG_TYPE_APP = "APP";
	const PORT_TYPE_PUBLIC = "PUBLIC";
	const PORT_TYPE_PRIVATE = "PRIVATE";
	
	/**
	 * Contains registry entries of the form:
	 * (<controller_name>,<method_name>)
	 */
	private static $port_registry=array();
	
	/**
	 * Contains registry entries of the form:
	 * <method_name>=<controller_class_name>
	 */
	private static $rpc_registry=array();
	
	/**
	 * Contains registry entries of the form:
	 * <view_name>=<controller_class_name>
	 */
	private static $view_registry=array();
	
	/**
	 * Contains registry entries of the form:
	 * <key>=<value>
	 */
	private static $app_config=array();
	
	public static function init() {
		
		if(!file_exists(BASE_DIR.'app/config/app.ini')) {
			copy(BASE_DIR.'app/config/app.ini.default', BASE_DIR.'app/config/app.ini');
		}
		
		$config_app = parse_ini_file(BASE_DIR.'app/config/app.ini', TRUE);
		$config_ports = parse_ini_file(BASE_DIR.'app/config/ports.ini', TRUE);
		$config_rpc = parse_ini_file(BASE_DIR.'app/config/rpc.ini', FALSE);
		$config_views = parse_ini_file(BASE_DIR.'app/config/views.ini', FALSE);
		$config_custom = parse_ini_file(BASE_DIR.'app/config/custom.ini', FALSE);
		
		self::$port_registry = $config_ports;
		
		foreach(array_keys($config_ports['PUBLIC']) as $key) {
			$value = trim($config_ports['PUBLIC'][$key]);
			if($value) self::$port_registry['PUBLIC'][$key] = explode(':', $value);
			else self::$port_registry['PUBLIC'][$key] = null;
		}
		
		foreach(array_keys($config_ports['PRIVATE']) as $key) {
			$value = trim($config_ports['PRIVATE'][$key]);
			if($value) self::$port_registry['PRIVATE'][$key] = explode(':', $value);
			else self::$port_registry['PRIVATE'][$key] = null;
		}
		
		self::$rpc_registry = $config_rpc;
		
		self::$view_registry = $config_views;
		
		self::$app_config = $config_app;
	}
	
	public static function portExists($portName) {
		
		if(array_key_exists($portName, self::$port_registry['PUBLIC'])) return TRUE;
		if(array_key_exists($portName, self::$port_registry['PRIVATE'])) return TRUE;
		
		return FALSE;
	}
	
	public static function lookupPort($portName) {
		
		if(isset(self::$port_registry['PUBLIC'][$portName])) return array_merge(self::$port_registry['PUBLIC'][$portName], array('PUBLIC'));
		else if(isset(self::$port_registry['PRIVATE'][$portName])) return array_merge(self::$port_registry['PRIVATE'][$portName], array('PRIVATE'));
		else return null;
	}
	
	public static function lookupRPC($rpcName) {
	
		if(isset(self::$rpc_registry[$rpcName])) return self::$rpc_registry[$rpcName];
		else return null;
	}
	
	public static function lookupView($viewName) {
		
		if(isset(self::$view_registry[$viewName])) return self::$view_registry[$viewName];
		else return null;
	}
	
	public static function lookupConfig($type, $configKey) {
		
		if(isset(self::$app_config[$type][$configKey])) return self::$app_config[$type][$configKey];
		else return null;
	}
	
}

?>
