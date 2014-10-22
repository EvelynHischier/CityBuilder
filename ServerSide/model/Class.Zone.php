<?php
class Zone{
	private $_name;
	private $_picture;
	
	public function __construct($name,$picture){
		$this->setPicture($picture);
		$this->setName($name);
	}
	
	public function getName(){
		return $this->_name;
	}
	public function setName($name){
		$this->_name=$name;
	}
	public function getPicture(){
		return $this->_picture;
	}
	public function setPicture($picture){
		$this->_picture=$picture;
	}
}