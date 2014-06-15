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

<div class="col-md-7 affix">
	<div id="menu" style="text-align: center">
		<?php Helper::addViewComponent('home-menu'); ?>
	</div>
	
	<div class="clearfix"></div>
	
	<div class="container" id="people">
		<?php Helper::addViewComponent('home-people', $people); ?>
	</div>
</div>

<div class="col-md-5 col-md-offset-7">
	<?php Helper::addViewComponent('home-feed', $events); ?>
</div>