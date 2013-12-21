<?php

class ExampleModule {
	
	public function exampleMethod() {
		
		$bean=R::dispense('example');
		
		$bean->member='some variable';
		
		$id=R::store($bean);
		
		return sprintf('Generated ID was %s',$id);
	}
}

?>
