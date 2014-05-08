<?php $profile = $view_vars[0]; ?>

<ul class="nav nav-pills nav-justified">
	<li class="active"><a href="#">ABOUT <?php ?></a></li>
	<li><a href="#">CODE</a></li>
	<li><a href="#">ARTICLES</a></li>
</ul>

<br/>

<p id="tab-content">
	<div id="content-aboutme" style="text-align: justify; font-size: 20px;">
		<?php if($profile->id == Session::getUserID()) { ?>
		<button type="button" class="btn btn-primary" onclick="changeAboutMe()"><span class="glyphicon glyphicon-edit"></span> Edit</button>
		<?php } ?>
		<br/>
		<?php 
			echo $profile->about_me;
		?>
	</div>
	
	<div id="content-code" style="display: none"></div>
	
	<div id="content-articles" style="display: none"></div>
</p>