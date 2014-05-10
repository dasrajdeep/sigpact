$(document).ready(function() {
	$('#photo-form').ajaxForm(function(data) { 
		hideProgressDialog();
		if(data === 'false') {
			showDialog('Upload Failed!', 'Could not change your photo.');
		} else if(data === 'true') {
			window.location.reload();
		} else {
			showDialog('Error! Something unusual happened.', data);
		}
   });
   
   $('#aboutme-form').ajaxForm(function(data) { 
		hideProgressDialog();
		if(data === 'false') {
			showDialog('Profile Update Failed!', 'Could not update your profile information.');
		} else if(data === 'true') {
			window.location.reload();
		} else {
			showDialog('Error! Something unusual happened.', data);
		}
   });
});

function changeProfilePhoto() {
	$('#photo-dialog').modal('show');
}

function changeAboutMe() {
	$('#aboutme-dialog').modal('show');
}

function updateProfilePhoto() {
	$('#photo-dialog').modal('hide');
	showProgressDialog();
	$('#photo-form').submit();
} 

function updateAboutMe() {
	$('#aboutme-dialog').modal('hide');
	showProgressDialog();
	$('#aboutme-form').submit();
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

function changeTab(tabID) {
	
	$('.tab-content').hide();
	$('.pill').removeClass('active');
	$('#pill-'+tabID).addClass('active');
	
	if(tabID == 1) {
		$('#content-aboutme').show();
	} else if(tabID == 2) {
		$('#content-code').show();
	} else if(tabID == 3) {
		$('#content-articles').show();
	}
}
