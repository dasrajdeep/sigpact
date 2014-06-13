<?php

defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

class Dispatcher {
	
	public function invokeRPC($methodName) {
		
		if(!Session::isRunning()) return FALSE;
		
		$controllerName=Registry::lookupRPC($methodName).'Controller';
		
		$controller=new $controllerName();
		
		$resultSet=call_user_func_array(array($controller,$methodName),array_slice(func_get_args(),1));
		
		return $resultSet;
	}
	
	public function handleViewRequest($viewName) {
		
		if(!Session::isRunning()) return FALSE;
		
		$controllerName=Registry::lookupView($viewName).'Controller';
		
		$controller=new $controllerName();
		
		$viewName=strtoupper(substr($viewName,0,1)).substr($viewName,1).'View';
		
		call_user_func_array(array($controller,'render'.$viewName),array_slice(func_get_args(),1));
		
		return TRUE;
	}
	
	public function handlePortRequest($portName) {
		
		$portConfig = Registry::lookupPort($portName);
		
		if($portName === 'default' && !$portConfig) {
			echo "Your app does not have a default port configuration. Please configure the default port.";
			return TRUE;
		}
		
		if(!$portConfig) return FALSE; 
		
		if($portConfig[2] === Registry::PORT_TYPE_PRIVATE && !Session::isRunning()) return FALSE;
		
		$controllerName=$portConfig[0].'Controller';
		$methodName=$portConfig[1];
		
		$controller=new $controllerName();
		
		call_user_func_array(array($controller,$methodName),array_slice(func_get_args(),1));
		
		return TRUE;
	}
	
}

?>
