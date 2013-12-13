<?php

function load_module($moduleName) {
	
	$moduleFile=$moduleName.'.php';
	
	require_once($moduleFile);
}

?>