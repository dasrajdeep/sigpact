$(document).ready(function() {
	
	$('#article-delete-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			hideProgressDialog();
			showDialog('Unable to delete article', 'Something went wrong. We were unable to delete your article.');
		} else if(data === 'true') {
			window.location.href = baseURI + 'articles';
		}
    });
    
    $('#article-edit-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			hideProgressDialog();
			showDialog('Unable to update article', 'Something went wrong. We were unable to save your changes.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
    
    $('#comment-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			hideProgressDialog();
			showDialog('Unable to post comment', 'Something went wrong. We were unable to post your comment.');
		} else if(data === 'true') {
			window.location.reload();
		}
    });
	
	$('#articles-editor').summernote({
		height: 300,
		focus: true,
		toolbar: [
			['style',['bold','italic','underline','clear']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['layout',['ul','ol','paragraph']],
			['misc',['undo','redo']],
			['insert',['picture','link','video']]
		]
	});
	
	updateTimeAgo();
});

function deleteArticle() {
	showProgressDialog();
	$('#article-delete-form').submit();
}

function editArticle() {
	
	$('#article-view').hide();
	$('#articles-editor').code($('#article-content').html());
	$('#article-edit-form').fadeIn(500);
}

function cancelEdit() {
	
	$('#article-edit-form').hide();
	$('#article-view').fadeIn(500);
}

function saveChanges() {
	
	showProgressDialog();
	$('#articles-editor').html($('#articles-editor').code());
	$('#article-edit-form').submit();
}

function postComment() {
	
	showProgressDialog();
	$('#comment-form').submit();
}
