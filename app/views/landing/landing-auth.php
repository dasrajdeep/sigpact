<div class="jumbotron">
	
	<form id="login-form" class="form-horizontal" method="post" action="<?php echo BASE_URI.'rpc/login'; ?>" role="login">
		<h1>Sign In</h1>
		
		<div class="form-group">
			<div class="col-sm-10">
				<input type="email" class="form-control" name="username"placeholder="Email">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-10">
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-0 col-sm-10">
		    	<button type="submit" class="btn btn-default">Sign In</button>
		    </div>
		</div>
		
		<a href="javascript:requestAccount()">Request</a> an account
	</form>
	
	<form id="request-form" class="form-horizontal" method="post" action="<?php echo BASE_URI.'rpc/requestAccount'; ?>" role="login" style="display: none;">
		<h1>Request an Account</h1>
		
		<div class="form-group">
			<div class="col-sm-10">
				<input type="email" class="form-control" name="email"placeholder="Your Email">
			</div>
		</div>
		
		<div class="form-group">
			<div class="col-sm-offset-0 col-sm-10">
		    	<button type="submit" class="btn btn-default">Request Account</button>
		    </div>
		</div>
		
		<a href="javascript:signIn()">Sign In</a> with your existing account
	</form>
	
	<div id="notifications">
		<?php Helper::addViewComponent('alert-dialog'); ?>
	</div>
	
</div>