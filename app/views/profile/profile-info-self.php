<div class="col-md-5">
	<a href="#">
		<img id="profile_pic" width="100px" height="100px" src="<?php 
			if($view_vars[1]==null) echo Helper::getContentLink('user.png');
			else echo 'data:'.$view_vars[1]->mime.';base64,'.$view_vars[1]->thumbnail; 
		?>" alt="Profile Picture" />
	</a>
</div>

<div class="col-md-7">
	<form class="form-horizontal" name="profile-update-form" method="post" action="">
		<div class="form-group" style="display: none;">
			<div class="col-sm-10">
				<input type="text" class="form-control" name="" value="" placeholder="">
			</div>
		</div>
	</form>
</div>