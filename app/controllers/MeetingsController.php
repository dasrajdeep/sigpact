<?php

class MeetingsController {
	
	public function helpAutoComplete() {
		
		$name = $_REQUEST['query'];
		
		$search = new Search();
		
		return $search->findPeopleByName($name);
	}
	
	public function createMeeting() {
		
		$num_participants = $_POST['num_participants'];
		
		$guests = array();
		
		if($num_participants === 'few') {
			$guests[trim($_POST['participants'])] = 1;
			$list = array_filter(explode(',', $_POST['attendee_list']));
			foreach($list as $guest) $guests[trim($guest)] = 1;
		}
		
		$agenda = $_POST['agenda'];
		$venue = $_POST['venue'];
		$date = $_POST['date'];
		$time = $_POST['time'];
		$duration = $_POST['duration'];
		$description = $_POST['description'];
		
		$meetings = new Meeting();
		
		$date = str_replace('/', '-', $date);
		$datetime = strtotime($date.' '.$time);
		//echo date(DATE_RFC2822, $datetime);
		
		$meeting_id = $meetings->createNewMeeting(Session::getUserID(), $agenda, $venue, $datetime, $duration, $description);
		
		if($meeting_id) {
			$guest_emails = array();
			foreach(array_keys($guests) as $guest) {
				$email = substr($guest, strpos($guest, '(') + 1, -1);
				array_push($guest_emails, $email);
			}
			
			if($num_participants === 'all') $meetings->inviteToMeeting($meeting_id, Session::getUserID());
			else $meetings->inviteToMeeting($meeting_id, Session::getUserID(), $guest_emails);
			
			return TRUE;
		} else return FALSE;
	}

	public function showMeeting($args) {
		
		$meeting_id = $args[0];
		
		$meetings = new Meeting();
		
		$meeting = $meetings->getMeeting($meeting_id);
		
		ViewManager::renderView('meetings-view', $meeting);
	}
	
}
 
?>