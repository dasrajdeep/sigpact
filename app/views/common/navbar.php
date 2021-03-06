<nav class="navbar navbar-default navbar-fixed-top" role="navigation">

	<div class="navbar-header">
		<a class="navbar-brand" href="<?php echo BASE_URI; ?>" style="padding: 0px; margin: 0px; margin-top: 15px; margin-left: 60px">
			<img style="position: absolute; left: 5px; top: 0px;" height="50px" alt=" " src="<?php echo Helper::getContentLink('iitk_logo_50_bar.png'); ?>" />
			<b>SiGPACT</b>
			<small><i>@IITK</i></small>
		</a>
	</div>
	
	<div class="collapse navbar-collapse">
		<ul class="nav navbar-nav navbar-right">
			<li>
				<a href="<?php echo BASE_URI; ?>home">
					<span class="glyphicon glyphicon-home"></span>
					Home
				</a>
			</li>
			
			<li>
				<a href="<?php echo BASE_URI; ?>messages">
					<span class="glyphicon glyphicon-envelope"></span>
					Messages
				</a>
			</li>
			
			<!--<li>
				<a href="<?php echo BASE_URI; ?>notifications">
					<span class="glyphicon glyphicon-globe"></span>
					Notifications
				</a>
			</li>-->
			
			<!--<li>
				<form class="navbar-form navbar-left" role="search" style="padding: 0px; margin: 0px; margin-top: 4px">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search" style="height: 25px">
						<span class="input-group-addon" style="padding: 4px"><span class="glyphicon glyphicon-search"></span></span>
					</div>
				</form>
			</li>-->
			
			<li>
				<a href="<?php echo BASE_URI.'profile'; ?>">
					<span class="glyphicon glyphicon-user"></span>
					<?php echo Session::getVar('first_name'); ?>
				</a>
			</li>
			
			<li class="dropdown">
				<a href="" class="dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-cog"></span>
					<b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li>
						<a href="<?php echo BASE_URI; ?>settings">
							<span class="glyphicon glyphicon-wrench"></span>
							Account Settings
						</a>
					</li>
					<li>
						<a href="<?php echo BASE_URI; ?>logout">
							<span class="glyphicon glyphicon-off"></span>
							Logout
						</a>
					</li>
				</ul>
			</li>
			
			<li><div style="width: 10px"></div></li>
		</ul>
	</div>

</nav>