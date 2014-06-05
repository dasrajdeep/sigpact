<?php

class IITK {
	
	/*
	 * Verifies if the email ID is a valid IITK email ID or not.
	 * Also fetches the profile information associated with the email ID.
	 * Profile information includes the following:
	 * Name, Roll, Department, Programme, Sex
	 */
	public function verifyEmailID($email) {
		
		return $this->getStudentInfo($email);
	}
	
	// Name, Roll, Department, Programme, Sex
	public function getStudentInfo($email) {
		
		$institute_id = substr($email, 0, strpos($email, '@'));
		
		$oa_url = 'http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITK_SrchStudMail.jsp?selstudmail='.$institute_id;
		
		$con = curl_init();
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		
		// Matches roll number.
		$success = preg_match("/numtxt=([A-Za-z]*[0-9]+)/", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$roll_no = $results[1];
		
		$oa_url = sprintf('http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITk_SrchRes.jsp?typ=stud&numtxt=%s&sbm=Y', $roll_no);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		curl_close($con);
		
		// Matches full name.
		$success = preg_match("/<b>Name: <\/b>\\s*([A-Za-z ]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$full_name = trim($results[1]);
		
		$name_parts = explode(" ", $full_name);
		
		$first_name = $name_parts[0];
		
		// Matches sex.
		$success = preg_match("/<b> Gender:<\/b>\\s*([A-Za-z]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$sex = $results[1];
		
		// Matches department.
		$success = preg_match("/<b>Department: <\/b>\\s*([A-Za-z .&]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$department = $results[1];
		
		// Matches programme.
		$success = preg_match("/<b>Program: <\/b>\\s*([A-Za-z ]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$programme = $results[1];
		
		$user = array(
			'email' => $email,
			'id_no' => $roll_no,
			'full_name' => Utilities::convertToCapitalCase($full_name),
			'first_name' => Utilities::convertToCapitalCase($first_name),
			'sex' => $sex,
			'department' => $department,
			'programme' => $programme
		);
		
		return $user;
	}
	
	// Name, PF_No, Department
	public function getProfessorInfo($email) {
		
		$institute_id = substr($email, 0, strpos($email, '@'));
		
		$oa_url = sprintf('http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITK_SrchStffMail.jsp?selstffmail=%s&sort=stffmail', $institute_id);
		
		$con = curl_init();
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		
		// Matches PF No.
		$success = preg_match("/numtxt=([A-Za-z]*[0-9]+)/", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$pf_no = $results[1];
		
		$oa_url = sprintf('http://oa.cc.iitk.ac.in:8181/Oa/Jsp/OAServices/IITk_SrchRes1.jsp?typ=stff&numtxt=%s&sbm=Y', $pf_no);
		curl_setopt($con, CURLOPT_URL, $oa_url);
		$content = curl_exec($con);
		curl_close($con);
		
		// Matches full name.
		$success = preg_match("/<b>Name: <\/b>\\s*([A-Za-z ]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$full_name = trim($results[1]);
		
		$name_parts = explode(" ", $full_name);
		
		$first_name = 'Prof. '.$name_parts[0];
		$full_name = 'Prof. '.$full_name;
		
		// Matches department.
		$success = preg_match("/<b>Department: <\/b>\\s*([A-Za-z .&]+)\\s*</", $content, $results);
		
		if(!$success) {
			return FALSE;
		}
		
		$department = $results[1];
		
		$professor = array(
			'email'=>$email,
			'id_no'=>$pf_no,
			'full_name'=>$full_name,
			'first_name'=>$first_name,
			'sex' => 'N/A',
			'department' => $department,
			'programme' => 'N/A'
		);
		
		return $professor;
	}
	
}

?>