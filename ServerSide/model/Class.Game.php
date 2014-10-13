<?php
function __autoload($class){
	include_once __DIR__."/Class.".$class."php";
}
class Game{
	private $_mode;
	private $_user;
	private $_zone;
	private $_start;
	private $_end;
	
	public function __construct($start,$end){
		$this->setStart($start);
		$this->setEnd($end);
		$this->_mode=new Mode();
		$this->_user=new User();
		$this->_zone=new Zone();
	}
	public function getEnd(){
		return $this->_end;
	}
	public function setEnd($end){
		$this->_end=$end;
	}
	public function getStart(){
		return $this->_start;
	}
	public function setStart($start){
		$this->_start=$start;
	}
}
