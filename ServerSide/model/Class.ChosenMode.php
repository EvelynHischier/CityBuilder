<?php
class ChosenMode {
	private $_pdo;
	public function __construct() {
		$this->_pdo = $GLOBALS ["pdo"];
	}
	// method to catch the error in the connection to the DB
	public function getError() {
		if ($this->_pdo->errorCode () != '00000')
			return 'Query failed';
	}
	// method to set a mode
	//entry value: mode
	public function setChosenMode($mode) {
		$query = "INSERT INTO ChosenMode( `Mode_ModeID` ) VALUES( ? )";
		$statement = $this->_pdo->prepare ( $query );
		$statement->execute ( array ($mode));
		if ($this->getError ()) {
			trigger_error ( $this->getError () );
			return false;
		} else
			return true;
	}
	// method to get all choosen modes
	public function getChosenModes() {
		$query = "SELECT `Mode_ModeID`, `Time` FROM ChosenMode";
		$result = $this->_pdo->prepare ( $query );
		$result->execute ( array ());
		if ($this->getError ())
			trigger_error ( $this->getError () );
		$chosenModes = $result->fetchAll ( PDO::FETCH_ASSOC );
		
		return $chosenModes;
	}
}