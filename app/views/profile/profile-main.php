<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('moment.min.js');
	Helper::addDependancy('utilities.js');
	Helper::addDependancy('profile.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php
	Helper::addViewComponent('progress-view'); 
 	Helper::addViewComponent('profile-photo-dialog');
 	Helper::addViewComponent('profile-aboutme-dialog', $view_vars);
 	Helper::addViewComponent('alert-dialog');
	
	$bg = Helper::getContentLink('cover-bg.png');
?>

<div class="container">
	
	<div id="profile-info" class="panel panel-default" 
		style="padding: 0px; background: url('<?php echo $bg; ?>'); height: 350px; background-size: cover; background-repeat: no-repeat; margin-bottom:0px; border-bottom-left-radius:0px; border-bottom-right-radius:0px">
		<div class="panel-body" style="color: #FFFFFF">
			<?php Helper::addViewComponent('profile-info', $view_vars); ?>
		</div>
	</div>
	
	<div id="profile-info" class="panel panel-default" style="border-top: none; border-top-left-radius: 0px; border-top-right-radius: 0px;">
		<div class="panel-body" style="padding: 0px">
			<ul class="nav nav-pills" style="position: relative; left: 250px">
				<li id="pill-1" class="active pill"><a href="javascript:changeTab(1)">ABOUT <?php ?></a></li>
				<li id="pill-2" class="pill"><a href="javascript:changeTab(2)">REPOSITORY</a></li>
				<li id="pill-3" class="pill"><a href="javascript:changeTab(3)">ARTICLES</a></li>
			</ul>
		</div>
	</div>
	
	<div id="profile-info" class="panel panel-default">
		<div class="panel-body">
			<?php Helper::addViewComponent('profile-tabs', $view_vars); ?>
		</div>
	</div>
</div>
