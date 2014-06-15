<?php

class Comments {
	
	public function addComment($node_type, $node_id, $commenter, $comment_content) {
		
		$comment = R::dispense('comment');
		
		$comment->nodetype = $node_type;
		$comment->nodeid = $node_id;
		$comment->commenter = $commenter;
		$comment->comment = $comment_content;
		$comment->timestamp = time();
		
		Event::trigger('COMMENTED_'.$node_type, $commenter, $node_id);
		
		return R::store($comment);
	}
	
	public function getCommentsByCommenter($acc_no) {}
	
	public function getCommentsByNode($node_type, $node_id) {
		
		$query = "SELECT account.id AS acc_no,full_name,comment.id AS comment_id,comment,timestamp,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS photo,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime  
			FROM comment INNER JOIN account 
			ON comment.commenter=account.id   
			WHERE nodetype=:nodetype AND nodeid=:nodeid ORDER BY `timestamp` DESC";
		
		$comments = R::getAll($query, array(':nodetype'=>$node_type, ':nodeid'=>$node_id));
		
		return $comments;
	}
	
}

?>