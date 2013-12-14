<?php
	
	$uriResource=explode('?',$_SERVER['REQUEST_URI']);
	$scriptResource=explode('?',$_SERVER['SCRIPT_NAME']);
	
	$requestURI=explode('/',$uriResource[0]);
	$scriptName=explode('/',$scriptResource[0]);

	for($i=0;$i<sizeof($scriptName);$i++) { if ($requestURI[$i]==$scriptName[$i]) unset($requestURI[$i]); }
	
	$requestURI=array_filter($requestURI);
	$requestParams=array_values($requestURI);
	
	define('DS',DIRECTORY_SEPARATOR);

	//ini_set('display_errors',false);

	session_start();
	
	require_once('bootstrap.php');
	require_once('globals.php');
	
	require_once('app/Registry.php');
	require_once('app/Session.php');
	
	Registry::loadRegistry();
	
	if(count($requestParams)>0) {
		$info=pathinfo($requestParams[count($requestParams)-1]);
		if(isset($info['extension'])) {
			$info['extension']=strtolower($info['extension']);
			if(in_array($info['extension'],array('js','css','jpg','jpeg','png','gif','bmp','svg'))) require_once('static.php');
		}
	}
	
	build_view_registry();
	
	if(count($requestParams)==0) require_once('container.php');
	else {
		$action=$requestParams[0];
		$requestParams=array_slice($requestParams,1);
		
		require_once('resolver.php');
	}

?>
