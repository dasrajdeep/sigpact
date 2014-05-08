<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('profile.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('profile-photo-dialog'); ?>
<?php Helper::addViewComponent('profile-aboutme-dialog', $view_vars); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

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