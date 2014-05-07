<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('meetings.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container">
	<h1>YOUR MEETINGS</h1>
	<a href="javascript:showArrangeMeetingDialog()"><h4><span class="glyphicon glyphicon-phone-alt"></span> Arrange a Meeting</h4></a>
	
	<div>
		<?php Helper::addViewComponent('meetings-create'); ?>
	</div>
	
	<div>
		<?php Helper::addViewComponent('meetings-list', $view_vars); ?>
	</div>
</div>