<div class="modal fade" id="createMeetingDialog" tabindex="-1" role="dialog" aria-labelledby="meetingUnknownLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="meetingUnknownLabel"><span class="glyphicon glyphicon-phone-alt"></span> Arrange a Meeting</h4>
			</div>
			
			<div class="modal-body">
				<form class="form-horizontal" id="meeting-form" method="post" action="<?php echo BASE_URI.'rpc/createMeeting'; ?>">
					<div class="form-group">
						<div class="col-sm-10">Participants (Meeting with)</div>
						<div class="col-sm-10">
							<div class="radio-inline">
								<label>
									<input class="attend-radio" id="radio-all" type="radio" name="num_participants" value="all" /> Everyone
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input class="attend-radio" id="radio-sel" type="radio" name="num_participants" value="few" /> Selected
								</label>
							</div>
						</div>
						<div id="alt-selected" class="col-sm-10" style="display: none">
							<input id="attendee-names" type="text" class="form-control" name="participants" placeholder="Name of participants" autocomplete="off" />
							<br/>
							<ul id="attendees"></ul>
							<input id="attendee-form-data" type="hidden" name="attendee_list" value="" />
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							Venue
							<input type="text" class="form-control" name="venue" value="" placeholder="eg. CS101">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							Date of Meeting
							<input type="date" class="form-control" name="date" value="" placeholder="eg. 03/03/2014">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							Time of Meeting
							<input type="time" class="form-control" name="time" value="" placeholder="eg. 12:45 PM">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							Duration of Meeting
							<input type="number" class="form-control" name="duration" value="" placeholder="in minutes (eg. 40)">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							A short description of the meeting
							<textarea style="resize: vertical" class="form-control" name="description" value="" placeholder="eg. To discuss areas of interest."></textarea>
						</div>
					</div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="createMeeting()">Arrange Meeting</button>
			</div>
		</div>
	</div>
</div>

<style>
.tt-hint,#attendee-names  {
 	border: 1px solid #CCCCCC;
    border-radius: 5px;
    font-size: 15px;
    height: 35px;
    line-height: 30px;
    outline: medium none;
    padding: 8px 12px;
    width: 450px;
}
.tt-dropdown-menu {
  width: 400px;
  padding: 3px;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 5px;
  font-size: 15px;
  color: #111;
  background-color: #F1F1F1;
}
</style>