<?php

class ExampleController {
	
	public function renderFrontView() {
		
		ViewManager::renderView('front');
	}
	
	public function rpcExample() {
		
		$dataFolder=$GLOBALS['path_appdata'];
		
		file_put_contents($dataFolder.'example.txt','This is sample data.');
		
		return 'done';
	}
	
	public function portExample() {
		
		$this->rpcExample();
		
		ViewManager::renderView('example',array('variable'=>'This is a view variable.'));
	}
}

?>
