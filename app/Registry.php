<?php

class Registry {
	
	/**
		Contains registry entries of the form:
		(<media_name>,<media_url>)
	*/
	private static $multimediaRegistry;
	
	/**
		Contains registry entries of the form:
		(<script_name>,<script_path>)
	*/
	private static $script_registry;
	
	/**
		Contains registry entries of the form:
		(<style_name>,<style_path>)
	*/
	private static $style_registry;
	
	/**
		Contains registry entries of the form:
		(<graphics_name>,<graphics_path>)
	*/
	private static $graphics_registry;
	
	/**
		Contains registry entries of the form:
		(<controller_name>,<method_name>)
	*/
	private static $rpcRegistry;
	
	public static function loadRegistry() {
		//Reads mappings into registry.
	}
	
	public static function lookupRPC($rpcName) {
	
		if(isset(self::$rpcRegistry[$rpcName])) return self::$rpcRegistry[$rpcName];
		else return null;
	}
	
	public static function lookupGraphics($graphicsName) {
		
		if(isset(self::$graphicsRegistry[$graphicsName])) return self::$graphicsRegistry[$graphicsName];
		else return null;
	}
	
	public static function lookupStyle($stylesheetName) {
	
		if(isset(self::$styleRegistry[$stylesheetName])) return self::$styleRegistry[$stylesheetName];
		else return null;
	}
	
	public static function lookupScript($scriptName) {
	
		if(isset(self::$scriptRegistry[$scriptName])) return self::$scriptRegistry[$scriptName];
		else return null;
	}
 	
	public static function lookupMultimedia($mediaName) {
	
		if(isset(self::$multimediaRegistry[$mediaName])) return self::$multimediaRegistry[$mediaName];
		else return null;
	}
	
}

?>