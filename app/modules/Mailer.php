<?php

require_once(PATH_THIRD_PARTY.'swift-mailer/lib/swift_required.php');

class Mailer {

	public function sendMail($recipient, $messageText, $subject) {
		$transport = Swift_SmtpTransport::newInstance(Registry::lookupConfig('mail_host'), Registry::lookupConfig('mail_port'))
		  ->setUsername(Registry::lookupConfig('mail_username'))
		  ->setPassword(Registry::lookupConfig('mail_password'));
		
		$mailer = Swift_Mailer::newInstance($transport);
		
		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array(Registry::lookupConfig('sender_id') => Registry::lookupConfig('sender_name')))
		  ->setTo(array($recipient))
		  ->setBody($messageText);
		
		$result = $mailer->send($message);
	}
	 
}

?>