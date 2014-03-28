<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('theme.css');
?>

<div class="container">
	<?php Helper::addViewComponent('landing-header'); ?>
	
	<div class="jumbotron" style="text-align: center;">
		<h1>Create Your Password</h1>
		
		<form id="password-form" class="form-horizontal col-md-4 col-md-offset-4" method="post" action="<?php echo BASE_URI.'createpassword'; ?>" role="password-change">
			
			<input type="hidden" name="hash" value="<?php echo $view_vars; ?>" />
			
			<div class="form-group">
				<div class="col-sm-12">
					<input type="password" class="form-control" name="password" placeholder="Password">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-12">
					<input type="password" class="form-control" name="re-password" placeholder="Confirm Password">
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-12">
			    	<button type="submit" class="btn btn-default">Create Password</button>
			    </div>
			</div>
		</form>
	</div>
</div>