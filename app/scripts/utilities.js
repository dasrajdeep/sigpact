function updateTimeAgo() {
	
	$('.timeago').each(function() {
    	var time = moment($(this).attr('value'), 'DDMMYYYYHHmmss').fromNow();
    	$(this).html(time);
    });
    
    setTimeout("updateTimeAgo()", 9000);
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