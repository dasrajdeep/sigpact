$(document).ready(function() {
	$('#articles-editor').summernote({
		height: 300,
		focus: true
	});
	$('#article-form').hide();
});

function showCreateArticleDialog() {
	$('#article-form').show(500);
	$('#set-a').hide();
}

function restoreArticleView() {
	$('#article-form').hide(500);
	$('#set-a').show();
}
