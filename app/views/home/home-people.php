<h1>PEOPLE @SiGPACT</h1>

<div>
	<?php
		$profiles = $view_vars[0];
		$photos = $view_vars[1];
		
		foreach($profiles as $profile) {
			$photo = $photos[$profile['id_no']];
			if($photo == null) $src = Helper::getContentLink('default_profile_photo.jpg');
			else $src = 'data:'.$photo->mime.';base64,'.$photo->thumbnail;
			?>
			<div class="row">
				<div class="col-sm-6 col-md-4">
					<a href="#"><div class="thumbnail">
						<img src="<?php echo $src; ?>" alt="Profile Photo" />
						<div class="caption" style="text-align: center">
							<span style="font-family: Arial,sans-serif;"><?php echo $profile['first_name']; ?></span>
						</div>
					</div></a>
				</div>
			</div>
			<?php
		}
	?>
</div>