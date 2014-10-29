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
			case "block":
			case "placement_only":
			case "5turns":
			case "infinite":
				break;
			default:
				return array("status" => "error", "errorInfo" => "This mode doesn't exist");
		}
		
		$gameMode = new Mode();
		
		if( $gameMode->setMode( $data ) )
			return array("status" => "success");
		else {
			http_response_code(202);
			return array("error" => "Error while inserting the mode into the DB");
		}
	}
	
}