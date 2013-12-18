<?php

class ContentManager {
	
	private $cache_location='cache/';
	
	private $cdn_url='';
	
	private $contentTypes=array(
		'graphics'=>array('jpg','jpeg','png','gif','bmp','svg'),
		'stylesheets'=>array('css'),
		'scripts'=>array('js'),
		'fonts'=>array('eot','ttf','woff')
	);
	
	public function getResourceLink($resourceName) {
		
		$contentInfo=pathinfo($resourceName);
		
		if(!isset($contentInfo['extension'])) return '';
		
		$ext=$contentInfo['extension'];
		
		if(in_array($ext,$this->contentTypes['graphics'])) {
			if($GLOBALS['production']) return $this->cdn_url.'graphics/'.$resourceName;
			else return Registry::lookupGraphics($resourceName);
		} else if(in_array($ext,$this->contentTypes['stylesheets'])) {
			if($GLOBALS['production']) return $this->cdn_url.'stylesheets/'.$resourceName;
			else return Registry::lookupStyle($resourceName);
		} else if(in_array($ext,$this->contentTypes['scripts'])) {
			if($GLOBALS['production']) return $this->cdn_url.'scripts/'.$resourceName;
			else return Registry::lookupScript($resourceName);
		} else if(in_array($ext,$this->contentTypes['fonts'])) {
			if($GLOBALS['production']) return $this->cdn_url.'fonts/'.$resourceName;
			else return BASE_URI.PATH_FONTS.$resourceName;
		} else return '';
	}
	
	public function serveContent($contentName) {
		
		global $vendor_content;
		
		$fileInfo=pathinfo($contentName);
		
		if(in_array($fileInfo['basename'],array_keys($vendor_content))) {
			header('Location: '.$vendor_content[$fileInfo['basename']]);
			return;
		}
		
		$contentFound=true;
		
		if(!file_exists($this->cache_location.$contentName)) {
			$location=$this->getResourceLink($contentName);
			if($location && file_exists($location)) copy($location,$this->cache_location.$contentName);
			else $contentFound=false; 
		}
		
		if($contentFound) header('Location: '.BASE_URI.$this->cache_location.$contentName);
		else header('HTTP/1.1 404 Not Found');
	}
	
}

?>
