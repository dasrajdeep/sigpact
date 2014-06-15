<?php

class Bitbucket {
	
	private $callback_url = BASE_URI;
	
	private $username = '';
	private $password = '';
	
	private $url_api_v2 = 'https://bitbucket.org/api/2.0';
	private $url_api_v1 = 'https://bitbucket.org/api/1.0';
	
	function createRepository($name) {
		
		$url = $this->url_api_v1.'/repositories';
		
		$data = array('name'=>$name);
		
		$response = $this->postHTTPRequest($url, $data);
		
		return $response;
	}
	
	private function getHTTPRequest($url) {
		
		$con = curl_init();
		
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $url);
		curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($con, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($con, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($con, CURLOPT_USERPWD, $this->username.":".$this->password);
		
		$content = curl_exec($con);

		$status_code = curl_getinfo($con, CURLINFO_HTTP_CODE);
		
		curl_close($con);
		
		return $content;
	}
	
	private function postHTTPRequest($url, $data) {
				
		$con = curl_init();
		
		curl_setopt($con, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($con, CURLOPT_URL, $url);
		curl_setopt($con, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($con, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($con, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
		curl_setopt($con, CURLOPT_USERPWD, $this->username.":".$this->password);
		curl_setopt($con, CURLOPT_POST, true);
		curl_setopt($con, CURLOPT_POSTFIELDS, $data);
		
		$content = curl_exec($con);

		$status_code = curl_getinfo($con, CURLINFO_HTTP_CODE);
		
		curl_close($con);
		
		return $content;
	}
	
}

?>