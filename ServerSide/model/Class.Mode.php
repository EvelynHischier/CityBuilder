<?php
class Mode{
	private $_name;
	public function __construct($name){
		$this->setName($name);
	}
	public function getName(){
		return $this->_name;
	}
	public function setName($name){
		$this->_name=$name;
	}
}

class Mode {
	private $id;
	private $name;
	
	public function getByName($n) {
	}
	
	public function getById($i) {
		
	}
	
	public function getAll() {
		
	}
	
	public function getChoosenMode() {
		$id = $response[0]["id"];
		$name = $response[0]["name"];
	}
}