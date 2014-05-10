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
		
		$profiles = new Profile();
		
		$profile_data = $profiles->fetchAllProfiles(5);
		
		ViewManager::renderView('home-main', $profile_data);
		
	}
	
	public function showProfilePage($args) {
		
		if(count($args) > 0) $args = $args[0];
		else $args = null;
		
		$profile = new Profile();
		$article = new Article();
		
		if($args) {
			$user_profile = $profile->getCompleteProfileInfo($args);
			$articles = $article->fetchAllArticlesByCreator($args);
		} else {
			$user_profile = $profile->getCompleteProfileInfo(Session::getUserID());
			$articles = $article->fetchAllArticlesByCreator(Session::getUserID());
		}
		
		$user_profile = array_merge($user_profile, array($articles));
		
		if(Session::isRunning()) {
			ViewManager::renderView('profile-main', $user_profile);
		} else {
			header('Location: '.BASE_URI);
		}
	}
	
	public function showMeetingsPage() {
		
		$meetings = new Meeting();
		
		$all_meetings = $meetings->getUserMeetings(Session::getUserID());
		
		ViewManager::renderView('meetings-main', $all_meetings);
		
	}
	
	public function showArticlesPage() {
		
		$article = new Article();
		
		$articles = $article->fetchAllPublishedArticles(20);
		
		ViewManager::renderView('articles-main', $articles);
	}

	public function showCodePage() {
		
		ViewManager::renderView('code-main');
	}
	
	public function showNotificationsPage() {
		
		ViewManager::renderView('notifications-main');
	}
	
	public function showSettingsPage() {
		
		ViewManager::renderView('settings-main');
	}
	
	public function showPeoplePage() {
		
		ViewManager::renderView('people-main');
	}
	
}    

?>