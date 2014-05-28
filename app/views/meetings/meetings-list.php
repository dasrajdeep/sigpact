<?php $meetings = $view_vars; ?>

<?php foreach($meetings as $meeting) { ?>
	<div></div>
<?php } ?>

<?php if(count($meetings) == 0) { ?>
	<div class="jumbotron">
		<h1>Oops! Looks like you haven't attended any meetings as yet.</h1>
		<h3>You might consider <a href="javascript:showArrangeMeetingDialog()">arranging</a> for a meeting.</h3>
	</div>
<?php } else { ?>
	<h2>UPCOMING</h2>
	<div id="upcoming-meetings">
		<?php
			foreach($meetings as $meeting) {
				if($meeting['datetime'] > time()) {
					?>
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="col-md-8">
								<a href="<?php echo BASE_URI.'meeting/'.$meeting['meeting_id']; ?>"><h2><?php echo $meeting['agenda']; ?></h2></a>
								<h4>
									<?php echo date('l jS F, g:i A', $meeting['datetime']); ?>
									<small>(<i value="<?php echo Utilities::getFormatForTimeago($meeting['datetime']); ?>" class="timeago"></i>)</small>
								</h4>
							</div>
						</div>
					</div>
				<?php }} ?>
	</div>
	
	<hr style="background-color: #566569;height: 1px;"/>
	
	<h2>PAST MEETINGS</h2>
	<div id="past-meetings">
		<?php
			foreach($meetings as $meeting) {
				if($meeting['datetime'] <= time()) {
		?>
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-md-8">
						<a href="<?php echo BASE_URI.'meeting/'.$meeting['meeting_id']; ?>"><h2><?php echo $meeting['agenda']; ?></h2></a>
						<h4>
							<?php echo date('l jS F, g:i A', $meeting['datetime']); ?>
							<small>(<i value="<?php echo Utilities::getFormatForTimeago($meeting['datetime']); ?>" class="timeago"></i>)</small>
						</h4>
					</div>
				</div>
			</div>
		<?php }} ?>
	</div>
<?php } ?>