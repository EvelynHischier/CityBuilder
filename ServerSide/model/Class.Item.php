<?php
function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}

class Item{
	/*private $_itemType;
	private $_game;
	private $_number;
	private $_turn;*/
	private $_pdo;
	
	public function __construct($number,$turn){
		/*$this->setNumber($number);
		$this->setTurn($turn);
		$this->_game=new Game();
		$this->_itemType=new ItemType();*/
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	/*public function getNumber(){
		return $this->_number;
	}
	public function setNumber($number){
		$this->_number=$number;
	}
	public function getTurn(){
		return $this->_turn;
	}
	public function setTurn($turn){
		$this->_turn=$turn;
	}*/
	
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