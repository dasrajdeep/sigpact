<?php

class Messaging {
	
	const STATUS_UNREAD = 'UNREAD';
	const STATUS_READ = 'READ';
	
	public function sendMessage($recipient, $messageText) {
		
		$message = R::dispense('message');
		
		$message->sender = Session::getUserID();
		$message->recipient = $recipient;
		$message->message = htmlentities($messageText);
		$message->timestamp = time();
		$message->status = $this::STATUS_UNREAD;
		
		return R::store($message);
	}
	
	public function markRead($message_id) {
		
		$message = R::load('message', $message_id);
		
		$message->status = $this::STATUS_READ;
		
		return R::store($message);
	}
	
	public function fetchInbox($acc_no) {
		
		$query = "SELECT message,timestamp,full_name,account.id AS acc_no,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS photo,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime 
			FROM message INNER JOIN account 
			ON message.sender=account.id 
			WHERE recipient=:receiver 
			ORDER BY `timestamp` DESC";
		
		$results = R::getAll($query, array(':receiver'=>$acc_no));
		
		return $results;
	}
	
	public function fetchSentbox($acc_no) {
		
		$query = "SELECT message,timestamp,full_name,account.id AS acc_no,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS photo,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime 
			FROM message INNER JOIN account 
			ON message.recipient=account.id 
			WHERE sender=:sender 
			ORDER BY `timestamp` DESC";
		
		$results = R::getAll($query, array(':sender'=>$acc_no));
		
		return $results;
	}
	
}

?>