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
		
		load_modules(array('ExampleModule'));
		
		$module=new ExampleModule();
		
		ViewManager::renderView('example',array('variable'=>$module->exampleMethod()));
	}
}

?>
