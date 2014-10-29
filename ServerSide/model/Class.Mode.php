<?php
class Mode{
private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}

	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	
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