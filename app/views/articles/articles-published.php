<?php foreach($view_vars as $article) { ?>
	<div class="article panel panel-default">
		<div class="panel-body">
			<h3><a href="<?php echo BASE_URI.'article/'.$article->id; ?>"><?php echo $article->title; ?></a></h3>
			<hr style="background-color: #566569;height: 1px;"/>
			<?php
				echo Utilities::shortenText($article->content, 250);
			?>
		</div>
	</div>
<?php } ?>