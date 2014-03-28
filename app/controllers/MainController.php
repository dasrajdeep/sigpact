<?php

class MainController {	
	
	public function showLandingPage() {
		
		ViewManager::renderView('landing-main');
		
	}
	
	public function showHomePage() {
		
		ViewManager::renderView('home-main');
		
	}
	
}    

?>