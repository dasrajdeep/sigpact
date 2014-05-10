<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('home.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div id="home-sidebar" class="col-md-2" data-spy="affix">
	<?php Helper::addViewComponent('home-sidebar', 0); ?>
</div>

<div id="home-feed" class="col-md-6 col-md-offset-2">
	<?php Helper::addViewComponent('home-feed'); ?>
</div>

<div id="home-people" class="col-md-4">
	<?php Helper::addViewComponent('home-people', $view_vars); ?>
</div>