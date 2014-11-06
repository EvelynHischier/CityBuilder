<?php

class Game {

	private $_pdo;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//method to get all games
	public function getGames() {
		$query = "SELECT `Mode_ModeID`, `Zone_ZoneID`, `User_UserID`, `Start`, `End` FROM Game";
		$result= $this->_pdo->prepare($query);
		$result->execute(array());
		if($this->getError())
			trigger_error($this->getError());
		$games = $result->fetchAll(PDO::FETCH_ASSOC);
	
		return $games;
	}
	//method to insert a new game
	//entry values: ModeID, ZoneID, UserID, Start
	public function insertGame($Mode_ModeID,$Zone_ZoneID,$User_UserID,$Start){
		$query = "INSERT INTO Game (Mode_ModeID,Zone_ZoneID,User_UserID,Start) ".
				"VALUES ($Mode_ModeID,$Zone_ZoneID,$User_UserID,$Start)";
		$result = $this->_pdo->prepare($query);
		$result->execute();
		if($this->getError())
			trigger_error($this->getError());
	}
}
