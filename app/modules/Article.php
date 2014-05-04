<?php

class Article {
	
	public function createArticle($acc_no, $title, $content) {
		
		$article = R::dispense('article');
		
		$article->creator_id = $acc_no;
		$article->title = htmlentities($title);
		$article->content = htmlentities($content);
		
		return R::store($article);
	}
	
	public function updateArticle($article_id, $content) {
		
		$article = R::load('article', $article_id);
		
		if($article->id == 0) return FALSE;
		
		$article->content = $content;
		
		$id = R::store($article);
		
		if($id) return TRUE;
		else return FALSE;
	}
	
	public function getArticle($article_id) {
		
		$article = R::load('article', $article_id);
		
		return $article;
	}
	
	public function fetchAllArticles($acc_no) {
		
		$articles = R::find('article', 'creator_id=:id', array(':id' => $acc_no));
		
		return $articles;
	}
	
}

?>