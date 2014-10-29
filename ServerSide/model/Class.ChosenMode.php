<?php
/*function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}*/
class ChosenMode{

	private $_pdo;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError() {
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	public function setChosenMode( $mode ) {
		$query = "INSERT INTO ChosenMode( `Mode_ModeID` ) VALUES( ? )";
		$statement = $this->_pdo->prepare( $query );
	
		$statement->execute(array($mode));
	
		if($this->getError()) {
			trigger_error($this->getError());
			return false;
		}
		else
			return true;
	}
	
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