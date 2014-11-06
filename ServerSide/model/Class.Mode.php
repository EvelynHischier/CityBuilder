<?php
class Mode{
private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	//method to get all modes
	public function getModes(){
		$query="select `Name` from Mode";
		$result= $this->_pdo->prepare($query);
		$result->execute(array());
		if($this->getError())
			trigger_error($this->getError());
		$modes = $result->fetchAll(PDO::FETCH_ASSOC);
		return $modes;
	}
}