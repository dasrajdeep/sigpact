<?php
	Helper::setCompleteView();
	Helper::addDependancy('bootstrap');
	Helper::addDependancy('jquery-form');
	Helper::addDependancy('theme.css');
?>

<?php Helper::addViewComponent('navbar'); ?>

<div style="padding-top: 70px;"></div>

<div class="col-md-2" data-spy="affix"><?php Helper::addViewComponent('home-sidebar', 3); ?></div>

<div class="container col-md-10 col-md-offset-2">
	<h2><span class="glyphicon glyphicon-hdd"></span> REPOSITORIES</h2>
	<div class="col-md-5">
		<h1>CODE @SiGPACT</h1>
		<p style="text-align: justify; font-size: large">
			This is the place where you can share source code related to your projects. Note that this code repository
			uses Git as a <a href="http://en.wikipedia.org/wiki/Revision_control">version control system (VCS)</a>. 
			Therefore, you can only upload and version files using Git (as in Github). 
			This has been done to ensure proper versioning of files in the repository and to preserve consistency. If 
			you are unaware of how Git works, you may like to see this <a href="http://git-scm.com/book/en/Getting-Started">reference</a>
			 on Git. In order to learn how to use Git, you can see this <a href="http://git-scm.com/book/en/Git-Basics">tutorial</a>. 
		</p>
	</div>
	<div class="col-md-5">
		<h1>DOCUMENTS @SiGPACT</h1>
	</div>
</div>