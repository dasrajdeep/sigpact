<?php
	
	/**
	 * -----------------------------------
	 * GLOBAL REGISTRY FOR STATIC CONTENT.
	 * -----------------------------------
	 */
	
	defined('SYSTEM_STARTED') or die('You are not permitted to access this resource.');
	
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
			'local'=>array(BASE_URI.'lib/jquery-1.10.2.js'),
			'cdn'=>array('http://code.jquery.com/jquery-1.10.1.min.js')
		),
		'jquery-ui'=>array(
			'local'=>array(BASE_URI.'lib/jquery-ui-1.10.3.js'),
			'cdn'=>array('//code.jquery.com/ui/1.10.3/jquery-ui.js')
		),
		'jquery-form'=>array(
			'local'=>array(BASE_URI.'lib/jquery.form.js'),
			'cdn'=>array('')
		),
		'bootstrap'=>array(
			'local'=>array(
				BASE_URI.'lib/bootstrap-3.0.3/packed/bootstrap.complete.min.css',
				BASE_URI.'lib/bootstrap-3.0.3/packed/bootstrap.min.js',
				BASE_URI.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.eot',
				BASE_URI.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.svg',
				BASE_URI.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.ttf',
				BASE_URI.'lib/bootstrap-3.0.3/fonts/glyphicons-halflings-regular.woff'
			),
			'cdn'=>array(
				'//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css',
				'//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js'
			)
		)
	);
	
	$php_libraries=array(
		'redbean'=>array('lib/redbeanphp-3.5.4/rb.php')
	);

?>
