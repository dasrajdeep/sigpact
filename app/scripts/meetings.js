$(document).ready(function() {
	
	$('#meeting-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			//
		} else if(data === 'true') {
			//
		}
    });
});

function showArrangeMeetingDialog() {
	$('#createMeetingDialog').modal();
}

function createMeeting() {
	$('#createMeetingDialog').modal('hide');
	// RPC to create meeting. Show please wait dialog.
}
