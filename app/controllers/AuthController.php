<?php

class AuthController {
	
	public function requestAccount() {
		
		$email = $_POST['email'];
		
		$accounts = new Accounts();
		
		$success = $accounts->createAccountRequest($email);
		
		return $success;
	}
	
	public function login() {
		
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$accounts = new Accounts();
		
		$success = $accounts->authenticateUser($username, $password);
		
		return $success;
	}
	
	public function activateAccount($args) {
		
		$hash = $args[0];
		
		$accounts = new Accounts();
		$success = $accounts->confirmAccountRequest($hash);
		
		if($success) {
			ViewManager::renderView('account-confirmation');
		} else {
			ViewManager::renderView('account-failure');
		}
	}
	
	public function firstRun($args) {
		
		$hash = $args[0];
		
		$accounts = new Accounts();
		
		if($accounts->verifyFirstRun($hash)) {
			ViewManager::renderView('firstrun-password', $hash);
		} else {
			header('Location: '.BASE_URI);
		}
	}
	
	public function createFirstPassword() {
		
		$hash = $_POST['hash'];
		$password = $_POST['password'];
		
		$accounts = new Accounts();
		
		$success = $accounts->createPassword($hash, $password);
		
		if($success) {
			header('Location: '.BASE_URI);
		} else {
			ViewManager::renderView('firstrun-failed');
		}
	}
}

?>