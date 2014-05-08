<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container" style="text-align: center">
	<h1>YOUR ACCOUNT SETTINGS</h1>
	
	<div class="jumbotron">
		<div class="panel panel-default">
			<div class="panel-body">
				<!-- Privacy: me, professors, everyone, custom -->
			</div>
		</div>
	</div>
</div>