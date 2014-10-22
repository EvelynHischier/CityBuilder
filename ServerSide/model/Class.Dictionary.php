<?php
function __autoload($class){
	include_once __DIR__."/Class.".$class.".php";
}
class Dictionary{
	private $_itemType;
	private $_key;
	private $_language;
	private $_text;
	private $_pdo = null;
	
	public function __construct() {
		$this->_pdo = $GLOBALS["pdo"];
	}
	
	public static function newTranslation($key,$language,$text){
		$instance = new self();
		$instance->setKey($key);
		$instance->setLanguage($language);
		$instance->setText($text);
		//$instance->_itemType=new ItemType();
		return $instance;
	}
	public function getKey(){
		return $this->_key;
	}
	public function setKey($key){
		$this->_key=$key;
	}
	public function getLanguage(){
		return $this->_language;
	}
	public function setLanguage($language){
		$this->_language=$language;
	}
	public function getText(){
		return $this->_text;
	}
	public function setText($text){
		$this->_text=$text;
	}
	
	public function getError(){
		if($this->_pdo->errorCode()!='00000')
			return 'Query failed';
	}
	public function getDictionary($key,$language){
		//$texts = array();
		$query="select Language, `key`, `text` from Dictionary where `Language` = \"fr\"";
		//$pdo = $GLOBALS["pdo"];
		
		$result= $this->_pdo->query($query);
		$texts = $result->fetchAll(PDO::FETCH_ASSOC);
// 		/*if($this->getError())
// 			trigger_error($this->getError());*/
// 		while($row =$result->fetch()){
// 			$texts[0]=$row['Key'];
// 			$texts[1]=$row['Language'];
// 			$texts[2]=$row['Text'];
// 		}
// 		$result->closeCursor();

		return $texts;
	}
}