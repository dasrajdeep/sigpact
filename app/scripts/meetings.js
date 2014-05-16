var completions = [];

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
    	displayKey: 'full_name',
    	remote: baseURI+'rpc/helpAutoComplete?query=%QUERY'
    	/*source: function(query, process) {
    		
    		alert(query);
			$.get(baseURI + 'rpc/helpAutoComplete', {'query':query}, function(data) {
				
				completions = [];
				
				var results = eval( '(' + data + ')' );
				
				alert(data);
			});
		},
		updater: function(item) {}*/
    });
});

function autocomplete(query, process) {
	
	// Encode query
	$.get(baseURI + 'rpc/helpAutoComplete', {'query':query}, function(data) {
		
		completions = [];
		
		var results = eval( '(' + data + ')' );
		
		alert(data);
	});
}

function showArrangeMeetingDialog() {
	$('#createMeetingDialog').modal();
}

function createMeeting() {
	$('#createMeetingDialog').modal('hide');
	// RPC to create meeting. Show please wait dialog.
}
