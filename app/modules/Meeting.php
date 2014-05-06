<?php

class Meeting {
	
	// Includes venue, date & time, duration, description
	public function createNewMeeting($venue, $datetime, $duration, $description = null) {
		
		$meeting = R::dispense('meeting');
		
		$meeting->venue = $venue;
		$meeting->datetime = $datetime;
		$meeting->duration = $duration;
		$meeting->description = $description;
		
		return R::store($meeting);
	}
	
	public function inviteToMeeting($meeting_id, $inviter, $guests = null) {
		
		$mailer = new Mailer();
		
		$inviter_profile = R::load('account', $inviter);
		$meeting = R::load('meeting', $meeting_id);
		
		// Need to take participants into account
		if($guests == null) {
			$guest_emails = R::getAll('SELECT email FROM account');
			// Invite all guests
			foreach($guest_emails as $email) {
				$account = R::findOne('account', 'email=?', array($email));
				$mail_content = Utilities::generateMailContent(Utilities::MAIL_CONFIG_MEETING_INVITATION, 
					array('first_name'=>$account->first_name, 'date'=>date('l,jS F',$meeting->datetime), 'time'=>date('h:i A',$meeting->datetime),
					'inviter'=>$inviter_profile->first_name, 'description'=>$meeting->description));
				$mailer->spoolMail($email, $mail_content[0], $mail_content[1], 'SiGPACT Meeting Invitation');
			}
		} else {
			// Invite selected guests
			foreach($guests as $email) {
				$account = R::findOne('account', 'email=?', array($email));
				$mail_content = Utilities::generateMailContent(Utilities::MAIL_CONFIG_MEETING_INVITATION, 
					array('first_name'=>$account->first_name, 'date'=>date('l,jS F',$meeting->datetime), 'time'=>date('h:i A',$meeting->datetime),
					'inviter'=>$inviter_profile->first_name, 'description'=>$meeting->description));
				$mailer->spoolMail($email, $mail_content[0], $mail_content[1], 'SiGPACT Meeting Invitation');
			}
		}
	}
	
	public function updateMeetingMinutes($meeting_id, $minutes = null, $files = array()) {
		
		$meeting = R::load('meeting', $meeting_id);
		
		if(!$meeting->id) return FALSE;
		
		if($minutes != null) $meeting->minutes = $minutes;
		
		if(count($files) > 0) mkdir(PATH_APPDATA.'meeting/meeting_'.$meeting_id);
		
		$dest_path = PATH_APPDATA.'meeting/meeting_'.$meeting_id.'/';
		
		foreach($files as $file) {
			$filename = pathinfo($file, PATHINFO_BASENAME);
			move_uploaded_file($file, $dest_path.$filename);
			$crumb = R::dispense('crumb');
			$crumb->filename = $filename;
			$crumb->crumbtype = 'MEETING';
			$crumb->refid = $meeting_id;
			$crumb->timestamp = time();
			R::store($crumb);
		}
		
		return R::store($meeting);
	}
	
	public function updateMeeting($meeting_id, $venue = null, $datetime = null, $duration = null, $description = null) {
		
		$meeting = R::load('meeting', $meeting_id);
		
		if(!$meeting->id) return FALSE;
		
		if($venue != null) $meeting->venue = $venue;
		if($datetime != null) $meeting->datetime = $datetime;
		if($duration != null) $meeting->duration = $duration;
		if($description != null) $meeting->description = $description;
		
		return R::store($meeting);
	}
	
	public function addComment($meeting_id, $commenter, $comment) {
		
		$comment = R::dispense('comment');
		
		$comment->nodetype = 'MEETING';
		$comment->nodeid = $meeting_id;
		$comment->commenter = $commenter;
		$comment->comment = $comment;
		$comment->timestamp = time();
		
		return R::store($comment);
	}
	
}

?>