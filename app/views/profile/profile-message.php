<div id="message-dialog" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="message-label" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3 class="modal-title" id="message-label"><span class="glyphicon glyphicon-envelope"></span> Send a Message</h3>
			</div>
			
			<div class="modal-body">
				<form id="message-form" method="post" class="form-horizontal" action="<?php echo BASE_URI.'rpc/sendMessage'; ?>">
					<div class="form-group">
						<textarea name="message" class="form-control" style="resize: vertical" placeholder="Your message"></textarea>
					</div>
					<input type="hidden" name="recipient" value="<?php echo $view_vars['acc_no']; ?>" />
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="sendMessage()"><span class="glyphicon glyphicon-send"></span> Send</button>
			</div>
		</div>
	</div>
</div>