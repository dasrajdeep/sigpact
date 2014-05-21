$(document).ready(function() {
	
	$('#-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			showDialog('Unable to ', 'Something went wrong. We were unable to .');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
	
});

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