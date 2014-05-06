<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container">
	<h1>YOUR MEETINGS</h1>
	<a href="#"><h4><span class="glyphicon glyphicon-phone-alt"></span> Arrange a Meeting</h4></a>
	
	<div>
		<?php Helper::addViewComponent('meetings-list', $view_vars); ?>
	</div>
</div>