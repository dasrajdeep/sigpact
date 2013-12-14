<?php
	
	if($action) {
		if($action==='view') {
			if(!isset($requestParams[0])) die('view name not specified');
			$viewName=$requestParams[0].'.php';
			$view_registry=parse_ini_file($path_views.'.views',true);
			$view_registry=$view_registry['view_registry'];
			if(!isset($view_registry[$requestParams[0]])) die('specified view does not exist');
			require_once($view_registry[$requestParams[0]]);
		} else if($action==='rpc') {
			require_once('app/Dispatcher.php');
			$dispatcher=new Dispatcher();
			$dispatcher->dispatch();
			$result=call_user_func_array(array($dispatcher,'dispatch'),$requestParams);
			echo json_encode($result);
		} else {
			die('invalid command');
		}
	} else die('invalid command');

?>
