<?php

class Entity {
	
	private   $globalKey=null;
	protected $objKey=null;
	
	public function setGlobalKey($key) {
		$this->globalKey=$key;
	}
	
	public function getGlobalKey() {
		return $this->globalKey;
	}
	
	public function setKeyName($name) {
		$this->objKey=$name;
	}
	
	public function getKeyName() {
		return $this->objKey;
	}
	
}

?>
