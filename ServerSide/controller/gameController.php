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
				return false;
		}
		
		return "The game mode has been set to " . $data;
	}
	
}