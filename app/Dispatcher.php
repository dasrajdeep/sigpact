<?php

class Dispatcher {
	
	public function dispatch($method) {
		
		$callConfig=Registry::lookupRPC($method);
		
		$controllerName=$callConfig[0];
		$methodName=$callConfig[1];
		
		require_once('app/controllers/'.$controllerName.'.php');
		
		$controller=new $controllerName();
		
		$resultSet=call_user_func_array(array($controller,$methodName),array_slice(func_get_args(),1));
		
		return $resultSet;
	}
	
}

?>