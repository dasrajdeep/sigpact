$(document).ready(function() {
	
	$('#thread-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			showDialog('Unable to create thread', 'Something went wrong. We were unable to start your thread.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
    
    updateTimeAgo();
	
});

function updateTimeAgo() {
	
	$('.timeago').each(function() {
    	var time = moment($(this).attr('value'), 'DDMMYYYYHHmmss').fromNow();
    	$(this).html(time);
    });
    
    setTimeout("updateTimeAgo()", 1000);
}

function startThread() {
	$('#createThreadDialog').modal();
}

function createThread() {
	$('#createThreadDialog').modal('hide');
	showProgressDialog();
	$('#thread-form').submit();
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