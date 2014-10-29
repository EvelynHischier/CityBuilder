<?php
class User {
	private $array;
	function __construct($pseudo, $password, $admin) {
		$this->array ["pseudo"] = $pseudo;
		$this->array ["password"] = $password;
		$this->array ["admin"] = $admin;
	}
	function __get($key) {
		return $this->array [$key];
	}
	// private $_pdo;
	
	// public function __construct() {
	// $this->_pdo = $GLOBALS["pdo"];
	// }
	
	// public function getError(){
	// if($this->_pdo->errorCode()!='00000')
	// return 'Query failed';
	// }
	
	// public function getUsers(){
	// $query="select `Lastname`, `Firstname`, `Username`, `Password`, `Language`, `Admin` from User";
	
	// $result= $this->_pdo->prepare($query);
	// $result->execute(array());
	// if($this->getError())
	// trigger_error($this->getError());
	
	// //$users = array_merge(array(), $result->fetchAll(PDO::FETCH_ASSOC));
	// $users = array();
	
	// // $users = new -
	// // $this->array["pseudo"] = $pseudo;
	// // $this->array["password"] = $password;
	// // $this->array["admin"] = $admin;
	
	// return $users;
	// }
}