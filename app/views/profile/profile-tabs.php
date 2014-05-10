<?php $profile = $view_vars[0]; ?>

<ul class="nav nav-pills nav-justified">
	<li id="pill-1" class="active pill"><a href="javascript:changeTab(1)">ABOUT <?php ?></a></li>
	<li id="pill-2" class="pill"><a href="javascript:changeTab(2)">CODE</a></li>
	<li id="pill-3" class="pill"><a href="javascript:changeTab(3)">ARTICLES</a></li>
</ul>

<br/>

<p>
	<div class="tab-content" id="content-aboutme" style="text-align: justify; font-size: 20px;">
		<?php if($profile->id == Session::getUserID()) { ?>
		<button type="button" class="btn btn-primary" onclick="changeAboutMe()"><span class="glyphicon glyphicon-edit"></span> Edit</button>
		<?php } ?>
		<br/>
		<?php 
			echo $profile->about_me;
		?>
	</div>
	
	<div class="tab-content" id="content-code" style="display: none"></div>
	
	<div class="tab-content" id="content-articles" style="display: none">
		<ul class="list-group">
		<?php
			$articles = $view_vars[2];
			
			foreach($articles as $article) {
				if(strlen($article->content) > 100) $content = substr($article->content, 0, 100).'...';
				else $content = $article->content;
		?>
		<li class="list-group-item">
			<h4><a href="#"><?php echo $article->title; ?></a></h4>
			<div><?php echo $content; ?></div>
			<i><b>Posted on <?php echo date('l, jS F', $article->timestamp); ?> at <?php echo date('g:i A', $article->timestamp); ?></b></i>
		</li>
		<?php } ?>
		</ul>
	</div>
</p>