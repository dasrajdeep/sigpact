<?php
	$profile = $view_vars[0];
	$own_profile = $profile['acc_no'] == Session::getUserID();
?>

<div class="col-md-6" style="position: relative; top: 200px;">
	<div class="col-md-5">
		<?php if(Session::getUserID() == $profile['acc_no']) { ?><a href="javascript:changeProfilePhoto()"><?php } ?>
			<img style="background-color: #FFFFFF; padding: 3px;" id="profile_pic" width="150px" height="170px" src="<?php 
				if($profile['photo'] == null) echo Helper::getContentLink('default_profile_photo.jpg');
				else echo 'data:'.$profile['mime'].';base64,'.$profile['photo']; 
			?>" alt="Profile Picture" />
		<?php if(Session::getUserID() == $profile['acc_no']) { ?></a><?php } ?>
	</div>
	<div class="col-md-7">
		<h2 <?php if(!$own_profile) echo 'style="margin-top: 0px"'; ?>>
			<?php echo $profile['full_name']; ?><br/>
			<small style="color: #EEEEEE"><?php echo $profile['programme']; ?></small><br/>
			<small style="color: #FFFFFF"><?php echo Utilities::convertToCapitalCase($profile['department']); ?></small>
		</h2>
		<?php if(!$own_profile) { ?>
		<button onclick="showSendMessage()" style="height: 30px" type="button" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span> Message</button>
		<?php } else { ?>	
		<?php } ?>
	</div>
</div>