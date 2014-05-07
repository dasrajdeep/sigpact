<div class="modal fade" id="createMeetingDialog" tabindex="-1" role="dialog" aria-labelledby="meetingUnknownLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="meetingUnknownLabel"><span class="glyphicon glyphicon-phone-alt"></span> Arrange a Meeting</h4>
			</div>
			
			<div class="modal-body">
				<form class="form-horizontal" id="meeting-form" method="post" action="">
					<div class="form-group">
						<div class="col-sm-10">
							<input type="text" class="form-control" name="venue" value="" placeholder="Venue (eg. CS101)">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							<input type="date" class="form-control" name="date" value="" placeholder="Date (eg. 03/03/2014)">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							<input type="time" class="form-control" name="time" value="" placeholder="Time (eg. 12:45 PM)">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							<input type="number" class="form-control" name="duration" value="" placeholder="Duration (in minutes)">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							<textarea class="form-control" name="description" value="" placeholder="Description"></textarea>
						</div>
					</div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" onclick="createMeeting()">Arrange Meeting</button>
			</div>
		</div>
	</div>
</div>