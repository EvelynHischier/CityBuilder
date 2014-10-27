<?php
class Zone{
private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}

	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	public function getZone($name){
		$query="select `Name`, `Picture` from Zone where `Name` = ?";
		
		$result= $this->_pdo->prepare($query);
		$result->execute(array($name));
		if($this->getError())
			trigger_error($this->getError());
		$zones = $result->fetchAll(PDO::FETCH_ASSOC);

		return $zones;
	}
}