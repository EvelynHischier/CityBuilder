<?php
function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}
class Item{
	private $_itemType;
	private $_game;
	private $_number;
	private $_turn;
	
	public function __construct($number,$turn){
		$this->setNumber($number);
		$this->setTurn($turn);
		$this->_game=new Game();
		$this->_itemType=new ItemType();
	}
	public function getNumber(){
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
	}
}