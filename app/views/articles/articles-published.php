<?php foreach($view_vars as $article) { ?>
	<div class="article panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $article->title; ?></h3>
		</div>
		<div class="panel-body">
			<?php echo $article->content; ?>
		</div>
	</div>
<?php } ?>