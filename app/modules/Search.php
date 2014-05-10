<?php

class Search {
	
	public function findPeopleByName($name) {
		
		$query = "SELECT full_name,id,email FROM account WHERE full_name LIKE :name";
		
		$results = R::getAll($query, array(':name'=>'%'.$name.'%'));
		
		$found_names = array();
		
		foreach($results as $row) {
			array_push($found_names, $row['full_name']);
		}
		
		return $found_names;
	}
}
 
?>