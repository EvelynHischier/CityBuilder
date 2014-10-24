<?php
class ItemType{
	private $_pdo;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}

	public function getItemTypes() {
		$query = "SELECT `ItemTypeID`, `Name`, `Min`, `Max`, `Description` FROM ItemType";
		
		
		$result= $this->_pdo->prepare($query);
		$result->execute(array());
		if($this->getError())
			trigger_error($this->getError());
		$itemTypes = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $itemTypes;
	}
}