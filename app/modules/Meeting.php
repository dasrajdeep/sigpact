<?php

class Meeting {
	
	// Includes creator, venue, date & time, duration, description
	public function createNewMeeting($creator_id, $agenda, $venue, $datetime, $duration, $description = null) {
		
		$meeting = R::dispense('meeting');
		
		$meeting->creator = $creator_id;
		$meeting->agenda = $agenda;
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
			foreach($guest_emails as $email) array_push($guests, $email['email']);
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
		
		foreach(array_keys($files) as $file) {
			
			$filename = $file;
			$filepath = $files[$file];
			move_uploaded_file($filepath, $dest_path.$filename);
			
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
		
		$query = "SELECT meeting.id AS meeting_id,agenda,datetime 
			FROM meeting 
			WHERE meeting.id IN (SELECT meeting_id FROM participant WHERE participant=:participant) 
			ORDER BY datetime DESC";
		
		$meetings = R::getAll($query, array(':participant'=>$acc_no));
		
		return $meetings;
	}
	
	public function getMeeting($meeting_id) {
		
		$query = "SELECT meeting.id AS meeting_id,minutes,agenda,venue,datetime,duration,description,full_name,account.id AS acc_no,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS thumbnail,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime  
			FROM meeting INNER JOIN account 
			ON meeting.creator=account.id 
			WHERE meeting.id=:meeting_id";
		
		$row = R::getAssocRow($query, array(':meeting_id'=>$meeting_id));
		
		$meeting = $row[0];
		
		$query = "SELECT first_name,account.id AS acc_no,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS thumbnail,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime  
			FROM account 
			WHERE account.id IN (SELECT participant FROM participant WHERE meeting_id=:meeting_id)";
		
		$participants = R::getAll($query, array(':meeting_id'=>$meeting_id));
		
		$query = "SELECT id,filename FROM crumb WHERE crumbtype='MEETING' AND refid=:meeting_id";
		
		$crumbs = R::getAll($query, array(':meeting_id'=>$meeting_id));
		
		return array('meeting'=>$meeting, 'participants'=>$participants, 'files'=>$crumbs);
	}
	
}

?>