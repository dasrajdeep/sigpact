<?php

class Forum {
	
	public function createThread($title, $description) {
		
		$thread = R::dispense('forumthread');
		
		$thread->creator_id = Session::getUserID();
		$thread->title = $title;
		$thread->description = $description;
		$thread->timestamp = time();
		
		$thread_id = R::store($thread);
		
		if($thread_id) Event::trigger('FORUM_THREAD_CREATED', Session::getUserID(), $thread_id);
		
		return $thread_id; 
	}
	
	public function fetchAllThreads() {
		
		$query = "SELECT * FROM forumthread ORDER BY timestamp DESC";
		
		$result = R::getAll($query);
		
		return R::convertToBeans('forumthread', $result);
	}
	
	public function fetchThread($thread_id) {
		
		$query = "SELECT forumthread.id AS thread_id,title,description,account.id AS acc_no,full_name,timestamp,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS thumbnail,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime 
			FROM forumthread INNER JOIN account 
			ON forumthread.creator_id=account.id 
			WHERE forumthread.id=:thread_id";
			
		$row = R::getAssocRow($query, array(':thread_id'=>$thread_id));
		
		$commentManager = new Comments();
		
		$comments = $commentManager->getCommentsByNode('FORUM', $thread_id);
		
		if(count($row)) $thread = $row[0];
		else $thread = null;
		
		return array('thread'=>$thread, 'comments'=>$comments);
	}
	
	public function postComment($thread_id, $comment_text) {
		
		$comments = new Comments();
		
		return $comments->addComment('FORUM', $thread_id, Session::getUserID(), $comment_text);
	}
	
}

?>