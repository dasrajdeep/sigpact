<?php

class MessagingController {
	
	public function sendMessage() {
		
		$recipient = $_POST['recipient'];
		$message = $_POST['message'];
		
		$messaging = new Messaging();
		
		$result = $messaging->sendMessage($recipient, $message);
		
		if($result) return TRUE;
		else return FALSE;
	}
}

?>
