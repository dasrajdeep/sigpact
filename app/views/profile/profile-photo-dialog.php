<div id="photo-dialog" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="photo-upload-label" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="photo-upload-label"><span class="glyphicon glyphicon-open"></span> Upload a Photo</h3>
			</div>
			
			<div class="modal-body">
				<form id="photo-form" method="post" enctype="multipart/form-data" action="<?php echo BASE_URI.'rpc/updateProfilePhoto'; ?>">
					<h4>Use a local file</h4>
					<input id="photo-file" type="file" name="photo" />
					<input type="hidden" name="marker" value="photo-update" />
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="updateProfilePhoto()">Change Photo</button>
			</div>
		</div>
	</div>
</div>