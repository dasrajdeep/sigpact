<?php
	$profile = $view_vars[0];
	$photo = $view_vars[1]; 
?>

<div class="col-md-5" style="text-align: right">
	<?php if(Session::getUserID() == $profile->id) { ?><a href="javascript:changeProfilePhoto()"><?php } ?>
		<img id="profile_pic" width="200px" height="200px" src="<?php 
			if($profile->photo_id == null) echo Helper::getContentLink('default_profile_photo.jpg');
			else echo 'data:'.$photo->mime.';base64,'.$photo->standard; 
		?>" alt="Profile Picture" />
	<?php if(Session::getUserID() == $profile->id) { ?></a><?php } ?>
</div>

<div class="col-md-7">
	<h2><?php echo $profile->full_name; ?></h2>
	<h4><?php echo $profile->programme; ?></h4>
	<h3><?php echo $profile->department; ?></h3>
	<a href="mailto:<?php echo $profile->email; ?>"><h5><?php echo $profile->email; ?></h5></a>
</div>