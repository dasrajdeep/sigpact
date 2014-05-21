<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('forum.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 4); ?></div>

<div class="container col-md-10 col-md-offset-2">
	<h1>FORUM @SiGPACT</h1>
	
	<h3><a href="#"><span class="glyphicon glyphicon-plus-sign"></span> Start a new thread</a></h3>
	
	<h2>THREADS</h2>
</div>