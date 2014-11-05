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
		
		$calculation = new Calculation($datas);
		
		$result = $calculation->saveIntoDB();
		if($result == "")
			return $calculation->getResult();
			
		return "error";
	}
	
	
	
}