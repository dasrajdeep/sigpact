<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container" style="text-align: center">
	<h1>YOUR ACCOUNT SETTINGS</h1>
	
	<div class="jumbotron">
		<div class="panel panel-default">
			<div class="panel-body" style="text-align: left">
				<!-- Privacy: me, professors, everyone, custom -->
				<form class="form-horizontal" method="post" role="settings">
					<div class="form-group">
						<div class="col-sm-10">
							<h3>Who can view my articles</h3>
							<div class="radio-inline">
								<label>
									<input type="radio" name="privacy_article" checked> Everyone
								</label>
							</div>
							<div class="radio-inline">
								<label>
									<input type="radio" name="privacy_article"> Professors
								</label>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>