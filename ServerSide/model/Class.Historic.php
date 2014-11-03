<?php

/*function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}*/

class Historic{
	
	
	public function __construct(){
		$this->_pdo = $GLOBALS["pdo"];
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//method to get all needed variables to save the game and keep a historic
	public function insertHistoric($game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,$time,$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument) {
		//insert query
		$query = "INSERT INTO Historic (Game_GameID, Turn, nbrKings, nbrPriests, nbrScribes, nbrSoldiers, nbrSlaves, nbrPeasants, nbrCraftsmen, Population, Wealth, Food, ElapsedTime, Score, PotteryResearched, GranaryResearched, WritingResearched, nbrCaravans, TempleBuilt, PalaceBuilt, MonumentBuilt) ".
				"VALUES ($game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,'$time',$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument)";
		
		$result = $this->_pdo->prepare($query);
		$result->execute();
		if($this->getError())
			trigger_error($this->getError());
		
	}
}
