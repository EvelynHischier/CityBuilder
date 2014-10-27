<?php
/*function __autoload($class){
	include_once __DIR__."/Class.".$class."php";
}*/
class Game {

	private $_pdo;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
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
