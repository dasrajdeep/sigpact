<?php $meetings = $view_vars; ?>

<?php foreach($meetings as $meeting) { ?>
	<div></div>
<?php } ?>

<?php if(count($meetings) == 0) { ?>
	<div class="jumbotron">
		<h1>Oops! Looks like you haven't attended any meetings as yet.</h1>
		<h3>You might consider <a href="javascript:showArrangeMeetingDialog()">arranging</a> for a meeting.</h3>
	</div>
<?php } ?>