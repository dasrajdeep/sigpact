<?php defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo Registry::lookupConfig(Registry::CONFIG_TYPE_APP, 'title'); ?></title>
	<?php
		if(file_exists(BASE_DIR.'favicon.ico')) {
			echo sprintf('<link rel="shortcut icon" href="%sfavicon.ico" type="image/x-icon">',BASE_URI);
			echo sprintf('<link rel="icon" href="%sfavicon.ico" type="image/x-icon">',BASE_URI);
		}
	?>
	<?php 
		ViewManager::add_bootscript();
		ViewManager::add_dependancies();
		ViewManager::add_custom_head_content(); 
	?>
</head>

<body>
	<?php if(isset($html_body)) echo $html_body; ?>
</body>

</html>
