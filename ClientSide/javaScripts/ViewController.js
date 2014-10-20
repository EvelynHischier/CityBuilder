//default
var pageToShow = "";
var showDivRight = true;

displayMainMenu();
//displayMap();
//displayScore();
//ViewControllerDisplayRules();
//ViewControllerDisplayGame();

//does not change at runtime !!!!!!!!!!!!!!!!!!!!!!!!!!!!

/*
 * DivGame:  gameStart
 * DivMap:   showMap
 * DivMenu:  mainMenu
 * DivRight: showHoverDiv
 * DivRules: showRules
 * DivScore: score
 * DivGameModes: DivGameModes   // problem -> not displayed
 */

function displayScore(){
	pageToShow = "score";
	
	setTitle("Score");
	showDivRight = false;
	displayAndReloadPage();
}

function ViewControllerDisplayGame(){
	pageToShow = "gameStart";

	setTitle("Management of the city");
	showDivRight = true;
	displayAndReloadPage();
	
}

function displayMap(){
	pageToShow = "showMap";

	showDivRight = true;
	displayAndReloadPage();
	setTitle("Placement of the city");
}

function ViewControllerDisplayRules(){
	alert("View controller : display Rules ");

	pageToShow = "showRules";
	showDivRight = false;
	displayAndReloadPage();
	setTitle("Rules");
}

function displayGameModes(){
	pageToShow = "DivGameModes";

	showDivRight = false;
	displayAndReloadPage();
	setTitle("Game modes");
}

function displayMainMenu(){
	pageToShow = "mainMenu";

	showDivRight = false;
	displayAndReloadPage();
	setTitle("City builder");
}

//function hideDisplayDivRight(){
//	$('#viewRight').hide();
//}
//
//function displayDivRight(){
//	$('#viewRight').show();
//}

function display(){
	if (showDivRight)
		displayDivRight();
	else 
		hideDisplayDivRight();
	
	
	app.controller("ViewController", function($scope) {
		$scope.page = "mainMenu";
		$scope.pageRight = false;
		
		$scope.changeView = function(name) {
			$scope.page = name;
			
			switch(name) {
			case "showRules": 
			case "gameStart":
				 $scope.pageRight = true;
				 break;
			default: $scope.pageRight = false;
			}
		};
	});

}

function displayAndReloadPage(){
	display();
	

}



