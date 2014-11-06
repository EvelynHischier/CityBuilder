<?php
class Dictionary{
	private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	//method to catch the error in the connection to the DB
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	//method to get all elements from a specific language
	//entry value: language
	public function getDictionary($language){
		$query="select `Language`, `Key`, `Text` from Dictionary where `Language` = ?";
		$result= $this->_pdo->prepare($query);
		$result->execute(array($language));
		if($this->getError())
			trigger_error($this->getError());
		$texts = $result->fetchAll(PDO::FETCH_ASSOC);
		return $texts;
	}
}
