<?php foreach($view_vars as $thread) { ?>
	<div class="panel panel-default">
		<div class="panel-body">
			<h3><a href="<?php echo BASE_URI.'thread/'.$thread->id; ?>"><?php echo $thread->title; ?></a></h3>
			<hr style="background-color: #566569;height: 1px;"/>
			<div style="font-size: large"><?php echo $thread->description; ?></div>
			<h5><i>Started  
				<span title="<?php echo Utilities::convertToFullDate($thread->timestamp); ?>"  value="<?php echo Utilities::getFormatForTimeago($thread->timestamp); ?>" class="timeago"></span>
			</i></h5>
		</div>
	</div>
<?php } ?>