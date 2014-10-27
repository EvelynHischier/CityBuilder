<?php
function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}

class Item{
	private $_pdo;
	
	public function __construct(){
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
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