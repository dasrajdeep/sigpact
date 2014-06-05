<?php

class Profile {
	
	// Must supply roll_no, full_name, first_name, department, programme and sex
	public function createUserAccount($email, $userData) {
		
		$account = R::dispense('account');
		
		$account->email = $email;
		$account->password = null;
		$account->id_no = $userData['id_no'];
		$account->full_name = $userData['full_name'];
		$account->first_name = $userData['first_name'];
		$account->department = $userData['department'];
		$account->programme = $userData['programme'];
		$account->sex = $userData['sex'];
		
		$account->photo_id = null;
		$account->about_me = '';
		
		$account->status = 0;
		
		$acc_id = R::store($account);
		
		return $acc_id;
	}
	
	public function updatePhoto($acc_no, $photoFile) {
		
		$account = R::load('account', $acc_no);
		
		if(!$account) return FALSE;
		
		$graphics = new Graphics();
		
		$image = $graphics->createImageString($photoFile);
		$mime = $graphics->getMIME($photoFile);
		
		$image_standard = $graphics->resizeImageString($image, $mime, 500, 500);
		$image_thumbnail = $graphics->resizeImageString($image, $mime, 150, 150);
		
		$photo = R::dispense('photo');
		
		$photo->user_id = $account->id;
		$photo->mime = $mime;
		$photo->standard = base64_encode($image_standard);
		$photo->thumbnail = base64_encode($image_thumbnail);
		
		$photo_id = R::store($photo);
		
		if(!$photo_id) return FALSE;
		
		if($account->photo_id !== null) {
			$old_photo = R::load('photo', $account->photo_id);
			R::trash($old_photo);
		}
		
		$account->photo_id = $photo_id;
		
		$id = R::store($account);
		
		if($id) {
			Event::trigger('PROFILE_UPDATE_PHOTO', $acc_no, null);
			return TRUE;
		} else return FALSE;
	}
	
	public function updateAboutInfo($acc_no, $info) {
		
		$account = R::load('account', $acc_no);
		
		if(!$account) return FALSE;
		
		$account->about_me = $info;
		
		$id = R::store($account);
		
		if($id) {
			Event::trigger('PROFILE_UPDATE_ABOUTME', $acc_no, null);
			return TRUE;
		} else return FALSE;
	}
	
	public function getCompleteProfileInfo($id) {
		
		/*$query = "SELECT account.id AS acc_no,first_name,last_name,organization,location,
			(CASE avatar_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM graphic WHERE graphic.id=`profile`.avatar_id) END) AS avatar_thumb,
			(CASE cover_picture_id WHEN NULL THEN NULL ELSE (SELECT original FROM graphic WHERE graphic.id=`profile`.cover_picture_id) END) AS cover_full  
		FROM account INNER JOIN `profile`
		ON account.id=`profile`.id
		WHERE account.id=:acc_no";*/
		
		if(is_numeric($id)) {
			$account = R::load('account', $id);
		} else {
			$account = R::find('account', 'email=:email', array(':email' => $email));
		}
		
		$photo = R::load('photo', $account->photo_id);
		
		return array($account, $photo);
	}
	
	public function getPreviewProfileInfo($email) {
		
		$profile_info = R::getRow("SELECT full_name,first_name,department,programme,sex,photo_id FROM account WHERE email=:email", 
			array(':email'=>$email));
			
		return $profile_info;
	}
	
	public function fetchAllProfiles($limit = null) {
		
		if($limit) $profiles = R::getAll('SELECT id,first_name,photo_id,email,id_no FROM account LIMIT '.$limit);
		else $profiles = R::getAll('SELECT id,first_name,photo_id,email,id_no FROM account');
		
		$photos = array();
		
		foreach($profiles as $profile) {
			if($profile['photo_id'] != null) {
				$photo = R::load('photo', $profile['photo_id']);
				$photos[$profile['id_no']] = $photo;
			} else $photos[$profile['id_no']] = null;
		}
		
		return array($profiles, $photos);
	}
	
}

?>