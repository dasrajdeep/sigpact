<h1>PEOPLE @SiGPACT</h1>

<div>
	<div class="row">
	<?php
		$profiles = $view_vars;
		
		$profile_count = 0;
			
		foreach($profiles as $profile) {
			$profile_count++;
			
			if($profile['photo'] == null) $src = Helper::getContentLink('default_profile_photo.jpg');
			else $src = 'data:'.$profile['mime'].';base64,'.$profile['photo'];
			?>
				<div class="col-sm-6 col-md-4">
					<a href="<?php echo BASE_URI.'profile/'.$profile['acc_no']; ?>"><div class="thumbnail">
						<img src="<?php echo $src; ?>" alt="Profile Photo" />
						<div class="caption" style="text-align: center">
							<span style="font-family: Arial,sans-serif;"><?php echo $profile['first_name']; ?></span>
						</div>
					</div></a>
				</div>
			<?php
		}
	?>
		<!--<div class="col-sm-6 col-md-4">
			<a href="<?php echo BASE_URI.'people'; ?>"><div class="thumbnail">
				<div class="caption" style="text-align: center">
					SEE ALL PROFILES
					<span class="glyphicon glyphicon-share"></span>
				</div>
			</div></a>
		</div>-->
	</div>
</div>