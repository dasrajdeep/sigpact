<?php
	
	function resolve($action,$uriParams) {
		
		global $path_views;
		
		$ports=array();
		
		if($action) {
			if($action==='view') {
				if(!isset($uriParams[0])) die('view name not specified');
				require_once('app/ViewManager.php');
				$viewManager=new ViewManager();
				$viewManager->renderView($uriParams[0]);
			} else if($action==='rpc') {
				require_once('app/Dispatcher.php');
				$dispatcher=new Dispatcher();
				$dispatcher->dispatch();
				$result=call_user_func_array(array($dispatcher,'dispatch'),$uriParams);
				echo json_encode($result);
			} else if(in_array($action,$ports)) {
				//Define ports here.
			} else {
				die('invalid command');
			}
		} else die('invalid command');
		
	}

?>
