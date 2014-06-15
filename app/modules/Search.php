<?php

class Search {
	
	public function findPeopleByName($name) {
		
		$query = "SELECT full_name,id,email FROM account WHERE full_name LIKE :name";
		
		$results = R::getAll($query, array(':name'=>'%'.$name.'%'));
		
		$found_names = array();
		
		foreach($results as $row) {
			array_push($found_names, sprintf('%s (%s)', $row['full_name'], $row['email']));
		}
		
		return $found_names;
	}
}
 
?>