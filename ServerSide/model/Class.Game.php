<?php
/*function __autoload($class){
	include_once __DIR__."/Class.".$class."php";
}*/
class Game {
	/*private $_mode;
	private $_user;
	private $_zone;
	private $_start;
	private $_end;*/
	private $_pdo;
	
	public function __construct() {
		/*$now = new DateTime();
		$this->setStart($now->format('Y-m-d H:i:s'));
		$this->_mode=new Mode();
		$this->_user=new User();
		$this->_zone=new Zone();*/
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	/*public function getStart(){
		return $this->_start;
	}
	
	public function setStart($start){
		$this->_start=$start;
	}
	
	public function getEnd(){
		return $this->_end;
	}
	
	public function setEnd($end){
		$this->_end=$end;
	}*/
	
	public function getGames() {
		$query = "SELECT `Mode_ModeID`, `Zone_ZoneID`, `User_UserID`, `Start`, `End` FROM Game";
	
	
		$result= $this->_pdo->prepare($query);
		$result->execute(array());
		if($this->getError())
			trigger_error($this->getError());
		$games = $result->fetchAll(PDO::FETCH_ASSOC);
	
		return $games;
	}
}
