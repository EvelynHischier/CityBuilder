/**
 *   On Click action of main Menu
 */

var urlMedhi = "http://127.0.0.1/CityBuilder-ServerSide/fc.php";
var url = "http://127.0.0.1:8080/Git/CityBuilder/ServerSide/fc.php";

function launchGame(){
	var buttonLaunch = $("#button_launch");

	$.ajax({
		url: url,
		type: "POST",
		data:    {
			request: {
				functions: [ {
					path: "game/launch", data: "test"  } ] 
			}
		}
	})
	.done(function( data ){
		alert(" OK " + JSON.stringify(data));
	})
	.fail(function( data ){
		alert("Fail    " +JSON.stringify(data));
	})
	.always(function( data ){
		
	});
}

function displayRules(){
	var buttonLaunch = $("#button_rules");
	
	
	ViewControllerDisplayRules();
// no interaction with the front controller
	// just display the rules
	
}

function displayGameModes(){
	var buttonLaunch = $("#button_modes");
	
	$.ajax({
		url: url,
		type: "POST",
		data:    {
			request: {
				functions: [ {
					path: "game/setMode", data: "test" } ] 
			}
		}
	})
	.done(function( data ){
		alert(" OK " + JSON.stringify(data));
		w = window.open("", "_blank");
		w.document.write(JSON.stringify(data));
		
	})
	.fail(function( data ){
		alert("Fail    " +JSON.stringify( data ));
	})
	.always(function( data ){
		
	});
}

function exitGame(){
	var buttonLaunch = $("#button_exit");

	// ask user if really want to exit
	var confirm = window.confirm('Do you realy want to exit the game?');
	if (confirm)
		close();
	// closes tab
	// tablet ??       ----------------------------------------------------
}



//$("input[type=button]").click( function( evt ) {
//var success = document.getElementById("success");
//var error = document.getElementById("error");
//$.ajax({
//url: "http://127.0.0.1/CityBuilder/ServerSide/fc.php",
//type: "POST",
//data:    {
//request: {
//functions: [ {
//path: “login/connect”, data: {username: “mehdi”, password: “pwd” }  } ]
//}
//}
//})
//.done( function( data ) {
//var response =  data.responseText ;
//success.value = data;
//error.value = "";
//})
//.fail( function ( data ) {
//var response =  JSON.parse(data.responseText);
//error.value = JSON.stringify( response.errorInfo );
//success.value = "";
//});
//});

