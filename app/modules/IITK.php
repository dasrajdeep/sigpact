<?php

class IITK {
	
	public function verifyEmailID($email) {
		
		$institute_id = substr($email, 0, strpos($email, '@'));
		
		$oa_url = 'http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITK_SrchStudMail.jsp?selstudmail='.$institute_id;
		
		$con = curl_init();
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		curl_close($con);
		
		$success = preg_match("/numtxt=([A-Za-z]*[0-9]+)/", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$roll_no = $results[1];
		
		$studentInfo = $this->getStudentInfo($content);
		
		return $studentInfo;
	}
	
	// Name, Roll, Department, Programme, Sex
	public function getStudentInfo($content) {
		
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
		
		// Add support of Department, Programme, Sex
		// Add empty fields for photo, aboutme
		
		return $user;
	}
	
	public function getProfessorInfo($email) {}
	
}

?>