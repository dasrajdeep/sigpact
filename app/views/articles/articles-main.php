<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
	Helper::addDependancy('font-awesome');
	Helper::addDependancy('summernote');
	Helper::addDependancy('articles.js');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="container">
	
	<div id="set-a">
		<h1>ARTICLES from SiGPACT</h1>
		<a href="javascript:showCreateArticleDialog()"><h4><span class="glyphicon glyphicon-edit"></span> Write an Article</h4></a>
	</div>
	
	<form class="form-horizontal" id="article-form" method="post" action="">
		<h1>Create an Article</h1>
		
		<div class="form-group">
			<div class="col-sm-12">
				<input type="text" class="form-control" name="title" value="" placeholder="Title of your article">
			</div>
		</div>
		
		<div style=" background-color: #FFFFFF">
			<textarea id="articles-editor" style="overflow:scroll; max-height:300px;"></textarea>
		</div>
		
		<br/>
		
		<div class="form-group">
			<div class="col-sm-10">
				<button type="button" class="btn btn-default">Save Changes</button>
				<button type="button" class="btn btn-default" onclick="restoreArticleView()">Cancel</button>
			</div>
		</div>
	</form>
	
	<div id="published-articles"></div>
</div>