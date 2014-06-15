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
	
	function build_library_registry() {
		
		if(file_exists('lib.json') && filemtime('bower.json') <= filemtime('lib.json')) {
			$GLOBALS['libraries'] = json_decode(file_get_contents('lib.json'), TRUE);
			return;	
		} 
		
		$paths = json_decode(shell_exec("bower list --paths"), TRUE);
		 
		$names = array_keys($paths);
		
		$libraries = array();
		
		foreach($names as $name) {
			
			$list_new = array();
			
			if(is_array($paths[$name])) {
				$list_old = $paths[$name];
				foreach($list_old as $item) {
					$pathinfo = pathinfo($item);
					if($pathinfo['basename'] === '*') {
						$files = scandir($pathinfo['dirname']);
						foreach($files as $file) {
							if($file === '.' || $file === '..') continue;
							array_push($list_new, $pathinfo['dirname'].'/'.$file);
						}
					} else {
						array_push($list_new, $item);
					}
				}
			} else {
				$item = $paths[$name];
				$pathinfo = pathinfo($item);
				if($pathinfo['basename'] === '*') {
					$files = scandir($pathinfo['dirname']);
					foreach($files as $file) {
						if($file === '.' || $file === '..') continue;
						array_push($list_new, $pathinfo['dirname'].'/'.$file);
					}
				} else {
					array_push($list_new, $item);
				}
			}
			
			$libraries[$name] = $list_new;
		} 
		 
		$GLOBALS['libraries'] = $libraries;
		
		file_put_contents('lib.json', json_encode($libraries));
	}

	function generate_random_string($length = 25) {
		
		if($length < 5) $length = 5;
		
		$pool = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$chunk_size = 5;
		
		$num_chunks = intval($length / $chunk_size);
		$extra = $length % $chunk_size;
		
		$random_string = '';
		
		for($index = 0; $index < $num_chunks; $index++) {
			$chunk = substr(str_shuffle($pool), 0, $chunk_size);
			$random_string = $random_string.$chunk;
		}
		
		$chunk = substr(str_shuffle($pool), 0, $extra);
		$random_string = $random_string.$chunk;
		
		return $random_string;
	}
	
?>
