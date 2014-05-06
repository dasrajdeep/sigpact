<?php

class Comments {
	
	public function addComment($node_type, $node_id, $commenter, $comment) {
		
		$comment = R::dispense('comment');
		
		$comment->nodetype = $node_type;
		$comment->nodeid = $node_id;
		$comment->commenter = $commenter;
		$comment->comment = $comment;
		$comment->timestamp = time();
		
		return R::store($comment);
	}
	
	public function getCommentsByCommenter($acc_no) {}
	
	public function getCommentsByNode($node_type, $node_id) {}
	
}

?>