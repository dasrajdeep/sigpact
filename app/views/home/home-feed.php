<?php
	$event_list = array(
		'USER_REGISTER',
		'ARTICLE_CREATED',
		'FORUM_THREAD_CREATED',
		'COMMENTED_FORUM',
		'MEETING_CREATED',
		'COMMENTED_ARTICLE',
		'MEETING_UPDATED'
	); 
?>

<h1>WHAT'S GOING ON</h1>

<?php
	$events = $view_vars;
	foreach($events as $event) {
		if($event['photo_id'] == null) $src = Helper::getContentLink('default_profile_photo.jpg');
		else $src = 'data:'.$event['mime'].';base64,'.$event['thumbnail'];
?>
<div class="panel panel-default">
	<div class="panel-body" style="font-size: large">
		<div class="col-md-1">
			<img class="img-rounded" width="50px" height="50px" src="<?php echo $src; ?>" alt="Photo" />
		</div>
		<div class="col-md-8 col-md-offset-1">
			<h3 style="display: inline"><a href="<?php echo BASE_URI.'profile/'.$event['acc_no']; ?>"><?php echo $event['full_name']; ?></a></h3>
			<span>
				<?php
					$event_name = $event['event_name'];
					
					if($event_name === 'USER_REGISTER') {
						echo ' joined <b>SiGPACT</b> ';
					} else if($event_name === 'PROFILE_UPDATE_PHOTO') {
						echo sprintf(' updated %s profile picture ', ($event['sex'] === 'M') ? 'his':'her');
					} else if($event_name === 'ARTICLE_CREATED') {
						echo sprintf(' published an article <a href="%s">%s</a> ', BASE_URI.'article/'.$event['target'], $event['title']);
					} else if($event_name === 'FORUM_THREAD_CREATED') {
						echo sprintf(' started a new thread in the forum with the title <a href="%s">%s</a> ', BASE_URI.'thread/'.$event['target'], $event['title']);
					} else if($event_name === 'COMMENTED_FORUM') {
						echo sprintf(' commented on <a href="%s">%s</a> ', BASE_URI.'thread/'.$event['target'], $event['title']);
					} else if($event_name === 'MEETING_CREATED') {
						echo sprintf(' created a new meeting &quot;<a href="%s">%s</a>&quot;', BASE_URI.'meeting/'.$event['target'], $event['agenda']);
					} else if($event_name === 'COMMENTED_ARTICLE') {
						echo sprintf(' commented on <a href="%s">%s</a> ', BASE_URI.'article/'.$event['target'], $event['title']);
					} else if($event_name === 'MEETING_UPDATED') {
						echo sprintf(' updated meeting &quot;<a href="%s">%s</a>&quot; ', BASE_URI.'meeting/'.$event['target'], $event['agenda']);
					}
				?>
				<h5><i>
					<span title="<?php echo Utilities::convertToFullDate($event['timestamp']); ?>" value="<?php echo Utilities::getFormatForTimeago($event['timestamp']); ?>" class="timeago"></span>
				</i></h5>
			</span>
		</div>
	</div>
</div>
<?php } ?>