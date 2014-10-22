<?php
class Dictionary{
	private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}

	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	
	public function getDictionary($language){
		$query="select language, `key`, `text` from Dictionary where `Language` = ?";
		
		$result= $this->_pdo->prepare($query);
		$result->execute(array($language));
		if($this->getError())
			trigger_error($this->getError());
		$texts = $result->fetchAll(PDO::FETCH_ASSOC);

		return $texts;
	}
}
