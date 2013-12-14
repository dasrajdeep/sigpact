<?php
	
	if($action) {
		if($action==='view') {
			if(!isset($_REQUEST['view_name'])) die('view name not specified');
			$viewName=$_REQUEST['view_name'].'.php';
			if(!file_exists($path_views.$viewName)) die('specified view does not exist');
			require_once($path_views.$viewName);
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
