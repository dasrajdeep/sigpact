<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('typeahead');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('font-awesome');
	Helper::addDependancy('summernote');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('moment.min.js');
	Helper::addDependancy('utilities.js');
	Helper::addDependancy('meetings-view.js');
	
	Helper::addViewComponent('progress-view');
	Helper::addViewComponent('alert-dialog');
	Helper::addViewComponent('meetings-add-minutes', $view_vars['meeting']['meeting_id']);
	
	$meeting = $view_vars['meeting'];
	$people  =$view_vars['participants'];
	$files = $view_vars['files'];
	
	if($meeting['datetime'] < time()) $old = true;
	else $old = false;;
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 1); ?></div>

<div class="container col-md-8 col-md-offset-2">
	<h1><?php echo $meeting['agenda']; ?></h1>
	
	<h2>
		<small>called by </small>
		<?php
			if(!$meeting['thumbnail']) $meeting_src = Helper::getContentLink('default_profile_photo.jpg');
			else $meeting_src = 'data:'.$meeting['mime'].';base64,'.$meeting['thumbnail']; 
		?>
		<img class="img-circle" style="vertical-align: middle" width="50px" height="50px" src="<?php echo $meeting_src; ?>" />
		<a href="<?php echo BASE_URI.'profile/'.$meeting['acc_no']; ?>">
			<?php if(Session::getUserID() == $meeting['acc_no']) echo 'You'; else echo $meeting['full_name']; ?>
		</a>
	</h2>
	
	<div class="jumbotron">
		<div class="panel panel-default">
			<div class="panel-body">
				<?php if($old) { ?>
				<h2><span class="glyphicon glyphicon-dashboard"></span> Minutes of Meeting</h2>
				<blockquote><div id="minutes-text">
					<?php echo $meeting['minutes']; ?>
				</div></blockquote>
				<button type="button" class="btn btn-primary" onclick="showMinutesDialog()"><span class="glyphicon glyphicon-pencil"></span> Edit</button>
				<?php if(count($files) > 0) { ?>
				<div id="minutes-files">
					<h2>Files</h2>
					<ul>
						<?php foreach($files as $file) { ?>
							<li><a href="#"><?php echo $file['filename']; ?></a></li>
						<?php } ?>
					</ul>
				</div>
				<?php } ?>
				<?php } else { ?>
				<blockquote>
					<?php 
						if(strlen($meeting['description']) > 0) echo $meeting['description'];
						else echo $meeting['agenda']; 
					?>
				</blockquote>
				<?php } ?>
			</div>
		</div>
		<h2>DATE: <small><?php echo date('l, jS F Y', $meeting['datetime']); ?></small></h2>
		<?php if(!$old) { ?>
		<h2>VENUE: <small><?php echo strtoupper($meeting['venue']); ?></small></h2>
		<h2>TIMING: <small><?php echo date('g:i A', $meeting['datetime']).' to '.date('g:i A', $meeting['datetime']+($meeting['duration']*60)); ?></small></h2>
		<?php } ?>
	</div>
	
	<?php if($old) { ?>
	<h2>Who all attended</h2>
	<?php } else { ?>
	<h2>Who all are attending</h2>
	<?php } ?>
	
	<div>
		<?php
			foreach($people as $person) {
				if(!$person['thumbnail']) $src = Helper::getContentLink('default_profile_photo.jpg');
				else $src = 'data:'.$person['mime'].';base64,'.$person['thumbnail'];  
		?>
			<div style="padding: 5px">
			<a href="<?php echo BASE_URI.'people/'.$person['acc_no']; ?>">
				<img class="img-circle" style="vertical-align: middle" width="50px" height="50px" src="<?php echo $src; ?>" />
				<h3 style="display: inline"><?php if(Session::getUserID() == $person['acc_no']) echo 'You'; else echo $person['first_name']; ?></h3>
			</a>
			</div>
		<?php } ?>
	</div>
</div>