<?php

class ContentManager {
	
	private $cache_location='cache/';
	
	private $contentTypes=array(
		'graphics'=>array('jpg','jpeg','png','gif','bmp','svg'),
		'stylesheets'=>array('css'),
		'scripts'=>array('js')
	);
	
	public function serveContent($contentName) {
		
		$fileInfo=pathinfo($contentName);
		
		$content_type=$fileInfo['extension'];
		
		if(in_array($content_type,$this->contentTypes['graphics'])) $content_type='graphics';
		else if(in_array($content_type,$this->contentTypes['stylesheets'])) $content_type='stylesheets';
		else if(in_array($content_type,$this->contentTypes['scripts'])) $content_type='scripts';
		else $content_type='unknown';
		
		$contentFound=true;
		
		if(!file_exists($this->cache_location.$contentName)) {
			if($content_type==='graphics') {
				$path_to_file=get_image_link($contentName);
				if($path_to_file) copy($path_to_file,$this->cache_location.$contentName);
				else $contentFound=false;
			} else if($content_type==='stylesheets') {
				$path_to_file=get_style_link($contentName);
				if($path_to_file) copy($path_to_file,$this->cache_location.$contentName);
				else $contentFound=false;
			} else if($content_type==='scripts') {
				$path_to_file=get_script_link($contentName);
				if($path_to_file) copy($path_to_file,$this->cache_location.$contentName);
				else $contentFound=false;
			} else $contentFound=false;
		}
		
		if($contentFound) header('Location: '.$GLOBALS['rootPath'].$this->cache_location.$contentName);
		else header('HTTP/1.1 404 Not Found');
	}
	
}

?>
