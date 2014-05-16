<?php
	$description_map = array(
		'USER_REGISTER'=>' joined SiGPACT on ',
		'ARTICLE_CREATED'=>' published an article on '
	); 
?>

<h1>WHAT'S GOING ON</h1>

<div class="panel panel-default">
	<div class="panel-body">
		<?php
			$events = $view_vars;
			foreach($events as $event) {
				if($event['photo_id'] == null) $src = Helper::getContentLink('default_profile_photo.jpg');
				else $src = 'data:'.$event['mime'].';base64,'.$event['thumbnail'];
		?>
		<div style="padding: 5px;">
			<img width="70px" height="70px" src="<?php echo $src; ?>" alt="Photo" />
			<h3 style="display: inline"><a href="<?php echo BASE_URI.'profile/'.$event['acc_no']; ?>"><?php echo $event['full_name']; ?></a></h3>
			<span><?php echo $description_map[$event['event_name']].date('l jS F,', $event['timestamp']).' at '.date('g:i A', $event['timestamp']); ?></span>
		</div>
		<?php } ?>
	</div>
</div>