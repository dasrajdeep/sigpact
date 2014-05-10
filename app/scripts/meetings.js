$(document).ready(function() {
	
	$('#meeting-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			//
		} else if(data === 'true') {
			//
		}
    });
    
    $('.attend-radio').click(function() {
    	if($(this).attr('id') === 'radio-sel') {
    		$('#alt-selected').show();
    	} else {
    		$('#alt-selected').hide();
    	}
    });
    
    $('#attendee-names').typeahead({
    	name: 'participants',
    	remote: baseURI+'rpc/helpAutoComplete?query=%QUERY'
    });
});

function showArrangeMeetingDialog() {
	$('#createMeetingDialog').modal();
}

function createMeeting() {
	$('#createMeetingDialog').modal('hide');
	// RPC to create meeting. Show please wait dialog.
}
