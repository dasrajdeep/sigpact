$(document).ready(function() {
	
	$('.carousel').carousel({
		interval: false
	});
	
	$('.carousel').css('height',window.innerHeight);
	
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
    } else {
    	showDialog('Unable to create account request!', 'Something went wrong. We were unable to create your account request. Contact the administrator regarding this issue.');
    }
    });
});

function signIn() {
	
	$('.carousel').carousel(0);
}

function requestAccount() {
	
	$('.carousel').carousel(2);
}

function showDialog(title, body) {
	
	$('#notify-body').html(body);
	$('#notify-title').html(title);
	$('#alert-dialog').modal('show');
}
