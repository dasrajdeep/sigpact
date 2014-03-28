<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
?>

<div class="container">
	<?php Helper::addViewComponent('landing-header'); ?>

	<div class="jumbotron" style="text-align: center;">
		<h1>Account NOT Activated</h1>
		<span>
			The account for this User could not be activated!
		</span>
	</div>
</div>