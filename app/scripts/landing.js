$(document).ready(function() {
	
	$('#login-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			showDialog('Login Failed',
				'You have entered invalid credentials. If you have requested for a new account, ' +  
				'then please wait for the administrator to approve it.'
			);
		} else if(data === 'true') {
			window.location.reload();
		}
    });
    
    $('#request-form').ajaxForm(function(data) {
    	
    	if(data === 'false') {
    		showDialog('Unable To Validate Email ID',
    			 'Your email ID could not be verified. Make sure that you have entered a valid IIT Kanpur email ID. ' + 
				 'If the problem persists, contact the administrator.'
    		);
    	} else if(data > 0) {
    		signIn();
    		showDialog('Account Requested',
    			'Your request has been taken. Please wait for the administrator to approve your request.'
    		);
    	} else if(data == -1) {
    		signIn();
    		showDialog('Account Already Requested',
    			'You have already requested for an account. Please wait for the administrator to approve your request.'
    		);
    	}
    });
});

function signIn() {
	
	$('#request-form').hide();
	$('#login-form').show();
}

function requestAccount() {
	
	$('#login-form').hide();
	$('#request-form').show();
}

function showDialog(title, body) {
	
	$('#notify-body').html(body);
	$('#notify-title').html(title);
	$('#alert-dialog').modal('show');
}
