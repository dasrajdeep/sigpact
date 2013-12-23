<?php
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');

	function getURIParameters() {
		
		$uriResource=explode('?',$_SERVER['REQUEST_URI']);
		$scriptResource=explode('?',$_SERVER['SCRIPT_NAME']);
		
		$requestURI=explode('/',$uriResource[0]);
		$scriptName=explode('/',$scriptResource[0]);

		for($i=0;$i<sizeof($scriptName);$i++) { if($requestURI[$i]==$scriptName[$i]) unset($requestURI[$i]); }
		
		$requestURI=array_filter($requestURI);
		$requestParams=array_values($requestURI);
		
		//$requestParams=array_merge($requestParams,$_REQUEST);
		
		return $requestParams;
	}
	
	function shutdown_system() {
		
		if(class_exists('DataStore',false)) DataStore::disconnectFromDatabase();
		
	}
	
	function build_view_registry() {
		
		$dir_listing=scandir(PATH_VIEWS);
		
		$registry_file=PATH_VIEWS.'.views';
		
		$view_registry="[view_registry]\n\n";
		
		foreach($dir_listing as $entry) {
			if(is_file(PATH_VIEWS.$entry) || $entry==='.' || $entry==='..') continue;
			$view_files=scandir(PATH_VIEWS.$entry);
			foreach($view_files as $file) if(strpos($file,'.php')>0) $view_registry.=sprintf("%s=%s/%s\n",substr($file,0,strpos($file,'.php')),PATH_VIEWS.$entry,$file);
		}
		
		file_put_contents($registry_file,$view_registry);
	}
	
	function build_helper_registry() {
		
		$dir_listing=scandir(PATH_HELPERS);
		
		$registry_file=PATH_HELPERS.'.helpers';
		
		$helper_registry="[helper_registry]\n\n";
		
		$functionMap=array();
		
		foreach($dir_listing as $entry) {
			if(is_file(PATH_VIEWS.$entry) || $entry==='.' || $entry==='..') continue;
			if(strpos($entry,'.php')>0) {
				$tokens=token_get_all(file_get_contents(PATH_HELPERS.$entry));
				$stateFlag=false;
				foreach($tokens as $token) {
					if($token[0]==307 && $stateFlag) {
						array_push($functionMap,$token[1].'='.$entry);
						$stateFlag=false;
					}
					if($token[0]==334) $stateFlag=true;
				}
			}
		}
		
		$helper_registry.=implode("\n",$functionMap);
		
		file_put_contents($registry_file,$helper_registry);
	}
	
?>
