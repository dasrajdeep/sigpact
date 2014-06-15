<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('messages.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

<div class="container">
	<h1>YOUR MESSAGES</h1>
	
	<div class="col-md-3">
		<ul class="nav nav-pills nav-stacked" style="font-size: 30px">
			<li id="pill-inbox" class="active"><a href="#" onclick="showInbox()">Inbox</a></li>
			<li id="pill-sentbox"><a href="#" onclick="showSentbox()">Sent Items</a></li>
		</ul>
	</div>
	
	<div class="col-md-9">
		<?php Helper::addViewComponent('messages-view', $view_vars); ?>
	</div>
</div>