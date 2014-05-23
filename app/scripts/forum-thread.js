$(document).ready(function() {
	
	$('#comment-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			showDialog('Unable to post comment', 'Something went wrong. We were unable to post your comment.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
	
});

function showCommentForm() {
	$('#comment-link').hide();
	$('#comment-form').fadeIn(500);
}

function postComment() {
	showProgressDialog();
	$('#comment-form').submit();
}

function showProgressDialog() {
	$('#progress-dialog').modal({
		backdrop:'static',
		keyboard:false,
		show:true
	});
}

function hideProgressDialog() {
	$('#progress-dialog').modal('hide');
}

function showDialog(title, body) {
	
	$('#notify-body').html(body);
	$('#notify-title').html(title);
	$('#alert-dialog').modal('show');
}