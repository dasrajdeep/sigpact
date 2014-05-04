<?php

class MainController {	
	
	public function showLandingPage() {
		
		if(Session::isRunning()) {
			header('Location: '.BASE_URI.'home');
		} else {
			ViewManager::renderView('landing-main');
		}
	}
	
	public function showHomePage() {
		
		ViewManager::renderView('home-main');
		
	}
	
	public function showProfilePage($args) {
		
		if(count($args) > 0) {
			// Render public profile
			ViewManager::renderView('profile-public-main');
		} else if(Session::isRunning()) {
			ViewManager::renderView('profile-self-main');
		} else {
			header('Location: '.BASE_URI);
		}
	}
	
}    

?>