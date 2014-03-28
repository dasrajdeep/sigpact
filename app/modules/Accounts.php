<?php

class Accounts {
	
	private $salt = 'sgsgfy34tpi34hti8poh90hp9i67';
	
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
			
			$text = sprintf("Hi %s, \n\nWelcome to SiGPACT @IIT Kanpur! Your account has been activated. You may now access your account using this link: %s .\n\n Happy researching! :)",
				$account->first_name, $activation_url);
			
			$mailer = new Mailer();
			$mailer->sendMail($email, $text, 'Account Activated.');
		}
		
		return $acc_no;
	}
	
	// Returns FALSE on failure to verify or account number on success or 0 on failure
	public function createAccountRequest($email) {
		
		$account = R::findOne('account', 'email=?', array($email));
		
		if($account) return -1;
		
		$user = $this->verifyEmail($email);
		
		if(!$user) return FALSE;
		
		$account = R::dispense('account');
		
		$account->email = $email;
		$account->password = null;
		$account->roll = $user['roll_no'];
		$account->full_name = $user['full_name'];
		$account->first_name = $user['first_name'];
		$account->status = 0;
		
		$acc_id = R::store($account);
		
		if($acc_id) {
			$users = R::find('account', 'status=?', array(2));
			
			if(count($users) == 0) return $acc_id;
			
			$hash = md5(time().rand(0, 65535));
			$confirmation_url = BASE_URI.'activate/'.$hash;
			
			$activation = R::dispense('activation');
			$activation->email = $email;
			$activation->hash = $hash;
			if(!R::store($activation)) return $acc_id;
			
			$mailer = new Mailer();
			
			$text = sprintf('An account has been requested by %s (%s). Click on the following link to confirm/activate this account: %s .', 
				$user['full_name'], $email, $confirmation_url);
			
			foreach($users as $admin) {
				$mailer->sendMail($admin->email, $text, 'New Account Request');
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
			return $account->id;
		}
		
		return FALSE;
	}
	
	// Returns FALSE on failure or the user details on success
	public function verifyEmail($email) {
		
		$institute_id = substr($email, 0, strpos($email, '@'));
		
		$oa_url = 'http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITK_SrchStudMail.jsp?selstudmail='.$institute_id;
		
		$con = curl_init();
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		
		$success = preg_match("/numtxt=([A-Za-z]*[0-9]+)/", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$roll_no = $results[1];
		
		$success = preg_match("/<td class=\"TableText\">\\s+([a-zA-Z. ]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$full_name = trim($results[1]);
		
		$name_parts = explode(" ", $full_name);
		
		$first_name = $name_parts[0];
		
		$user = array(
			'email' => $email,
			'roll_no' => $roll_no,
			'full_name' => $full_name,
			'first_name' => $first_name
		);
		
		return $user;
	}
	
	// Returns TRUE if hash exists or FALSE otherwise
	public function verifyFirstRun($hash) {
		
		$firstrun = R::find('firstrun', 'hash=?', array($hash));
		
		if($firstrun) return TRUE;
		else return FALSE;
	}
}

?>