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
		
		$article = $articles->getCompleteArticle($article_id);
		
		ViewManager::renderView('articles-full-main', $article);
	} 
	
	public function deleteArticle() {
		
		$article_id = $_POST['article_id'];
		
		$articles = new Article();
		
		$articles->deleteArticle($article_id);
		
		return TRUE;
	}
	
	public function editArticle() {
		
		$article_id = $_POST['article_id'];
		$content = $_POST['content'];
		
		$articles = new Article();
		
		return $articles->updateArticle($article_id, $content);
	}
	
	public function commentOnArticle() {
		
		$article_id = $_POST['article_id'];
		$comment = $_POST['comment'];
		$acc_no = Session::getUserID();
		
		$comments = new Comments();
		
		$result = $comments->addComment('ARTICLE', $article_id, $acc_no, $comment);
		
		if($result) return TRUE;
		else return FALSE;
	}
	
}
 
?>