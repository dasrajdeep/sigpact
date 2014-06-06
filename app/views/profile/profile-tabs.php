<?php $profile = $view_vars[0]; ?>

<div>
	<div class="tab-content" id="content-aboutme" style="text-align: justify; font-size: 20px;">
		<?php if($profile['acc_no'] == Session::getUserID()) { ?>
		<button type="button" class="btn btn-primary" onclick="changeAboutMe()"><span class="glyphicon glyphicon-edit"></span> Edit</button>
		<?php } ?>
		
		<div class="jumbotron" style="background-color: #FFFFFF">
			<blockquote>
				<?php echo $profile['about_me']; ?>
			</blockquote>
		</div>
	</div>
	
	<div class="tab-content" id="content-code" style="display: none; text-align: center">
		<h1>Will be here soon!</h1>
	</div>
	
	<div class="tab-content" id="content-articles" style="display: none">
		<?php
			$articles = $view_vars[1];
			
			if(count($articles) == 0) echo '<h2>No articles here...</h2>';
			
			foreach($articles as $article) {
				if(strlen($article->content) > 100) $content = substr($article->content, 0, 100).'...';
				else $content = $article->content;
		?>
		<div class="col-md-6" style="border-radius: 5px; border: solid; border-width: 1px">
			<h4 style="border-radius: 5px; background-color: #EEEEEE; padding: 10px"><a href="<?php echo BASE_URI.'article/'.$article->id; ?>"><?php echo $article->title; ?></a></h4>
			<hr style="background-color: #566569;height: 1px;"/>
			<div><?php echo Utilities::shortenText($article->content, 250); ?></div>
			<h4>...
				<i title="<?php echo Utilities::convertToFullDate($article->timestamp); ?>"  value="<?php echo Utilities::getFormatForTimeago($article->timestamp); ?>" class="timeago"></i>
			</h4>
		</div>
		<?php } ?>
	</div>
</div>