<?php

class ProfileController {
	
	public function updateProfilePhoto() {
		
		if(!isset($_POST['marker'])) return null;
		
		$acc_no = Session::getUserID();
		
		$file_path = $_FILES['photo']['tmp_name'];
		
		$profile = new Profile();
		
		return $profile->updatePhoto($acc_no, $file_path);
	}
	
	public function updateAboutMe() {
		
		if(!isset($_POST['marker'])) return null;
		
		$acc_no = Session::getUserID();
		
		$aboutme = $_POST['aboutme'];
		
		$profile = new Profile();
		
		return $profile->updateAboutInfo($acc_no, $aboutme);
	}
	
}

?>