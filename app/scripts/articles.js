$(document).ready(function() {
	
	$('#article-form').ajaxForm(function(data) { 
		
		if(data === 'false') {
			showDialog('Unable to publish article', 'Something went wrong. We were unable to publish your article.');
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
	
	$('#article-form').hide();
});

function showCreateArticleDialog() {
	$('#article-form').fadeIn(500);
	$('#set-a').hide();
	$('#published-articles').hide();
}

function restoreArticleView() {
	$('#article-form').hide(500);
	$('#set-a').show();
	$('#published-articles').show();
}

function createArticle() {
	
	var article = $('#articles-editor').code();
	
	showProgressDialog();
	
	$('#articles-editor').html(article);
	$('#article-form').submit();
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
