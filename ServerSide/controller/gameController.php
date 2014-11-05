<?php
function __autoload( $class ) {
	if($class == "Calculation") {
		include_once( __DIR__."/../calculations/Class." . $class . ".php");
	}
	else {
		include_once( __DIR__."/../model/Class." . $class . ".php" );
	}
}

class gameController {
	
	public function launchAction() {
		return "goToMap";
	}
	
	public function setModeAction( $data ) {
		
		switch($data) {
			case "1":
			case "2":
			case "3":
			case "4":
				break;
			default:
				return array("status" => "error", "errorInfo" => "This mode doesn't exist");
		}
		
		$gameMode = new ChosenMode();
		
		if( $gameMode->setChosenMode( $data ) )
			return array("status" => "success");
		else {
			http_response_code(202);
			return array("error" => "Error while inserting the mode into the DB");
		}
	}
	
	public function endOfTurnAction( $datas ){
		$calculation = new Calculation(
			array(
				"HistoricID" => 1,
				"Game_GameID" => 1,
				"Turn" => 1,
				"nbrKings" => 1,
				"nbrPriests" => 10,
				"nbrScribes" => 15,
				"nbrSoldiers" => 20,
				"nbrSlaves" => 200,
				"nbrPeasants" => 500,
				"nbrCraftsmen" => 100,
				"Population" => 1000,
				"Wealth" => 800,
				"Food" => 600,
				"PotteryResearched" => 1,
				"GranaryResearched" => 0,
				"WritingResearched" => 1,
				"nbrCaravans" => 3,
				"RampartBuilt" => 1,
				"TempleBuilt" => 1,
				"PalaceBuilt" => 0,
				"MonumentBuilt" => 0
			)
		);
		
		return $calculation->saveIntoDB();
		
		return $calculation->getResult();
	}
	
	
	
}