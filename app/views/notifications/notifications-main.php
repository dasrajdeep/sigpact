<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container" style="text-align: center">
	<h1>YOUR NOTIFICATIONS</h1>
	
	<div class="jumbotron">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php for($i=0;$i<20;$i++) echo '<h2>Test Notification</h2>'; ?>
			</div>
		</div>
	</div>
</div>