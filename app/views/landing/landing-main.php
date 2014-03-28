<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('landing.js');
?>

<div class="container">
	
	<div>
		<?php Helper::addViewComponent('landing-header'); ?>
	</div>
	
	<div class="col-md-6">
		<?php Helper::addViewComponent('landing-intro'); ?>
	</div>
	
	<div class="col-md-6">
		<?php Helper::addViewComponent('landing-auth'); ?>
	</div>
	
</div>