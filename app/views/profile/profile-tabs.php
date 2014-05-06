<?php $profile = $view_vars[1]; ?>

<ul class="nav nav-pills nav-justified">
	<li class="active"><a href="#">ABOUT <?php ?></a></li>
	<li><a href="#">MEETINGS</a></li>
	<li><a href="#">ARTICLES</a></li>
</ul>

<br/>

<p id="tab-content" style="text-align: justify; font-size: 20px;">
	<?php echo 
		$about_me = $profile->about_me;
		
		if(strlen($about_me) == 0) echo 'Nothing here as yet.';
		else echo $about_me;
	?>
</p>