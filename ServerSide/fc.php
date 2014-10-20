<?php

// includes the user's model
require_once( __DIR__."/model/Class.User.php");

session_start();


// check there's a request
if( isset($_POST["request"]) )
	$request = $_POST["request"];
else {
	http_response_code("401");
	$response = array( "status" => "error", "errorInfo" => "No request" );
	exit( json_encode( $response ) );
}

// prepare MySQL connection
$pdo = new PDO("mysql:host=groupe1.informatiquegestion.ch;
				port=3306;
				dbname=groupe1",
				"groupe1",
				"8?Wzgr10");

// prepare the user's session
if( !isset($_SESSION["user"]) ) {
	$_SESSION["user"] = new User("", "", false);
}

// Check authentication
include_once( __DIR__."/Class.Authentication.php" );
$authentication = new Authentication();

if( !$authentication->authenticate( $_SESSION["user"] ) ) {
	http_response_code("401");
	$response = array( "status" => "error", "errorInfo" => "authentication failed" );
	exit( json_encode( $response ) );
}

// Check permission
include_once(__DIR__."/Class.Permission.php");
$permission = new Permission();
$permissionResponse = $permission->checkPermission( $_SESSION["user"], $request["functions"] );

if( !( $permissionResponse == "" ) ) {
	http_response_code("401");
	$response = array("status" => "error", "errorInfo" => $permissionResponse);
	exit( json_encode($response) );
}

// Call the controller's functions
// include every needed controller, prepare the reflection method and call the method
$responseArray = array();
foreach($request["functions"] as $index => $object) {
	$path = explode( "/", $object["path"] );
	$class = $path[0]."Controller";
	$func = $path[1]."Action";
	
	include_once( __DIR__."/controller/".$class.".php" );
	
	$reflectionMethod = new ReflectionMethod($class, $func);
	$response = $reflectionMethod->invoke( new $class, $object["data"] );
	$responseArray[] = $response;
}
exit( json_encode( $responseArray ) );