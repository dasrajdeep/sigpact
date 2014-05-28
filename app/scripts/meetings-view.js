$(document).ready(function() {
	$('#minutes-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			hideProgressDialog();
			showDialog('Unable to add minutes', 'Something went wrong. We were unable to add minutes of the meeting.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
    
    $('#minutes-editor').summernote({
		height: 300,
		focus: true,
		toolbar: [
			['style',['bold','italic','underline','clear']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['layout',['ul','ol','paragraph']],
			['misc',['undo','redo']]
		]
	});
	
	$('#file-input').change(function() {
		$('#file-list').html('');
		var file_list = $('#file-input').get(0).files; 
		for(var index = 0; index < file_list.length; index++) {
			$('<li>' + file_list.item(index).name +  '</li>').appendTo('#file-list');
		}
	});
});

function showMinutesDialog() {
	$('#addMinutesDialog').modal('show');
}

function addMinutes() {
	$('.modal').modal('hide');
	
	$('#minutes-editor').html($('#minutes-editor').code());
	
	var file_list = $('#file-input').get(0).files; 
	
	for(var index = 0; index < file_list.length; index++) {
		var name = file_list.item(index).name;
		var parts = name.split('.');
		var extension = parts[parts.length - 1];
		if(file_list.item(index).size > 10*1048576) {
			showDialog('File(s) too large', 'Sorry! You can only upload files less than 10MB.');
			return;
		}
	}
	
	showProgressDialog();
	$('#minutes-form').submit();
}

function openFileBrowser() {
	$('#file-input').click();
}
