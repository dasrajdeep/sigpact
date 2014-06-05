<h1>
	<img width="100px" alt="@IITK" src="<?php echo Helper::getContentLink('iitk_logo_150_white.png'); ?>">
	SiGPACT
	<small>@IIT Kanpur</small>
</h1>

<br/>

<div class="panel panel-default col-sm-offset-4 col-sm-4">
	<div class="panel-body">
		<form style="font-size: 25px; color: #333333" id="login-form" class="form-horizontal" method="post" action="<?php echo BASE_URI.'rpc/login'; ?>" role="login">
			<h2 style="font-size: 40px">Sign In</h2>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<input type="email" class="form-control" name="username"placeholder="Email">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-10">
			    	<button style="font-size: large" type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Sign In</button>
			    </div>
			</div>
			
			<a href="javascript:requestAccount()">Request</a> an account
		</form>
	</div>
</div>