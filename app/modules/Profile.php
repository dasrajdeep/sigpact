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
		
		$query = "SELECT account.id AS acc_no,full_name,department,programme,email,about_me,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS photo,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime   
		FROM account ";
		
		if(is_numeric($id)) {
			$clause = "WHERE account.id=:id";
		} else {
			$clause = "WHERE account.email=:id";
		}
		
		$query = $query.$clause;
		
		$row = R::getAssocRow($query, array(':id'=>$id));
		
		if(count($row)) return $row[0];
		else return null;
	}
	
	public function fetchAllProfiles($limit = 1000) {
		
		$query = "SELECT account.id AS acc_no,full_name,first_name,email,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT thumbnail FROM photo WHERE photo.id=account.photo_id) END) AS photo,
			(CASE photo_id WHEN NULL THEN NULL ELSE (SELECT mime FROM photo WHERE photo.id=account.photo_id) END) AS mime   
		FROM account 
		LIMIT :limit";
		
		$profiles = R::getAll($query, array(':limit'=>$limit));
		
		return $profiles;
	}
	
}

?>