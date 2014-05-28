<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('home.css');
	Helper::addDependancy('moment.min.js');
	Helper::addDependancy('utilities.js');
	Helper::addDependancy('home.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php
	$people = $view_vars[0];
	$events = $view_vars[1]; 
?>

<div id="home-sidebar" class="col-md-2" data-spy="affix">
	<?php Helper::addViewComponent('home-sidebar', 0); ?>
</div>

<div id="home-feed" class="col-md-6 col-md-offset-2">
	<?php Helper::addViewComponent('home-feed', $events); ?>
</div>

<div id="home-people" class="col-md-4">
	<?php Helper::addViewComponent('home-people', $people); ?>
</div>