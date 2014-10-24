<?php
class ItemType{
	/*private $_name;
	private $_description;
	private $_min;
	private $_max;*/
	private $_pdo;
	
	public function __construct(){
		/*$this->setName($name);
		$this->setDescription($description);
		$this->setMin($min);
		$this->setMax($max);*/
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	/*public function getDescription(){
		return $this->_description;
	}
	public function setDescription($description){
		$this->_description=$description;
	}
	public function getName(){
		return $this->_name;
	}
	public function setName($name){
		$this->_name=$name;
	}
	public function getMin(){
		return $this->_min;
	}
	public function setMin($min){
		$this->_min=$min;
	}
	public function getMax(){
		return $this->_max;
	}
	public function setMax($max){
		$this->_max=$max;
	}*/
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