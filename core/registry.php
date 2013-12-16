<?php

	$runtime_scripts=array(
		'Main.js',
		'DisplayManager.js',
		'Loaders.js',
		'RPC.js'
	);
	
	$vendor_content=array(
		'glyphicons-halflings-regular.eot'=>'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.eot',
		'glyphicons-halflings-regular.svg'=>'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.svg',
		'glyphicons-halflings-regular.ttf'=>'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.ttf',
		'glyphicons-halflings-regular.woff'=>'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.woff',
		'boostrap.complete.min.css'=>'lib/bootstrap-3.0.3/packed/boostrap.complete.min.css',
		'bootstrap.min.js'=>'lib/bootstrap-3.0.3/packed/bootstrap.min.js',
		'jquery-1.10.2.js'=>'lib/jquery-1.10.2.js',
		'jquery-ui-1.10.3.js'=>'lib/jquery-ui-1.10.3.js'
	);
	
	$libraries=array(
		'jquery'=>array(
			'local'=>array($rootPath.'lib/jquery-1.10.2.js'),
			'cdn'=>array('http://code.jquery.com/jquery-1.10.1.min.js')
		),
		'jquery-ui'=>array(
			'local'=>array($rootPath.'lib/jquery-ui-1.10.3.js'),
			'cdn'=>array('//code.jquery.com/ui/1.10.3/jquery-ui.js')
		),
		'bootstrap'=>array(
			'local'=>array(
				$rootPath.'lib/bootstrap-3.0.3/packed/boostrap.complete.min.css',
				$rootPath.'lib/bootstrap-3.0.3/packed/bootstrap.min.js',
				$rootPath.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.eot',
				$rootPath.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.svg',
				$rootPath.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.ttf',
				$rootPath.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.woff'
			),
			'cdn'=>array(
				'//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css',
				'//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'
			)
		)
	);

?>
