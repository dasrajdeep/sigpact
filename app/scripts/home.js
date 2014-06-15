$(document).ready(function() {
	
	updateTimeAgo();
	
	$('.person').popover({
		trigger: 'hover',
		placement: 'bottom'
	});
	
	$('#menu_meetings').popover({
		trigger: 'hover',
		placement: 'bottom',
		content: 'Meetings'
	});
	
	$('#menu_forum').popover({
		trigger: 'hover',
		placement: 'right',
		content: 'Forum'
	});
	
	$('#menu_articles').popover({
		trigger: 'hover',
		placement: 'left',
		content: 'Articles'
	});
	
	$('#menu_repo').popover({
		trigger: 'hover',
		placement: 'top',
		content: 'Repository'
	});

});
