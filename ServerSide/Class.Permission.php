<?php
class Permission {
	
	private $playerAuthorisation = array(
		"login/disconnect",
		"login/connect"
		);
	
	private $adminAuthorisation = array(
		"game/setMode"
		);
	
	public function checkPermission( $user, $functions ) {
		$response = "";
		return $response;
		
		foreach($functions as $index => $object) {
			
			$path = $object["path"];
			$thisPath = false;
			
			if( in_array( $path, $this->playerAuthorisation ) )
				$thisPath = true;
			else if( $user->admin && in_array( $path, $this->adminAuthorisation ) )
				$thisPath = true;
			
			if(!$thisPath) {
				if ($response != "")
					$response.=" ; ";
				
				$response.= $path;
			}
		}
		
		if($response != "")
			$response = "Permission denied for paths : ".$response;
		
		return $response;
	}
}