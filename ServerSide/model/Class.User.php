<?php
class User {
	
	private $array;
	
	function __construct($pseudo, $password, $admin) {
		$this->array["pseudo"] = $pseudo;
		$this->array["password"] = $password;
		$this->array["admin"] = $admin;
	}
	
	function __get( $key ) {
		return $this->array[$key];
	}
}