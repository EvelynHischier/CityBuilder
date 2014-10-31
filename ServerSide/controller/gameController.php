<?php
function __autoload( $class ) {
	include_once( __DIR__."/../model/Class." . $class . ".php" );
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
	
	public function getEndOfTurnAction(){
		
		$calculation = new Calculation();
	}
	
	
	
}