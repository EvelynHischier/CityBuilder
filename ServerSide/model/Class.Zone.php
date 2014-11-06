<?php
class Zone{
private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//method to get a zone with a specific name
	//entry value: name
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