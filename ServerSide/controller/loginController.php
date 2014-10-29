<?php
class loginController {
	
	public function connectAction( $user ) {
		if( !isset($user["pseudo"]) || !isset($user["password"]) ) {
			http_response_code(401);
			return array("status" => "error", "errorInfo" => "pseudo and password not set");
		}
		
		if($user["pseudo"] != "mehdi" || $user["password"] != "pwd") {
			http_response_code(401);
			return array("status" => "error", "errorInfo" => "pseudo/password incorrect");
		}
		
		$response = new stdClass;
		$response->pseudo = $user["pseudo"];
		$response->password = $user["password"];
		$response->admin = true;
		
		$_SESSION["user"] = $response;
		
		return array("status" => "success");
	}
	
	public function disconnectAction() {
		unset( $_SESSION["user"] );
		
		return array("status" => "success");
	}
	
}