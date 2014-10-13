<?php
function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}
class ChosenMode{
	private $_time;
	private $_mode;
	
	public function __construct($time){
		$this->setTime($time);
		$this->_mode=new Mode();
	}
	public function getTime(){
		return $this->_time;
	}
	public function setTime($time){
		$this->_time=$time;
	}
}