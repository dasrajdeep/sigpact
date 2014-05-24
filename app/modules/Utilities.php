<?php

class Utilities {
	
	const MAIL_CONFIG_ACCOUNT_REQUESTED = 1;
	const MAIL_CONFIG_ACCOUNT_ACTIVATED = 2;
	const MAIL_CONFIG_MEETING_INVITATION = 3;
	
	public static function generateMailContent($config_id, $data) {
		
		$template_path = PATH_APPDATA.'mail-templates/';
		
		$mail_text = '';
		$mail_html = '';
		
		if($config_id == 1) {
			// Account Request
			$mail_text = file_get_contents($template_path.'account_request.txt');
			$mail_html = file_get_contents($template_path.'account_request.html');
			
			$link = $data['link'];
			$data = $data['profile'];
			
			$gender = ($data['sex'] === 'M') ? 'his':'her';
			
			$info_text = sprintf("Name: %s\nRoll: %s\nEmail: %s\nDepartment: %s\nProgramme: %s\n", $data['full_name'], $data['roll'], $data['email'], $data['department'], $data['programme']);
			$info_html = sprintf("Name: %s<br/>Roll: %s<br/>Email: %s<br/>Department: %s<br/>Programme: %s<br/>", $data['full_name'], $data['roll'], $data['email'], $data['department'], $data['programme']);
			
			$mail_text = sprintf($mail_text, $data['first_name'], $data['first_name'], $gender, $data['first_name'], $info_text, $link);
			$mail_html = sprintf($mail_html, $data['first_name'], $data['first_name'], $gender, $data['first_name'], $info_html, $link, $link);
		} else if($config_id == 2) {
			// Account confirm
			$mail_text = file_get_contents($template_path.'account_activated.txt');
			$mail_html = file_get_contents($template_path.'account_activated.html');
			
			$mail_text = sprintf($mail_text, $data['first_name'], $data['link']);
			$mail_html = sprintf($mail_html, $data['first_name'], $data['link'], $data['link']);
		} else if($config_id == 3) {
			// Meeting invitation
			$mail_text = file_get_contents($template_path.'meeting_invitation.txt');
			$mail_html = file_get_contents($template_path.'meeting_invitation.html');
			
			$mail_text = sprintf($mail_text, $data['first_name'], $data['date'], $data['time'], $data['inviter'], $data['venue'], $data['description']);
			$mail_html = sprintf($mail_html, $data['first_name'], $data['date'], $data['time'], $data['inviter'], $data['venue'], $data['description']);
		}
		
		return array($mail_text, $mail_html);
	}
	
	public static function convertToCapitalCase($text) {
		
		$parts = array_filter(explode(' ', $text));
		
		$convertedPieces = array();
		
		foreach($parts as $part) {
			$part = trim($part);
			$converted = strtoupper(substr($part, 0, 1)).strtolower(substr($part, 1));
			array_push($convertedPieces, $converted);
		}
		
		return implode(' ', $convertedPieces);
	}
	
	public static function shortenText($text, $maxLength) {
		
		if(strlen($text) <= $maxLength) return $text;
		
		$snip = strip_tags(substr($text, 0, $maxLength), '<b><br>');
		
		if(strlen($snip) < $maxLength) $snip = substr($text, 0, 2*$maxLength - strlen($snip)).'...';
		
		return $snip;
	}
	
	public static function convertToFullDate($timestamp) {
		
		return sprintf('%s, at %s', date('l jS F Y', $timestamp), date('g:i A', $timestamp));
		
	}
	
	public static function getFormatForTimeago($timestamp) {
		
		return date('dmYGis', $timestamp);
		
	}
	
}

?>