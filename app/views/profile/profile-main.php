<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container">
	<div id="profile-info" class="panel panel-default">
		<div class="panel-body">
			<?php Helper::addViewComponent('profile-info', $view_vars); ?>
		</div>
	</div>
	
	<div id="profile-info" class="panel panel-default">
		<div class="panel-body">
			<?php Helper::addViewComponent('profile-tabs', $view_vars); ?>
		</div>
	</div>
</div>