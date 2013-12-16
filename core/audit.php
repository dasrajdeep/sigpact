<?php

if($production) {
	
	$client_address=$_SERVER['REMOTE_ADDR'];
	$request_uri=$_SERVER['REQUEST_URI'];
	$request_method=$_SERVER['REQUEST_METHOD'];
	$request_query=$_SERVER['QUERY_STRING'];
	
	$audit_log=fopen('.audit','a+');
	
	fwrite($audit_log,sprintf('"%s","%s","%s","%s"',$client_address,$request_uri,$request_method,$request_query)."\n");
	
	fclose($audit_log);
}

?>
