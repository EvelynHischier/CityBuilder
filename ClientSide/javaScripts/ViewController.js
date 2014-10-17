// default
var pageToShow = "mainMenu";
display();

//does not change at runtime !!!!!!!!!!!!!!!!!!!!!!!!!!!!

/*
 * DivGame:  gameStart
 * DivMap:   showMap
 * DivMenu:  mainMenu
 * DivRight: showHoverDiv
 * DivRules: showRules
 * DivGameModes: DivGameModes   // problem -> not displayed
 */

function ViewControllerDisplayGame(){
	pageToShow = "gameStart";
	
	displayDisplayDivRight();
	
	displayAndReloadPage();
}

function displayMap(){
	pageToShow = "showMap";
	
	displayDisplayDivRight();
	
	displayAndReloadPage();
}

function ViewControllerDisplayRules(){
	alert("View controller : display Rules ");
	
	pageToShow = "showRules";
	
	displayAndReloadPage();
}

function displayGameModes(){
	pageToShow = "DivGameModes";
	
	hideDisplayDivRight();
	displayAndReloadPage();
}

function displayMainMenu(){
	pageToShow = "mainMenu";
	
	hideDisplayDivRight();
	displayAndReloadPage();
}

function hideDisplayDivRight(){
	
	$('#viewRight').hide();
	displayAndReloadPage();
}

function displayDisplayDivRight(){
	$('#viewRight').show();
	displayAndReloadPage();
}

function display(){
	
	app.controller("ViewController", function($scope) {
		$scope.page = pageToShow;
	});

}

function displayAndReloadPage(){
	display();
}


// change title
function changeTitle(name){
	app.controller("Page", function($name) {
		var title = 'CityBuilder';
		   return {
		     title: function() { return title; },
		     setTitle: function(name) { title = name }
		   };
	});
}


