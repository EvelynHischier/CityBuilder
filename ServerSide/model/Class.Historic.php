<?php
function __autoload($class){
	include_once __DIR__."../model/Class.".$class."php";
}
class Historic{
	//get all needed variables to save the game and keep a historic
	
	
	private $_pdo;
	private $_wealth;
	private $_food;
	private $_kings;
	private $_slaves;
	private $_soldiers;
	private $_peasants;
	private $_scribes;
	private $_priests;
	private $_craftsmen;
	private $_turn;
	private $_population;
	private $_elapsedTime;
	private $_score;
	private $_pottery;
	private $_granary;
	private $_writing;
	private $_caravans;
	//private $_rampart;
	private $_temple;
	private $_palace;
	private $_monument;
	private $_gameID;
	
	public function __construct(){
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//insert query
	public function insertHistoric($game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,$time,$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument) {
		$query = "INSERT INTO Historic (Game_GameID, Turn, nbrKings, nbrPriests, nbrScribes, nbrSoldiers, nbrSlaves, nbrPeasants, nbrCraftsmen, Population, Wealth, Food, ElapsedTime, Score, PotteryResearched, GranaryResearched, WritingResearched, nbrCaravans, TempleBuilt, PalaceBuilt, MonumentBuilt) ".
				"VALUES ($game,$turn,$kings,$priests,$scribes,$soldiers,$slaves,$peasants,$craftsmen,$population,$wealth,$food,'$time',$score,$pottery,$granary,$writing,$caravans,$temple,$palace,$monument)";
		
		$result = $this->_pdo->prepare($query);
		$result->execute();
		if($this->getError())
			trigger_error($this->getError());
		
	}
}