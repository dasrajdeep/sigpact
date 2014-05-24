<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('moment.min.js');
	Helper::addDependancy('utilities.js');
	Helper::addDependancy('forum-thread.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<?php Helper::addViewComponent('progress-view'); ?>
<?php Helper::addViewComponent('alert-dialog'); ?>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 4); ?></div>

<?php $thread = $view_vars[0]; $comments = $view_vars[1]; ?>

<div class="container col-md-8 col-md-offset-2">
	<h1><?php echo $thread['title']; ?></h1>
	
	<div><?php echo $thread['description']; ?></div>
	
	<h5><i>Created on <?php echo Utilities::convertToFullDate($thread['timestamp']); ?> by</i></h5>
	
	<?php
		if(!$thread['thumbnail']) $src = Helper::getContentLink('default_profile_photo.jpg');
		else $src = 'data:'.$thread['mime'].';base64,'.$thread['thumbnail'];  
	?>
	
	<img class="img-circle" style="vertical-align: bottom" width="35px" height="35px" src="<?php echo $src; ?>" />
	<h3 style="display: inline"><a href="<?php echo BASE_URI.'profile/'.$thread['acc_no']; ?>"><?php echo $thread['full_name']; ?></a></h3>
	
	<hr style="background-color: #566569;height: 1px;"/>
	
	<div id="comments">
		<?php foreach($comments as $comment) { ?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div style="font-size: large"><?php echo $comment['comment']; ?></div>
					<h5><i>
						Posted 
						<span title="<?php echo Utilities::convertToFullDate($comment['timestamp']); ?>" value="<?php echo Utilities::getFormatForTimeago($comment['timestamp']); ?>" class="timeago"></span>
						by 
						<a href="<?php echo BASE_URI.'profile/'.$comment['acc_no']; ?>"><?php echo $comment['full_name']; ?></a>
					</i></h5>
				</div>
			</div>
		<?php } ?>
	</div>
	
	<form style="display: none" class="form-horizontal" id="comment-form" method="post" action="<?php echo BASE_URI.'rpc/createThreadComment'; ?>">
		<div class="form-group">
			<div class="col-sm-10">
				<textarea style="resize: vertical" class="form-control" name="comment" value="" placeholder="Write your comment"></textarea>
			</div>
		</div>
		
		<input type="hidden" name="thread_id" value="<?php echo $thread['thread_id']; ?>" />
		
		<button type="button" class="btn btn-primary" onclick="postComment()">Post Comment</button>
	</form>
	
	<h4 id="comment-link"><a href="javascript:showCommentForm()">Comment on this thread</a></h4>
</div>