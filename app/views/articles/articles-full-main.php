<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('font-awesome');
	Helper::addDependancy('summernote');
	Helper::addDependancy('moment.min.js');
	Helper::addDependancy('utilities.js');
	Helper::addDependancy('articles-full.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 2); ?></div>

<?php
	$article = $view_vars['article'];
	$comments = $view_vars['comments'];
	
	if($article['photo'] == null) $src = Helper::getContentLink('default_profile_photo.jpg');
	else $src = 'data:'.$article['mime'].';base64,'.$article['photo'];
?>

<div class="container col-md-10 col-md-offset-2">
	<div class="col-md-2">
		<img width="100%" src="<?php echo $src; ?>" alt="Photo" />
		<br/>
		<h4><i>Posted by</i></h4>
		<h4><a href="<?php echo BASE_URI.'profile/'.$article['acc_no']; ?>"><?php echo $article['full_name']; ?></a></h4>
		<i>On <?php echo Utilities::convertToFullDate($article['timestamp']); ?></i>
		
		<br/><br/>
		
		<?php if($article['acc_no'] == Session::getUserID()) { ?>
			<div>
				<button style="width: 100px; margin: 3px;" class="btn btn-default" onclick="editArticle()"><span class="glyphicon glyphicon-edit"></span> Edit</button>
				<br/>
				<button style="width: 100px; margin: 3px;" class="btn btn-danger" onclick="deleteArticle()"><span class="glyphicon glyphicon-trash"></span> Delete</button>
			</div>
		<?php } ?>
		<form id="article-delete-form" method="post" action="<?php echo BASE_URI.'rpc/deleteArticle'; ?>">
			<input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" />
		</form>
	</div>
	<div class="col-md-9">
		<h1><?php echo $article['title']; ?></h1>
		
		<div id="article-view">
			<div class="panel panel-default">
				<div class="panel-body" id="article-content">
					<?php echo $article['content']; ?>
				</div>
			</div>
			
			<h3>Comments</h3>
			<div class="panel panel-default" id="comments-section">
				<div class="panel-body">
					<?php if(count($comments) == 0) echo 'No comments as yet.'; ?>
					<?php foreach($comments as $comment) {
						if(!$comment['photo']) $comment_src = Helper::getContentLink('default_profile_photo.jpg');
						else $comment_src = 'data:'.$comment['mime'].';base64,'.$comment['photo']; 
					?>
						<div style="margin: 5px" class="comment">
							<img width="50px" height="50px" src="<?php echo $comment_src; ?>" />
							<h4 style="display: inline"><a href="<?php echo BASE_URI.'profile/'.$comment['acc_no']; ?>"><?php echo $comment['full_name']; ?></a></h4>
							<br/><span><?php echo $comment['comment']; ?></span><br/>
							<h5><i>
								Posted
								<span title="<?php echo Utilities::convertToFullDate($comment['timestamp']); ?>" value="<?php echo Utilities::getFormatForTimeago($comment['timestamp']); ?>" class="timeago"></span> 
							</i></h5>
						</div>
						<hr style="background-color: #566569;height: 1px;"/>
					<?php } ?>
				</div>
			</div>
			
			<form id="comment-form" class="form-horizontal" method="post" role="comment" action="<?php echo BASE_URI.'rpc/commentOnArticle'; ?>">
				<h4>Write a Comment</h4>
				<div class="form-group">
					<div class="col-sm-10">
						<textarea class="form-control" cols="60" name="comment"></textarea>
					</div>
				</div>
				<input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" />
				<div class="form-group">
					<div class="col-sm-10">
						<button type="button" class="btn btn-default" onclick="postComment()">Post Comment</button>
					</div>
				</div>
			</form>
		</div>
		
		<form style="display: none" class="form-horizontal" id="article-edit-form" method="post" action="<?php echo BASE_URI.'rpc/editArticle'; ?>">
			<div style=" background-color: #FFFFFF">
				<textarea name="content" id="articles-editor" style="overflow:scroll; max-height:300px;"></textarea>
			</div>
			
			<input type="hidden" name="article_id" value="<?php echo $article['article_id']; ?>" />
			
			<br/>
		
			<div class="form-group">
				<div class="col-sm-10">
					<button type="button" class="btn btn-default" onclick="cancelEdit()">Cancel</button>
					<button type="button" class="btn btn-primary" onclick="saveChanges()">Save Changes</button>
				</div>
			</div>
		</form>
	</div>
</div>