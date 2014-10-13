<?php
class Authentication {
	
	public function authenticate( $user ) {
		
		if($user->pseudo == "" && $user->password == "") {
			return true;
		}
		
		if( !isset($user->pseudo) || !isset($user->password) ) {
			return false;
		}
		
		if($user->pseudo != "mehdi" || $user->password != "pwd") {
			return false;
		}
		
		return true;
	}
	
}