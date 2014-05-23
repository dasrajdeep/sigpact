<table cellpadding="10px">
	<tr>
		<td>
			<a href="<?php echo BASE_URI; ?>meetings"><img height="100px" class="col-md-12 col-sm-12" src="<?php echo Helper::getContentLink('logo_people.png'); ?>" /></a>
		</td>
		<td><h3><?php if($view_vars == 1) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3></td>
	</tr>
	<tr>
		<td>
			<a href="<?php echo BASE_URI; ?>articles"><img height="100px" class="col-md-12 col-sm-12" src="<?php echo Helper::getContentLink('logo_articles.png'); ?>" /></a>
		</td>
		<td><h3><?php if($view_vars == 2) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3></td>
	</tr>
	<tr>
		<td>
			<a href="<?php echo BASE_URI; ?>repo"><img height="100px" class="col-md-12 col-sm-12" src="<?php echo Helper::getContentLink('logo_box.png'); ?>" /></a>
		</td>
		<td><h3><?php if($view_vars == 3) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3></td>
	</tr>
	<tr>
		<td>
			<a href="<?php echo BASE_URI; ?>forum"><img height="100px" class="col-md-12 col-sm-12" src="<?php echo Helper::getContentLink('logo_forum.png'); ?>" /></a>
		</td>
		<td><h3><?php if($view_vars == 4) { ?><span class="glyphicon glyphicon-hand-left"></span><?php } ?></h3></td>
	</tr>
</table>