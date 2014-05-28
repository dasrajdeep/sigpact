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
								<h3><?php echo '@'.strtoupper($meeting['venue']); ?></h3>
								<h3 style="display: inline">On </h3><?php echo date('l jS F,', $meeting['datetime']); ?>
								<b><?php echo date('g:i A', $meeting['datetime']).' to '.date('g:i A', $meeting['datetime']+($meeting['duration']*60)); ?></b>
								<h3 style="display: inline">(<i value="<?php echo Utilities::getFormatForTimeago($meeting['datetime']); ?>" class="timeago"></i>)</h3>
								<blockquote style="font-size: large"><i>&quot;<?php echo $meeting['description']; ?>&quot;</i></blockquote>
							</div>
							<div class="col-md-4" style="text-align: right">
								<h4>Called by</h4>
								<?php
								if(!$meeting['thumbnail']) $meeting_src = Helper::getContentLink('default_profile_photo.jpg');
								else $meeting_src = 'data:'.$meeting['mime'].';base64,'.$meeting['thumbnail'];  
								?>
								<h3 style="display: inline"><a href="<?php echo BASE_URI.'profile/'.$meeting['acc_no']; ?>"><?php echo $meeting['full_name']; ?></a></h3>
								<img class="img-circle" style="vertical-align: middle" width="50px" height="50px" src="<?php echo $meeting_src; ?>" />
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
					<h3><?php echo '@'.strtoupper($meeting['venue']); ?></h3>
					<h3 style="display: inline">On </h3><?php echo date('l jS F,', $meeting['datetime']); ?>
					<b><?php echo date('g:i A', $meeting['datetime']).' to '.date('g:i A', $meeting['datetime']+($meeting['duration']*60)); ?></b>
					<div style="font-size: large" class="alert alert-info"><i>"<?php echo $meeting['description']; ?>"</i></div>
					<h4>Called by</h4>
					<?php
					if(!$meeting['thumbnail']) $meeting_src = Helper::getContentLink('default_profile_photo.jpg');
					else $meeting_src = 'data:'.$meeting['mime'].';base64,'.$meeting['thumbnail'];  
					?>
					<img width="50px" height="50px" src="<?php echo $meeting_src; ?>" />
					<h2 style="display: inline"><a href="<?php echo BASE_URI.'profile/'.$meeting['acc_no']; ?>"><?php echo $meeting['full_name']; ?></a></h2>
				</div>
			</div>
		<?php }} ?>
	</div>
<?php } ?>