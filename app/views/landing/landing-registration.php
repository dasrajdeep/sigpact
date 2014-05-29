<h1>
	<img width="100px" alt="@IITK" src="<?php echo Helper::getContentLink('iitk_logo_150_white.png'); ?>">
	SiGPACT
	<small>@IIT Kanpur</small>
</h1>

<br/>

<div class="panel panel-default col-sm-offset-4 col-sm-4">
	<div class="panel-body">
		<form style="font-size: 25px; color: #333333" id="request-form" class="form-horizontal" method="post" action="<?php echo BASE_URI.'rpc/requestAccount'; ?>" role="registration">
			<h1 style="font-size: 40px">Request an Account</h1>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<input type="email" class="form-control" name="email"placeholder="Your Email">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
			    	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> Request Account</button>
			    </div>
			</div>
			
			<a href="javascript:signIn()">Sign In</a> with your existing account
		</form>
	</div>
</div>