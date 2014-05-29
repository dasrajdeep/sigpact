<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('landing.js');
?>

<style>
	body {
		background-image: url('<?php echo Helper::getContentLink('main-bg.jpg'); ?>');
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		color: #EEEEEE;
	}
</style>

<div id="landing-carousel" class="carousel slide" data-ride="carousel">
	<ol class="carousel-indicators">
    	<li data-target="#landing-carousel" data-slide-to="0"></li>
    	<li data-target="#landing-carousel" data-slide-to="1" class="active"></li>
    	<li data-target="#landing-carousel" data-slide-to="2"></li>
  	</ol>
  	
  	<div class="carousel-inner" style="text-align: center">
	    <div class="item">
	    	<?php Helper::addViewComponent('landing-login'); ?>
	    	<div class="carousel-caption">
	    		<h2></h2>
	    	</div>
	    </div>
	    
	    <div class="item active" style="text-align: center">
		    
		    <h1 style="font-size: 48px">
				<img width="150px" alt="@IITK" src="<?php echo Helper::getContentLink('iitk_logo_150_white.png'); ?>">
				SiGPACT
				<small>@IIT Kanpur</small>
			</h1>
			
			<?php Helper::addViewComponent('landing-intro'); ?>
	    </div>
	    
	    <div class="item">
	    	<?php Helper::addViewComponent('landing-registration'); ?>
	    	<div class="carousel-caption">
	    		<h2></h2>
	    	</div>
	    </div>
  	</div>
  	
  	<a class="left carousel-control" href="#landing-carousel" data-slide="prev">
	    <span class="glyphicon glyphicon-chevron-left"></span>
  	</a>
  	<a class="right carousel-control" href="#landing-carousel" data-slide="next">
	    <span class="glyphicon glyphicon-chevron-right"></span>
  	</a>
</div>

<div id="notifications" style="color: #333333">
	<?php Helper::addViewComponent('alert-dialog'); ?>
</div>