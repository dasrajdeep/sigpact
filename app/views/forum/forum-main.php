<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 4); ?></div>

<div class="container col-md-10 col-md-offset-2">
	<h1>FORUM @SiGPACT</h1>
</div>