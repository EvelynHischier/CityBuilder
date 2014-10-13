<?php
class Zone{
	private $_description;
	private $_picture;
	
	public function __construct($description,$picture){
		$this->setPicture($picture);
		$this->setDescription($description);
	}
	
	public function getDescription(){
		return $this->_description;
	}
	public function setDescription($description){
		$this->_description=$description;
	}
	public function getPicture(){
		return $this->_picture;
	}
	public function setPicture($picture){
		$this->_picture=$picture;
	}
}