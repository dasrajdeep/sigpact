<?php

class Mailer {
	
	private static $spool_location = 'data/_spool';
	
	private static $host = null;
	private static $port = null;
	private static $username = null;
	private static $password = null;
	private static $sender_id = null;
	private static $sender_name = null;
	
	public static function init() {
		self::$host = Registry::lookupConfig(Registry::CONFIG_TYPE_MAIL, 'smtp_host');
		self::$port = Registry::lookupConfig(Registry::CONFIG_TYPE_MAIL, 'smtp_port');
		self::$username = Registry::lookupConfig(Registry::CONFIG_TYPE_MAIL, 'smtp_username');
		self::$password = Registry::lookupConfig(Registry::CONFIG_TYPE_MAIL, 'smtp_password');
		self::$sender_id = Registry::lookupConfig(Registry::CONFIG_TYPE_MAIL, 'sender_email');
		self::$sender_name = Registry::lookupConfig(Registry::CONFIG_TYPE_MAIL, 'sender_name');
	}
	
	public static function sendMail($recipient, $messageText, $messageHTML, $subject) {
		
		$transport = Swift_SmtpTransport::newInstance(self::$host, self::$port)
		  ->setUsername(self::$username)
		  ->setPassword(self::$password);
		
		$mailer = Swift_Mailer::newInstance($transport);
		
		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array(self::$sender_id => self::$sender_name))
		  ->setTo(array($recipient))
		  ->setBody($messageText, 'text/plain')
		  ->addPart($messageHTML, 'text/html');
		
		$result = $mailer->send($message);
		
		return $result;
	}
	
	public static function spoolMail($recipient, $messageText, $messageHTML, $subject) {
		
		$spool = new Swift_FileSpool(self::$spool_location);
		
		$transport = Swift_SpoolTransport::newInstance($spool);
		$mailer = Swift_Mailer::newInstance($transport);
		
		$message = Swift_Message::newInstance($subject)
		  ->setFrom(array(self::$sender_id => self::$sender_name))
		  ->setTo(array($recipient))
		  ->setBody($messageText, 'text/plain')
		  ->addPart($messageHTML, 'text/html');
		  
		$result = $mailer->send($message);
		
		return $result;  
	}
	
	public static function sendSpooledMails() {
		
		$spool = new Swift_FileSpool(self::$spool_location);
		
		$spoolTransport = Swift_SpoolTransport::newInstance($spool);
		
		$realTransport = Swift_SmtpTransport::newInstance(self::$host, self::$port)
		  ->setUsername(self::$username)
		  ->setPassword(self::$password);
		  
	  	$spool = $spoolTransport->getSpool();
		$spool->setMessageLimit(10);
		$spool->setTimeLimit(100);
		
		$sent = $spool->flushQueue($realTransport);
		
		if($sent == 1) echo "Spooled mails sent.\n";
		
		return $sent;
	}
	
}

?>