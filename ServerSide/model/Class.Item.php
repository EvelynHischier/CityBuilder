<?php

class Item{
	private $_pdo;
	
	public function __construct(){
		$this->_pdo = $GLOBALS["pdo"];
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//method to get all items
	public function getItems() {
		$query = "SELECT `ItemType_ItemTypeID`, `Game_GameID`, `Number`, `Turn` FROM Item";
		$result= $this->_pdo->prepare($query);
		$result->execute(array());
		if($this->getError())
			trigger_error($this->getError());
		$items = $result->fetchAll(PDO::FETCH_ASSOC);
	
		return $items;
	}
}