<?php

class Accounts {
	
	private $salt = 'sgsgfy34tpi34hti8poh90hp9i67';
	
	// Returns TRUE if the session could be started or FALSE otherwise
	public function startUserSession($userid) {
		
		if(is_numeric($userid)) {
			
			$account = R::load('account', $userid);
			
			if(!$account) return FALSE;
			
			$email = $account->email;
			
			Session::start($userid);
			Session::setVar('email', $email);
			Session::setVar('name', Utilities::convertToCapitalCase($account->full_name));
			Session::setVar('first_name', Utilities::convertToCapitalCase($account->first_name));
			
			return TRUE;
		} else {
			
			$account = r::findOne('account', 'email=?', array($userid));
			
			if(!$account) return FALSE;
			
			$email = $account->email;
			
			Session::start($account->id);
			Session::setVar('email', $email);
			Session::setVar('name', Utilities::convertToCapitalCase($account->full_name));
			Session::setVar('first_name', Utilities::convertToCapitalCase($account->first_name));
			
			return TRUE;
		}
	}
	
	// Returns TRUE on success or FALSE on failure
	public function updateUserAccount($acc_no, $password = null, $full_name = null) {
		
		$account = R::load('account', $acc_no);
		
		if(!$account) return FALSE;
		
		if($password) {
			$account->password = md5($password.$this->salt);
		}
		
		if($full_name) {
			$full_name = trim($full_name);
			$account->full_name = $full_name;
			$name_parts = explode(" ", $full_name);
			$account->first_name = $name_parts[0];
		}
		
		$acc_no = R::store($account);
		
		if($acc_no) return TRUE;
		else return FALSE;
	}
	
	// Returns TRUE on success or FALSE on failure
	public function authenticateUser($email, $password) {
		
		$account = R::findOne('account', 'email=?', array($email));
		
		if(!$account) return FALSE;
		
		if(!$account->status) return FALSE;
		
		if(R::findOne('firstrun', 'email=?', array($email))) return FALSE;
		
		$hashed_password = md5($password.$this->salt);
		
		if($account->password === $hashed_password) return TRUE;
		else return FALSE;
	}
	
	// Returns FALSE if account request does not exist or account number if successful or 0 on failure
	public function confirmAccountRequest($hash) {
		
		$verification = R::findOne('activation', 'hash=?', array($hash));
		
		if(!$verification) return FALSE;
		
		$email = $verification->email;
		
		$account = R::findOne('account', 'email=?', array($email));
		
		if(!$account) return FALSE;
		
		$account->status = 1;
		
		$acc_no = R::store($account);
		
		if($acc_no) {
			
			R::trash($verification);
			
			$hash = md5(time().rand(0, 65535));
			$activation_url = BASE_URI.'firstrun/'.$hash;
			
			$activation = R::dispense('firstrun');
			$activation->email = $email;
			$activation->hash = $hash;
			R::store($activation);
			
			$mail_content = Utilities::generateMailContent(Utilities::MAIL_CONFIG_ACCOUNT_ACTIVATED, 
				array('first_name'=>$account->first_name, 'link'=>$activation_url));
			
			$mailer = new Mailer();
			
			$mailer->spoolMail($email, $mail_content[0], $mail_content[1], 'SiGPACT Account Activated');
		}
		
		return $acc_no;
	}
	
	// Returns FALSE on failure to verify or account number on success or 0 on failure
	public function createAccountRequest($email) {
		
		$account = R::findOne('account', 'email=?', array($email));
		
		if($account) return -1;
		
		$user = $this->verifyEmail($email);
		
		if(!$user) return FALSE;
		
		$profile = new Profile();
		
		$acc_id = $profile->createUserAccount($email, $user);
		
		if($acc_id) {
			$users = R::find('account', 'status=?', array(2));
			
			if(count($users) == 0) return $acc_id;
			
			$hash = md5(time().rand(0, 65535));
			$confirmation_url = BASE_URI.'activate/'.$hash;
			
			$activation = R::dispense('activation');
			$activation->email = $email;
			$activation->hash = $hash;
			if(!R::store($activation)) return $acc_id;
			
			$profile = R::load('account', $acc_id);
			
			$mailer = new Mailer();
			
			foreach($users as $admin) {
				
				$mail_content = Utilities::generateMailContent(Utilities::MAIL_CONFIG_ACCOUNT_REQUESTED, array('link'=>$confirmation_url, 'profile'=>$profile));
				$mailer->spoolMail($admin->email, $mail_content[0], $mail_content[1], 'Request to join SiGPACT');
			}
		}
		
		return $acc_id;
	}
	
	// Returns account number if password was created or FALSE otherwise
	public function createPassword($hash, $password) {
		
		$firstrun = R::findOne('firstrun', 'hash=?', array($hash));
		
		if(!$firstrun) return FALSE;
		echo 'firstrun';
		$account = R::findOne('account', 'email=?', array($firstrun->email));
		
		if(!$account) return FALSE;
		echo 'account';
		$account->password = md5($password.$this->salt);
		
		$acc_no = R::store($account);
		
		if($acc_no) {
			R::trash($firstrun);
			Event::trigger('USER_REGISTER', $account->id, null);
			return $account->id;
		}
		
		return FALSE;
	}
	
	// Returns FALSE on failure or the user details on success
	public function verifyEmail($email) {
		
		$iitk = new IITK();
		
		return $iitk->verifyEmailID($email);
	}
	
	// Returns TRUE if hash exists or FALSE otherwise
	public function verifyFirstRun($hash) {
		
		$firstrun = R::find('firstrun', 'hash=?', array($hash));
		
		if($firstrun) return TRUE;
		else return FALSE;
	}
	
}

?>