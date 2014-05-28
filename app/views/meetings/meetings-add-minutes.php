<div class="modal fade" id="addMinutesDialog" tabindex="-1" role="dialog" aria-labelledby="addminutes" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="addminutes"><span class="glyphicon glyphicon-dashboard"></span> Add Minutes of Meeting</h4>
			</div>
			
			<div class="modal-body">
				<form class="form-horizontal" enctype="multipart/form-data" id="minutes-form" method="post" action="<?php echo BASE_URI.'rpc/addMinutes'; ?>">
					
					<textarea id="minutes-editor" name="minutes"></textarea>
					
					<input type="hidden" name="meeting_id" value="<?php echo $view_vars; ?>" />
					
					<br/>
					
					<div class="form-group">
						<div class="col-sm-10">
							<button type="button" class="btn btn-primary" onclick="openFileBrowser()"><span class="glyphicon glyphicon-paperclip"></span> Attach Files</button>
						</div>
					</div>
					
					<input style="display: none" id="file-input" type="file" name="attachments[]" multiple="multiple" />
					
					<div class="form-group">
						<div class="col-sm-10">
							<ul id="file-list"></ul>
						</div>
					</div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="addMinutes()">Add Minutes</button>
			</div>
		</div>
	</div>
</div>