<ul class="nav nav-pills nav-stacked" style="text-align: right;">
	<li><a href="<?php echo BASE_URI; ?>meetings">
		<img class="col-md-8 col-sm-7" src="<?php echo Helper::getContentLink('logo_people.png'); ?>" />
		<h3 style="color: #566569">MEETINGS <?php if($view_vars == 1) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3>
	</a></li>
	<li><a href="<?php echo BASE_URI; ?>articles">
		<img class="col-md-8 col-sm-7" src="<?php echo Helper::getContentLink('logo_articles.png'); ?>" />
		<h3 style="color: #566569">ARTICLES <?php if($view_vars == 2) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3>
	</a></li>
	<li><a href="<?php echo BASE_URI; ?>repo">
		<img class="col-md-8 col-sm-7" src="<?php echo Helper::getContentLink('logo_box.png'); ?>" />
		<h3 style="color: #566569">REPO <?php if($view_vars == 3) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3>
	</a></li>
	<li><a href="<?php echo BASE_URI; ?>forum">
		<img class="col-md-8 col-sm-7" src="<?php echo Helper::getContentLink('logo_forum.png'); ?>" />
		<h3 style="color: #566569">FORUM <?php if($view_vars == 4) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3>
	</a></li>
</ul>