<?php

class Profile {
	
	// Must supply roll_no, full_name, first_name, department, programme and sex
	public function createUserAccount($email, $userData) {
		
		$account = R::dispense('account');
		
		$account->email = $email;
		$account->password = null;
		$account->roll = $userData['roll_no'];
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
	
	public function updatePhoto($email, $photoFile) {
		
		$account = R::find('account', 'email=:email', array(':email' => $email));
		
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
		
		if($id) return TRUE;
		else return FALSE;
	}
	
	public function updateAboutInfo($email, $info) {
		
		$account = R::find('account', 'email=:email', array(':email' => $email));
		
		if(!$account) return FALSE;
		
		$account->about_me = $info;
		
		$id = R::store($account);
		
		if($id) return TRUE;
		else return FALSE;
	}
	
	public function getCompleteProfileInfo($email) {
		
		$account = R::find('account', 'email=:email', array(':email' => $email));
		$photo = R::load('photo', $account->photo_id);
		
		return array($account, $photo);
	}
	
	public function getPreviewProfileInfo($email) {}
	
}

?>