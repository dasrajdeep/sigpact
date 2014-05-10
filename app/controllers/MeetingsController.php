<?php

class MeetingsController {
	
	public function helpAutoComplete() {
		
		$name = $_REQUEST['query'];
		
		$search = new Search();
		
		return $search->findPeopleByName($name);
	}
}
 
?>