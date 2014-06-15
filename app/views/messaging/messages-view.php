<?php
	$inbox = $view_vars['inbox'];
	$sent = $view_vars['sentbox'];
?>
<div id="inbox">
	<?php foreach($inbox as $message) { ?>
	<div class="panel panel-default">
		<div class="panel-body">
			<div><?php echo Utilities::shortenText($message['message'], 200); ?></div>
			<hr style="background-color: #566569;height: 1px;"/>
			<h4>
				<a href="<?php echo BASE_URI.'profile/'.$message['acc_no']; ?>"><?php echo $message['full_name']; ?></a>
			</h4>
			<h5>on <i><?php echo Utilities::convertToFullDate($message['timestamp']); ?></i></h5>
		</div>
	</div>
	<?php } ?>
</div>
<div id="sentbox" style="display: none">
	<?php foreach($sent as $message) { ?>
	<div class="panel panel-default">
		<div class="panel-body">
			<div><?php echo Utilities::shortenText($message['message'], 200); ?></div>
			<hr style="background-color: #566569;height: 1px;"/>
			<h4>
				<a href="<?php echo BASE_URI.'profile/'.$message['acc_no']; ?>"><?php echo $message['full_name']; ?></a>
			</h4>
			<h5>on <i><?php echo Utilities::convertToFullDate($message['timestamp']); ?></i></h5>
		</div>
	</div>
	<?php } ?>
</div>