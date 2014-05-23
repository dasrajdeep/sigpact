<?php foreach($view_vars as $article) { ?>
	<div class="article panel panel-default">
		<div class="panel-body">
			<h3><a href="<?php echo BASE_URI.'article/'.$article->id; ?>"><?php echo $article->title; ?></a></h3>
			<hr style="background-color: #566569;height: 1px;"/>
			<?php
				if(strlen($article->content) > 250) $content = substr($article->content, 0, 250).'...';
				else $content = $article->content;
				echo $content;
			?>
		</div>
	</div>
<?php } ?>