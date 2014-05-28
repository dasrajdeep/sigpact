/*var completionEngine = new Bloodhound({
	name: 'participants',
	remote: baseURI+'rpc/helpAutoComplete?query=%QUERY',
	queryTokenizer: Bloodhound.tokenizers.whitespace,
	datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value')
});*/

var participants = [];

$(document).ready(function() {
	
	$('#meeting-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			hideProgressDialog();
			showDialog('Unable to create a meeting', 'Something went wrong. We were unable to arrange your meeting.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
    
    $('.attend-radio').click(function() {
    	if($(this).attr('id') === 'radio-sel') {
    		$('#alt-selected').show();
    	} else {
    		$('#alt-selected').hide();
    	}
    });
    
    //completionEngine.initialize();
    
    $('#attendee-names').keyup(function(event) {
    	var data = $(this).val();
    	if(data.indexOf(',') == data.length-1 || event.keyCode == '13') {
    		addParticipant();
    	}
    });
    
    $('#attendee-names').blur(function() {
    	addParticipant();
    });
    
    $('#attendee-names').typeahead({
    	name: 'participants',
    	displayKey: 'full_name',
    	//source: completionEngine.ttAdapter()
    	remote: baseURI+'rpc/helpAutoComplete?query=%QUERY'
    });
    
    updateTimeAgo();
});

function addParticipant() {
	var data = $('#attendee-names').val();
	if(data.indexOf(',') == data.length-1) data = data.substr(0,data.length-1);
	if(data.length == 0 || data.indexOf(')') != data.length-1) return;
	$('<li>' + data + ' <span onclick="removeParticipant(\''+data+'\')" style="cursor: pointer" class="glyphicon glyphicon-remove-circle"></span></li>').appendTo('#attendees');
	$('#attendee-form-data').val( $('#attendee-form-data').val() + data + ',' );
	//participants.push(data);
	$('#attendee-names').val('');
}

function removeParticipant(data) {
	//
}

function showArrangeMeetingDialog() {
	$('#createMeetingDialog').modal();
}

function createMeeting() {
	$('#createMeetingDialog').modal('hide');
	showProgressDialog();
	$('#meeting-form').submit();
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