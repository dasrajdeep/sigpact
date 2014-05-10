<div id="aboutme-dialog" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="aboutme-label" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="aboutme-label"><span class="glyphicon glyphicon-tags"></span> Write About Yourself</h3>
			</div>
			
			<div class="modal-body">
				<form id="aboutme-form" method="post" enctype="multipart/form-data" action="<?php echo BASE_URI.'rpc/updateAboutMe'; ?>">
					<textarea rows="10" name="aboutme" style="width: 100%; resize: vertical;"><?php echo $view_vars[0]->about_me; ?></textarea>
					<input type="hidden" name="marker" value="aboutme-update" />
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="updateAboutMe()">Save Changes</button>
			</div>
		</div>
	</div>
</div>