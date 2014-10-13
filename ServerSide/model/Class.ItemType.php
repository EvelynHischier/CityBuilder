<?php
class ItemType{
	private $_name;
	private $_description;
	private $_min;
	private $_max;
	
	public function __construct($name,$description,$min,$max){
		$this->setName($name);
		$this->setDescription($description);
		$this->setMin($min);
		$this->setMax($max);
	}
	
	public function getDescription(){
		return $this->_description;
	}
	public function setDescription($description){
		$this->_description=$description;
	}
	public function getName(){
		return $this->_name;
	}
	public function setName($name){
		$this->_name=$name;
	}
	public function getMin(){
		return $this->_min;
	}
	public function setMin($min){
		$this->_min=$min;
	}
	public function getMax(){
		return $this->_max;
	}
	public function setMax($max){
		$this->_max=$max;
	}
}