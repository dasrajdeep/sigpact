function showInbox() {
	$('#sentbox').hide();
	$('#inbox').fadeIn(500);
	$('#pill-sentbox').removeClass('active');
	$('#pill-inbox').addClass('active');
}

function showSentbox() {
	$('#inbox').hide();
	$('#sentbox').fadeIn(500);
	$('#pill-inbox').removeClass('active');
	$('#pill-sentbox').addClass('active');
}
