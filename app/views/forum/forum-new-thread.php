<div class="modal fade" id="createThreadDialog" tabindex="-1" role="dialog" aria-labelledby="threadUnknownLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="threadUnknownLabel"><span class="glyphicon glyphicon-plus-sign"></span> Start A Thread</h4>
			</div>
			
			<div class="modal-body">
				<form class="form-horizontal" id="thread-form" method="post" action="<?php echo BASE_URI.'rpc/createForumThread'; ?>">
					
					<div class="form-group">
						<div class="col-sm-10">
							<input type="text" class="form-control" name="title" value="" placeholder="Title of thread">
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-sm-10">
							<textarea style="resize: vertical" class="form-control" name="description" value="" placeholder="Description"></textarea>
						</div>
					</div>
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary" onclick="createThread()">Start Thread</button>
			</div>
		</div>
	</div>
</div>