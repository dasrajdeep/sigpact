<?php
	
	session_start();
	
	define('SYSTEM_STARTED', TRUE);
	
	require_once('app/environment.php');
	
	setlocale(LC_ALL,$env_locale);
	date_default_timezone_set($env_time_zone);
	
	require_once('core/bootstrap.php');
	
	if(PRODUCTION) ini_set('display_errors',false);
	
	$uriParams=getURIParameters();
	
	/**
	 * Handle static content separately.
	 */
	if(count($uriParams)>0) {
		$info=pathinfo($uriParams[count($uriParams)-1]);
		if(isset($info['extension'])) {
			$info['extension']=strtolower($info['extension']);
			if(in_array($info['extension'],array('js','css','jpg','jpeg','png','gif','bmp','svg','eot','ttf','woff'))) require_once('core/static.php');
		}
	}
	
	/**
	 * Explicitly set command for default view.
	 */
	if(count($uriParams)==0) {
		$action=Registry::lookupConfig('default_port');
	} else {
		$action=$uriParams[0];
		$uriParams=array_slice($uriParams,1);
	}
	
	/**
	 * Resolve URI request.
	 */
	resolve($action,$uriParams);

?>
