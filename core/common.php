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

	function load_module($moduleName) {
		
		$moduleFile=$moduleName.'.php';
		
		$path=PATH_MODULES.$moduleFile;
		
		require_once($path);
	}
	
	function load_modules($moduleNames) {
		
		foreach($moduleNames as $mod) load_module($mod);
	}
	
	function add_libraries() {
		
		global $libraries;
		
		if(!isset($GLOBALS['view_config'])) $libraryNames=array();
		else $libraryNames=$GLOBALS['view_config']['lib'];
		
		array_push($libraryNames,'jquery');
		
		foreach($libraryNames as $lib) {
			if(isset($libraries[$lib])) {
				$lib_link=$libraries[$lib];
				
				if(PRODUCTION) $lib_link=$lib_link['cdn'];
				else $lib_link=$lib_link['local'];
				
				foreach($lib_link as $link) {
					$info=pathinfo($link);
					if($info['extension']==='js') echo sprintf('<script type="text/javascript" src="%s"></script>',$link);
					else if($info['extension']==='css') echo sprintf('<link rel="stylesheet" href="%s" />',$link);
				}
			}
		}
	}
	
	function add_dependancies() {
		
		if(!isset($GLOBALS['view_config'])) return;
		
		$view_config=$GLOBALS['view_config'];
		
		foreach($view_config['styles'] as $dep) {
			
			if(!file_exists(PATH_STYLES.$dep)) continue;
			
			echo sprintf('<link rel="stylesheet" href="%s" />',$dep);
		}
		
		foreach($view_config['scripts'] as $dep) {
			
			if(!file_exists(PATH_SCRIPTS.$dep)) continue;
			
			echo sprintf('<script type="text/javascript" src="%s"></script>',$dep);
		}
	}
	
	function add_bootscript() {
		
		$bootScript="
			var baseURI='%s';
		";
		
		$bootScript=sprintf($bootScript,BASE_URI);
		
		echo sprintf('<script type="text/javascript">%s</script>',$bootScript);
	}
	
?>
