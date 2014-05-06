<?php

class Crumbs {
	
	public function addCrumb($acc_no, $ref_id, $filename, $crumb_type) {
		
		$crumb = R::dispense('crumb');
		
		$crumb->filename = $filename;
		$crumb->crumbtype = $crumb_type;
		$crumb->refid = $ref_id;
		$crumb->timestamp = time();
		
		return R::store($crumb);
	}
	
	public function getCrumbsByOwner($acc_no) {}
	
	public function getCrumbsByType($crumb_type, $ref_id) {}
	
	// Consider versioning.
	public function updateCrumb($crumb_id, $file_name) {}
	
}

?>