<?php

class ArticlesController {
	
	public function publishArticle() {
		
		$title = $_POST['title'];
		$content = $_POST['article'];
		
		$article = new Article();
		
		$result = $article->createArticle(Session::getUserID(), $title, $content);
		
		if($result) {
			Event::trigger('ARTICLE_CREATED', Session::getUserID(), null);
			return TRUE;
		} else return FALSE;
	}
	
	public function displayArticle($args) {
		
		$article_id = $args[0];
		
		$articles = new Article();
		$profiles = new Profile();
		
		$article = $articles->getArticle($article_id);
		$profile = $profiles->getCompleteProfileInfo($article->creator_id);
		
		ViewManager::renderView('articles-full-main', array_merge(array($article), $profile));
	} 
	
}
 
?>