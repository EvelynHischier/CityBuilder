<?php

/*function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}*/

class Historic{
	
	
	public function __construct(){
		// $this->_pdo = $GLOBALS["pdo"];
		$this->_pdo = new PDO("mysql:host=db4free.net;
						port=3306;
						dbname=pyramidgame1",
						"groupe1",
						"8?Wzgr10");
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//method to get all needed variables to save the game and keep a historic
	public function insertHistoric($arrayGiven) {//, $game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,$time,$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument) {
		
		$columns = "";
		$keys = "";
		$values = array();
		
		foreach($arrayGiven AS $key => $value) {
			if($key == "unhappiness")
				continue;
				
			if($columns != "") {
				$columns .=", ";
				$keys .= ", ";
			}
				
			$columns .= $key;
			$keys .= ":".$key;
				
			$values[$key] = $value;
		}
		
		// 		$query = "INSERT INTO Historic (Game_GameID, Turn, nbrKings, nbrPriests, nbrScribes, nbrSoldiers, nbrSlaves, nbrPeasants, nbrCraftsmen, Population, Wealth, Food, ElapsedTime, Score, PotteryResearched, GranaryResearched, WritingResearched, nbrCaravans, TempleBuilt, PalaceBuilt, MonumentBuilt) ".
		// 				"VALUES ($game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,'$time',$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument)";
		
		$query = "INSERT INTO Historic (" . $columns . ") VALUES(" . $keys . ")";
		
		$result = $this->_pdo->prepare($query);
		$result->execute($values);
		if($this->getError())
			trigger_error($this->getError());
		
		return "hello";
		
		//insert query
		$query = "INSERT INTO Historic (Game_GameID, Turn, nbrKings, nbrPriests, nbrScribes, nbrSoldiers, nbrSlaves, nbrPeasants, nbrCraftsmen, Population, Wealth, Food, ElapsedTime, Score, PotteryResearched, GranaryResearched, WritingResearched, nbrCaravans, TempleBuilt, PalaceBuilt, MonumentBuilt) ".
				"VALUES ($game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,'$time',$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument)";
		
		$result = $this->_pdo->prepare($query);
		$result->execute();
		if($this->getError())
			trigger_error($this->getError());
		
	}

}
