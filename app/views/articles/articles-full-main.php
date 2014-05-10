<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('font-awesome');
	Helper::addDependancy('summernote');
	Helper::addDependancy('articles.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 2); ?></div>

<?php
	$article = $view_vars[0];
	$profile = $view_vars[1];
	$photo = $view_vars[2]; 
	if($photo == null) $src = Helper::getContentLink('default_profile_photo.jpg');
	else $src = 'data:'.$photo->mime.';base64,'.$photo->thumbnail;
?>

<div class="container col-md-10 col-md-offset-2">
	<div class="col-md-2">
		<img width="100%" src="<?php echo $src; ?>" alt="Photo" />
		<br/>
		<h4><i>Posted by</i></h4>
		<h4><a href="<?php echo BASE_URI.'profile/'.$profile->id; ?>"><?php echo $profile->full_name; ?></a></h4>
		<i>On <?php echo date('l jS F,', $article->timestamp); ?> at <?php echo date('g:i A', $article->timestamp); ?></i>
		
		<?php if($article->creator_id == Session::getUserID()) { ?>
			<div class="btn-group">
				<button class="btn btn-default"><span class="glyphicon glyphicon-edit"></span> Edit</button>
				<button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete</button>
			</div>
		<?php } ?>
	</div>
	<div class="col-md-9">
		<h1><?php echo $article->title; ?></h1>
		<div class="panel panel-default">
			<div class="panel-body">
				<?php echo $article->content; ?>
			</div>
		</div>
		
		<h3>Comments</h3>
		<div class="panel panel-default" id="comments-section">
			<div class="panel-body"></div>
		</div>
		
		<form class="form-horizontal" method="post" role="comment" action="">
			<h4>Write a Comment</h4>
			<div class="form-group">
				<div class="col-sm-10">
					<textarea class="form-control" cols="60" name="comment"></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-10">
					<button type="submit" class="btn btn-default">Post Comment</button>
				</div>
			</div>
		</form>
	</div>
</div>