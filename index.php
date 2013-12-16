<?php
	
	session_start();
	
	define('DS',DIRECTORY_SEPARATOR);
	
	require_once('core/bootstrap.php');
	
	if($production) ini_set('display_errors',false);
	
	$uriParams=getURIParameters(); 
	
	if(count($uriParams)>0) {
		$info=pathinfo($uriParams[count($uriParams)-1]);
		if(isset($info['extension'])) {
			$info['extension']=strtolower($info['extension']);
			if(in_array($info['extension'],array('js','css','jpg','jpeg','png','gif','bmp','svg','eot','ttf','woff'))) require_once('core/static.php');
		}
	}
	
	if(count($uriParams)==0) {
		$action='view';
		$uriParams=array('default');
	} else {
		$action=$uriParams[0];
		$uriParams=array_slice($uriParams,1);
	}
	
	resolve($action,$uriParams);

?>
