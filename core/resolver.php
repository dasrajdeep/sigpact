<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
	function resolve($action,$uriParams) {
		
		if($action) {
			if($action==='view') {
				if(!isset($uriParams[0])) die('view name not specified');
				$dispatcher=new Dispatcher();
				if($uriParams[0]==='default') $uriParams[0]=Registry::lookupConfig('default_view');
				call_user_func_array(array($dispatcher,'handleViewRequest'),$uriParams);
			} else if($action==='rpc') {
				$dispatcher=new Dispatcher();
				$result=call_user_func_array(array($dispatcher,'invokeRPC'),$uriParams);
				echo json_encode($result);
			} else if(in_array($action,Registry::getPortNames())) {
				$dispatcher=new Dispatcher();
				$params=array($action);
				array_push($params,$uriParams);
				call_user_func_array(array($dispatcher,'handlePortRequest'),$params);
			} else {
				die('Your request cannot be resolved.');
			}
		} else die('Your request cannot be resolved.');
		
	}

?>
