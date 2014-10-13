<?php
function __autoload( $class ) {
	include_once( __DIR__."/../model/Class." . $class . ".php" );
}

class gameController {
	
	public function launchAction() {
		return null;
	}
	
	public function setModeAction( $data ) {
		if($data == "test")
			return true;
		else
			return false;
	}
	
}