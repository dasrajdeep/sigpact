<?php

class ForumController {
	
	public function createForumThread() {
		
		$title = $_POST['title'];
		$description = $_POST['description'];
		
		$forum = new Forum();
		
		$result = $forum->createThread($title, $description);
		
		if($result) return TRUE;
		else return FALSE;
	}
	
	public function displayThread($args) {
		
		$thread_id = $args[0];
		
		$forum = new Forum();
		
		$thread = $forum->fetchThread($thread_id);
		
		ViewManager::renderView('forum-threadview', $thread);
	}
	
	public function createThreadComment() {
		
		$thread_id = $_POST['thread_id'];
		$comment = $_POST['comment'];
		
		$forum = new Forum();
		
		$result = $forum->postComment($thread_id, $comment);
		
		if($result) return TRUE;
		else return FALSE;
	}
	
}

?>