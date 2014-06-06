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
	
	public function deleteArticle($article_id) {
		
		$article = R::load('article', $article_id);
		
		//Delete corresponding event
		
		return R::trash($article);
	}
	
	public function updateArticle($article_id, $content) {
		
		$article = R::load('article', $article_id);
		
		if($article->id == 0) return FALSE;
		
		$article->content = $content;
		
		$id = R::store($article);
		
		if($id) {
			Event::trigger('ARTICLE_UPDATED', Session::getUserID(), $article_id);
			return TRUE;
		} else return FALSE;
	}
	
	public function getCompleteArticle($article_id) {
		
		$query = "SELECT article.id AS article_id,title,content,timestamp,account.id AS acc_no,full_name,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS photo,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime
			FROM article INNER JOIN	account 
			ON article.creator_id=account.id 
			WHERE article.id=:article_id";
		
		$row = R::getAssocRow($query, array(':article_id'=>$article_id));
		
		if(count($row)) $article = $row[0];
		else $article = null;
		
		$commentsManager = new Comments();
		
		$comments = $commentsManager->getCommentsByNode('ARTICLE', $article_id);
		
		return array('article'=>$article, 'comments'=>$comments);
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