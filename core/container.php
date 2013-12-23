<?php defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo Registry::lookupConfig('app_title'); ?></title>
	<?php ViewManager::add_bootscript(); ?>
	<?php ViewManager::add_libraries(); ?>
	<?php ViewManager::add_dependancies(); ?>
</head>

<body>
	<?php if(isset($html_body)) echo $html_body; ?>
</body>

</html>
