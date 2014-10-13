<?php
function __autoload($class){
	include_once __DIR__."/Class.".$class."php";
}
class Dictionary{
	private $_itemType;
	private $_key;
	private $_language;
	private $_text;
	
	public function __construct($key,$language,$text){
		$this->setKey($key);
		$this->setLanguage($language);
		$this->setText($text);
		$this->_itemType=new ItemType();
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
		if($GLOBALS["pdo"]->errorCode()!='00000')
			return 'Query failed';
	}
	public function getDictionary($key,$language){
		$texts =array();
		$query="select * from dictionary where key = '".$key."' and language = '".$language."'";
		$pdo = $GLOBALS["pdo"];
		
		$result= $pdo->query($query);
		if($this->getError())
			trigger_error($this->getError());
		while($row =$result->fetch()){
			$translation=new Dictionary($row['key'], $row['language'], $row['text']);
			$translation->itemType=$row['itemType'];
			$texts[$row['key']]=$translation;
		}
		$result->closeCursor();
		return $texts;
	}
}