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
	
}
 
?>