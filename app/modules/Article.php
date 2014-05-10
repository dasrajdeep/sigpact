<?php

class Article {
	
	public function createArticle($acc_no, $title, $content) {
		
		require_once(PATH_THIRD_PARTY.'htmlpurifier/library/HTMLPurifier.auto.php');
		
		$article = R::dispense('article');
		
		$purifier = new HTMLPurifier(HTMLPurifier_Config::createDefault());
		$content = $purifier->purify($content);
		$title = $purifier->purify($title);
		
		$article->creator_id = $acc_no;
		$article->title = $title;
		$article->content = $content;
		$article->timestamp = time();
		
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
	
	public function fetchAllArticlesByCreator($acc_no) {
		
		$articles = R::find('article', 'creator_id=:id', array(':id' => $acc_no));
		
		return $articles;
	}
	
	public function fetchAllPublishedArticles($limit) {
		
		$query = "SELECT * FROM article ORDER BY timestamp DESC LIMIT :limit";
		
		$results = R::getAll($query, array(':limit'=>$limit));
		
		return R::convertToBeans('article', $results);
	}
	
}

?>