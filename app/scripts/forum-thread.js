$(document).ready(function() {
	
	$('#comment-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			showDialog('Unable to post comment', 'Something went wrong. We were unable to post your comment.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
	
	updateTimeAgo();
});

function showCommentForm() {
	$('#comment-link').hide();
	$('#comment-form').fadeIn(500);
}

function postComment() {
	showProgressDialog();
	$('#comment-form').submit();
}