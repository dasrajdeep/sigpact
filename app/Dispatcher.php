<?php

class Dispatcher {
	
	public function invokeRPC($methodName) {
		
		$controllerName=Registry::lookupRPC($methodName).'Controller';
		
		require_once('app/controllers/'.$controllerName.'.php');
		
		$controller=new $controllerName();
		
		$resultSet=call_user_func_array(array($controller,$methodName),array_slice(func_get_args(),1));
		
		return $resultSet;
	}
	
	public function handleViewRequest($viewName) {
		
		$controllerName=Registry::lookupView($viewName).'Controller';
		
		require_once('app/controllers/'.$controllerName.'.php');
		
		$controller=new $controllerName();
		
		$viewName=strtoupper(substr($viewName,0,1)).substr($viewName,1).'View';
		
		require_once('app/ViewManager.php');
		
		call_user_func_array(array($controller,'render'.$viewName),array_slice(func_get_args(),1));
	}
	
	public function handlePortRequest($portName) {
		
		$portConfig=Registry::lookupPort($portName);
		
		$controllerName=$portConfig[0].'Controller';
		$methodName=$portConfig[1];
		
		require_once('app/controllers/'.$controllerName.'.php');
		
		$controller=new $controllerName();
		
		require_once('app/ViewManager.php');
		
		call_user_func_array(array($controller,$methodName),array_slice(func_get_args(),1));
	}
	
}

?>
