<?php foreach($view_vars as $article) { ?>
	<div class="article panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><a href="<?php echo BASE_URI.'article/'.$article->id; ?>"><?php echo $article->title; ?></a></h3>
		</div>
		<div class="panel-body">
			<?php
				if(strlen($article->content) > 100) $content = substr($article->content, 0, 100).'...';
				else $content = $article->content;
				echo $content;
			?>
		</div>
	</div>
<?php } ?>