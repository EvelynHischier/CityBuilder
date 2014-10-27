<?php
/*function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}*/
class ChosenMode{
	/*private $_time;
	private $_mode;*/
	private $_pdo;
	
	public function __construct() {
		/*$this->setTime($time);
		$this->_mode=new Mode();*/
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError() {
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	/*public function getTime(){
		return $this->_time;
	}
	public function setTime($time){
		$this->_time=$time;
	}*/
	
	public function getChosenModes() {
		$query = "SELECT `Mode_ModeID`, `Time` FROM ChosenMode";
	
	
		$result= $this->_pdo->prepare($query);
		$result->execute(array());
		if($this->getError())
			trigger_error($this->getError());
		$chosenModes = $result->fetchAll(PDO::FETCH_ASSOC);
	
		return $chosenModes;
	}
}