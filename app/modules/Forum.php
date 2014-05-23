<?php

class Forum {
	
	public function createThread($title, $description) {
		
		$thread = R::dispense('forumthread');
		
		$thread->creator_id = Session::getUserID();
		$thread->title = $title;
		$thread->description = $description;
		$thread->timestamp = time();
		
		return R::store($thread);
	}
	
	public function fetchAllThreads() {
		
		$query = "SELECT * FROM forumthread ORDER BY timestamp DESC";
		
		$result = R::getAll($query);
		
		return R::convertToBeans('forumthread', $result);
	}
	
	public function fetchThread($thread_id) {
		
		$query = "SELECT forumthread.id AS thread_id,title,description,account.id AS acc_no,full_name,mime,thumbnail,timestamp 
			FROM forumthread INNER JOIN account INNER JOIN photo 
			ON forumthread.creator_id=account.id AND account.photo_id=photo.id 
			WHERE forumthread.id=:thread_id";
			
		$result = R::getAssocRow($query, array(':thread_id'=>$thread_id));
		
		return $result[0];
	}
	
	public function postComment($thread_id, $comment_text) {
		
		$comments = new Comments();
		
		return $comments->addComment('FORUM', $thread_id, Session::getUserID(), $comment_text);
	}
	
	public function fetchCommentsForThread($thread_id) {
		
		$query = "SELECT comment.id AS comment_id,comment,timestamp,full_name,account.id AS acc_no 
			FROM comment INNER JOIN account 
			ON comment.commenter=account.id 
			WHERE comment.nodetype='FORUM' AND comment.nodeid=:thread_id 
			ORDER BY timestamp DESC";
		
		$results = R::getAll($query, array(':thread_id'=>$thread_id));
		
		return $results;
	}
	
}

?>