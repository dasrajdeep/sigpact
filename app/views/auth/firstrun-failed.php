<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
?>

<div class="container">
	<?php Helper::addViewComponent('landing-header'); ?>

	<div class="jumbotron" style="text-align: center;">
		<h1>Unable To Create Password</h1>
		<span>
			Oops! Something went wrong. We were unable to create your password. You may try again after some time.
		</span>
	</div>
</div>