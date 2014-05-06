<?php

require_once(PATH_THIRD_PARTY.'swift-mailer/lib/swift_required.php');

class Mailer {
	
	private $host = null;
	private $port = null;
	private $username = null;
	private $password = null;
	private $sender_id = null;
	private $sender_name = null;
	
	function __construct() {
		$this->host = Registry::lookupConfig('mail_host');
		$this->port = Registry::lookupConfig('mail_port');
		$this->username = Registry::lookupConfig('mail_username');
		$this->password = Registry::lookupConfig('mail_password');
		$this->sender_id = Registry::lookupConfig('sender_id');
		$this->sender_name = Registry::lookupConfig('sender_name');
	}
	
	public function sendMail($recipient, $messageText, $messageHTML, $subject) {
		
		$transport = Swift_SmtpTransport::newInstance($this->host, $this->port)
		  ->setUsername($this->username)
		  ->setPassword($this->password);
		
		$mailer = Swift_Mailer::newInstance($transport);
		
		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array($this->sender_id => $this->sender_name))
		  ->setTo(array($recipient))
		  ->setBody($messageText, 'text/plain')
		  ->addPart($messageHTML, 'text/html');
		
		$result = $mailer->send($message);
		
		return $result;
	}
	
	public function spoolMail($recipient, $messageText, $messageHTML, $subject) {
		
		$spool = new Swift_FileSpool(PATH_APPDATA.'mailspool');
		
		$transport = Swift_SpoolTransport::newInstance($spool);
		$mailer = Swift_Mailer::newInstance($transport);
		
		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array($this->sender_id => $this->sender_name))
		  ->setTo(array($recipient))
		  ->setBody($messageText, 'text/plain')
		  ->addPart($messageHTML, 'text/html');
		  
		$result = $mailer->send($message);
		
		return $result;  
	}
	
	public function sendSpooledMails() {
		
		$spool = new Swift_FileSpool(PATH_APPDATA.'mailspool');
		
		$spoolTransport = Swift_SpoolTransport::newInstance($spool);
		
		$realTransport = Swift_SmtpTransport::newInstance($this->host, $this->port)
		  ->setUsername($this->username)
		  ->setPassword($this->password);
		  
	  	$spool = $spoolTransport->getSpool();
		$spool->setMessageLimit(10);
		$spool->setTimeLimit(100);
		
		$sent = $spool->flushQueue($realTransport);
		
		if($sent == 1) echo "Spooled mails sent.\n";
		
		return $sent;
	}
	
}

?>