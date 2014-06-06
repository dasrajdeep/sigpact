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
		
		$query = "SELECT * FROM message WHERE receiver=:receiver ORDER BY `timestamp` DESC";
		
		$results = R::getAll($query, array(':receiver'=>$acc_no));
		
		return R::convertToBeans('message', $results);
	}
	
	public function fetchSentbox($acc_no) {
		
		$query = "SELECT * FROM message WHERE sender=:sender ORDER BY `timestamp` DESC";
		
		$results = R::getAll($query, array(':sender'=>$acc_no));
		
		return R::convertToBeans('message', $results);
	}
	
}

?>