<?php
	
	$mode = php_sapi_name();
	
	if($mode !== 'cli') {
		die('YOU ARE NOT ALLOWED TO ACCESS THIS RESOURCE');
	}
	
	define('SYSTEM_STARTED', TRUE);
	
	require_once('app/environment.php');
	
	setlocale(LC_ALL,$env_locale);
	date_default_timezone_set($env_time_zone);
	
	require_once('core/bootstrap.php');
	
	$app_config = parse_ini_file('app/app.ini');
	
	$db_host = $app_config['database_host'];
	$db_name = $app_config['database_name'];
	$db_user = $app_config['database_username'];
	$db_pass = $app_config['database_password'];
	
	R::setup(sprintf('mysql:host=%s;dbname=%s',$db_host,$db_name),$db_user,$db_pass);
	
	echo "This interface allows you to add new users to the system. ";
	echo "You may add students or professors as users of the system. ";
	echo "A user must possess a valid IIT Kanpur email ID.\n\n";
	echo "A user has two types of privilege levels: admin and regular.";
	echo "Do you want to add an admin or regular user? Enter (admin/regular): ";
	
	$stdin = fopen('php://stdin', 'r');
	
	$choice = '';
	
	$privilege_level = 0;
	
	while( strcmp($choice, 'admin') != 0 && strcmp($choice, 'regular') != 0 ) {
			
		$choice = strtolower(trim(fgets($stdin)));
		
		if(strcmp($choice, 'admin') == 0) {
			// Add admin user
			$privilege_level = 2;
		} else if(strcmp($choice, 'regular') == 0) {
			// Add regular user
			$privilege_level = 1;
		} else {
			echo "\nYou have entered an invalid choice. Please enter either 'admin' or 'regular' without single quotes: ";
		}	
	}
	
	echo "\nNow please enter the email id of the user to be added. ";
	echo "(Note that the email ID must be a valid IIT Kanpur email ID): ";
	
	$email = strtolower(trim(fgets($stdin)));
	
	if(preg_match("/([a-zA-Z0-9]+@[a-zA-Z.]+)/", $email)) {
		$institute_id = substr($email, 0, strpos($email, '@'));	
		
		$iitk = new IITK();
		
		$user = $iitk->getStudentInfo($email);
		if($user === FALSE) $user = $iitk->getProfessorInfo($email);
		
		if($user === FALSE) {
			echo "\nCould not verify this email ID as a valid email ID of either a professor or student of IIT Kanpur.\n";
		} else {
			$profile = new Profile();
			$accounts = new Accounts();
			
			$acc_id = $profile->createUserAccount($email, $user);
			
			$account = R::load('account', $acc_id);
			$account->status = $privilege_level;
			R::store($account);
			
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
			
			echo "\nYou have added a new user to the system. ";
			echo "An activation link has been sent to the registered email ID. ";
			echo "This link is required in order to create a new password for the user. ";
			echo "The account cannot be accessed without visiting this link and creating a password.\n";
		}
	} else {
		echo "You have entered an invalid email ID. You have to restart the process.\n";
	}
	
?>