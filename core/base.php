<?php

	function getURIParameters() {
		
		$uriResource=explode('?',$_SERVER['REQUEST_URI']);
		$scriptResource=explode('?',$_SERVER['SCRIPT_NAME']);
		
		$requestURI=explode('/',$uriResource[0]);
		$scriptName=explode('/',$scriptResource[0]);

		for($i=0;$i<sizeof($scriptName);$i++) { if($requestURI[$i]==$scriptName[$i]) unset($requestURI[$i]); }
		
		$requestURI=array_filter($requestURI);
		$requestParams=array_values($requestURI);
		
		$requestParams=array_merge($requestParams,$_REQUEST);
		
		return $requestParams;
	}
	
	function build_view_registry() {
		
		global $path_views;
		
		$dir_listing=scandir($path_views);
		
		$registry_file=$path_views.'.views';
		
		$view_registry="[view_registry]\n\n";
		
		foreach($dir_listing as $entry) {
			if(is_file($path_views.$entry) || $entry==='.' || $entry==='..') continue;
			$view_files=scandir($path_views.$entry);
			foreach($view_files as $file) if(strpos($file,'.php')>0) $view_registry.=sprintf("%s=%s/%s\n",substr($file,0,strpos($file,'.php')),$path_views.$entry,$file);
		}
		
		file_put_contents($registry_file,$view_registry);
	}

	function load_module($moduleName) {
		
		$moduleFile=$moduleName.'.php';
		
		$path=$GLOBALS['path_modules'].$moduleFile;
		
		require_once($path);
	}
	
	function add_libraries() {
		
		global $libraries;
		
		if(!isset($GLOBALS['view_config'])) $libraryNames=array();
		else $libraryNames=$GLOBALS['view_config']['lib'];
		
		array_push($libraryNames,'jquery');
		
		foreach($libraryNames as $lib) {
			if(isset($libraries[$lib])) {
				$lib_link=$libraries[$lib];
				
				if($GLOBALS['production']) $lib_link=$lib_link['cdn'];
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
		
		global $path_styles,$path_scripts;
		
		if(!isset($GLOBALS['view_config'])) return;
		
		$view_config=$GLOBALS['view_config'];
		
		foreach($view_config['styles'] as $dep) {
			
			if(!file_exists($path_styles.$dep)) continue;
			
			echo sprintf('<link rel="stylesheet" href="%s" />',$dep);
		}
		
		foreach($view_config['scripts'] as $dep) {
			
			if(!file_exists($path_scripts.$dep)) continue;
			
			echo sprintf('<script type="text/javascript" src="%s"></script>',$dep);
		}
	}
	
	function add_bootscript() {
		
		$bootScript="
			var rootPath='%s';
		";
		
		$bootScript=sprintf($bootScript,$GLOBALS['rootPath']);
		
		echo sprintf('<script type="text/javascript">%s</script>',$bootScript);
	}
	
?>
