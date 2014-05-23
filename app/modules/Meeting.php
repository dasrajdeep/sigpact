<?php

class Meeting {
	
	// Includes creator, venue, date & time, duration, description
	public function createNewMeeting($creator_id, $venue, $datetime, $duration, $description = null) {
		
		$meeting = R::dispense('meeting');
		
		$meeting->creator = $creator_id;
		$meeting->venue = $venue;
		$meeting->datetime = $datetime;
		$meeting->duration = $duration;
		$meeting->description = $description;
		
		$meeting_id = R::store($meeting);
		
		if($meeting_id) Event::trigger('MEETING_CREATED', $creator_id, $meeting_id); 
		
		return $meeting_id;
	}
	
	public function inviteToMeeting($meeting_id, $inviter, $guests = null) {
		
		$mailer = new Mailer();
		
		$inviter_profile = R::load('account', $inviter);
		$meeting = R::load('meeting', $meeting_id);
		
		// Create list of guests.
		if($guests == null) {
			$guests = array();
			$guest_emails = R::getAll('SELECT email FROM account');
			foreach($guest_emails as $email) array_push($guests, $guest_emails['email']);
		}
		
		// Invite selected guests.
		foreach($guests as $email) {
			
			$account = R::findOne('account', 'email=?', array($email));
			
			if(!$account) continue;
			
			$participant = R::dispense('participant');
			
			$participant->meeting_id = $meeting_id;
			$participant->participant = $account->id;
			
			R::store($participant);
			
			$mail_content = Utilities::generateMailContent(Utilities::MAIL_CONFIG_MEETING_INVITATION, 
				array('first_name'=>$account->first_name, 'date'=>date('l,jS F',$meeting->datetime), 'time'=>date('h:i A',$meeting->datetime),
				'inviter'=>$inviter_profile->first_name, 'venue'=>$meeting->venue, 'description'=>$meeting->description));
			$mailer->spoolMail($email, $mail_content[0], $mail_content[1], 'SiGPACT Meeting Invitation');
		}
	}
	
	public function updateMeetingMinutes($acc_no, $meeting_id, $minutes = null, $files = array()) {
		
		$meeting = R::load('meeting', $meeting_id);
		
		if(!$meeting->id) return FALSE;
		
		if($minutes != null) $meeting->minutes = $minutes;
		
		if(count($files) > 0) mkdir(PATH_APPDATA.'meeting/meeting_'.$meeting_id);
		
		$dest_path = PATH_APPDATA.'meeting/meeting_'.$meeting_id.'/';
		
		$crumbs = new Crumbs();
		
		foreach($files as $file) {
			
			$filename = pathinfo($file, PATHINFO_BASENAME);
			move_uploaded_file($file, $dest_path.$filename);
			
			$crumbs->addCrumb($acc_no, $meeting_id, $filename, 'MEETING');
		}
		
		$success = R::store($meeting);
		
		if($success) Event::trigger('MEETING_UPDATED', $acc_no, $meeting_id);
		
		return $success;
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
		
		$comments = new Comments();
		
		return $comments->addComment('MEETING', $meeting_id, $commenter, $comment);
	}
	
	public function getUserMeetings($acc_no) {
		
		$query = "SELECT meeting.id AS meeting_id,venue,datetime,duration,description,full_name,mime,thumbnail,account.id AS acc_no 
			FROM meeting INNER JOIN account INNER JOIN photo 
			ON meeting.creator=account.id AND account.photo_id=photo.id
			WHERE meeting.id IN (SELECT meeting_id FROM participant WHERE participant=:participant) 
			ORDER BY datetime DESC";
		
		$meetings = R::getAll($query, array(':participant'=>$acc_no));
		
		return $meetings;
	}
	
}

?>