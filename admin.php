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
	
	echo "Enter:\n";
	echo "[1] Create new user.\n";
	echo "[2] Confirm user.\n";
	
	$stdin = fopen('php://stdin', 'r');
	
	$choice = fgets($stdin);
	
	if($choice == 1) {
		echo "Enter the email ID of the user that you want to add: ";
		$email = fgets($stdin);
		create_new_user($email);
	} else if($choice == 2) {
		echo "Enter the email ID of the user that you want to confirm: ";
		$email = trim(fgets($stdin));
		confirm_new_user($email);
	} else {
		echo "You have not entered a valid choice.\n";
	}
	
	function create_new_user($email, $status = 1) {
		
		$institute_id = substr($email, 0, strpos($email, '@'));
		
		$oa_url = 'http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITK_SrchStudMail.jsp?selstudmail='.$institute_id;
		
		$con = curl_init();
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		
		$success = preg_match("/numtxt=([A-Za-z]*[0-9]+)/", $content, $results);
		
		if(!$success) {
			echo "Could not verify this email ID!\n";
			return;
		}
		
		$roll_no = $results[1];
		
		$success = preg_match("/<td class=\"TableText\">\\s+([a-zA-Z. ]+)\\s*</", $content, $results);
		
		if(!$success) {
			echo "Could not verify this email ID!\n";
			return;
		}
		
		$full_name = trim($results[1]);
		
		$name_parts = explode(" ", $full_name);
		
		$first_name = $name_parts[0];
		
		$account = R::dispense('account');
		
		$account->email = $email;
		$account->password = null;
		$account->roll = $roll_no;
		$account->full_name = $full_name;
		$account->first_name = $first_name;
		$account->status = $status;
		
		$acc_id = R::store($account);
		
		if($acc_id) {
			echo "Account created.\n";
		} else {
			echo "Account could not be created!\n";
		}
	}
	
	function confirm_new_user($email, $status = 1) {
		
		$account = R::findOne('account', 'email=?', array($email));
		
		if(!$account) {
			echo "This email ID has not been found in the set of pending requests.\n";
			return;
		}
		
		$account->status = $status;
		
		$acc_no = R::store($account);
		
		if($acc_no) {
			$mailer = new Mailer();
			$mailer->sendMail($email, 'Your account has been activated by the administrator. You may now login to your account.', 'Account Activated');
			echo "Account has been activated.\n";
		} else {
			echo "Account could not be activated.\n";
		}
	}
	
?>