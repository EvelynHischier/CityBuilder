var app = angular.module("app", []);

//main controller
app.controller("ViewController", function($scope) {
	// variables to be changed to control the views
	$scope.page = "mainMenu";
	$scope.title="City Builder";
	$scope.pageRight = false;

	// update it with database
	$scope.admin = true;
	$scope.gameMode = "5turns";

	// prepare a table for language
	$scope.lang= "fr";
	$scope.dictionary = [];

	$scope.zoneOneStyle = "";

	query( [{path: "dictionary/initialize", data: null }],
			function(data){ var w = window.open("", "_blank"); w.document.write(JSON.stringify(data)); mapLanguage($scope, data); },
			function(data){ alert(JSON.stringify(data)); }
	);
	// change the view
	$scope.changeView = function(pageName) {
		$scope.page = pageName;
		$scope.title = $scope.dictionary[$scope.lang][pageName+"Title"];

		switch(pageName) {
		// display title
		case "showRules":
			$scope.title = $scope.dictionary[$scope.lang]['if_main_rules'];
			break;
		case "gameModes":
			$scope.title = $scope.dictionary[$scope.lang]['title_if_gamemodes'];
			break;

			// display interface right
		case "map" :
			$scope.title = $scope.dictionary[$scope.lang]['title_if_placement'];
		case "gameStart":
			$scope.pageRight = true;
			break;
		default: $scope.pageRight = false;
		$scope.title="City Builder";
		}
	};

	// show popup
	$scope.showPopup = function(popupFormat) {


		switch(popupFormat){
		case "continue":
			$scope.popup="continue";

			break;
		case "yesNo":
			$scope.popup="yesNo";
			break;
		default:

		}
	}

	// set game mode
	$scope.setMode = function(mode) {
		
		var success = function(data) {
			$scope.changeView("mainMenu");
			$scope.$apply();
			
			alert(JSON.stringify(data));
		};

		var fail = function(data) {
			w = window.open("", "_blank");
			w.document.write(JSON.stringify(data));
		};

		query([{path: "game/setMode", data: mode}], success, fail);
	};

	// display zones
	$scope.launchGame = function() {

		var success = function( data ) {
			if(JSON.parse(data)[0] == "goToMap") {
				$scope.changeView("map");
				$scope.$apply();

				var map = new Map();
				var coordsOne = map.getZoneOne();
				var coordsTwo = map.getZoneTwo();
				var coordsThree = map.getZoneThree();

				$scope.zoneOneStyle = {"margin-left": coordsOne[0] + "px", "top": coordsOne[1] + "px"};
				$scope.zoneTwoStyle = {"margin-left": coordsTwo[0] + "px", "top": coordsTwo[1] + "px"};
				$scope.zoneThreeStyle = {"margin-left": coordsThree[0] + "px", "top": coordsThree[1] + "px"};

				$scope.$apply();

				//initializeMap();
			}
			else
				alert($scope.dictionary[$scope.lang]["if_main_launch"]);
		};

		var fail = function(data) {
			w = window.open("", "_blank");
			w.document.write(JSON.stringify(data));
		};

		query([{path: "game/launch", data: null}], success, fail);
	};

	// mouse over a zone
	$scope.hoverZone = function(zoneNbr) {
		switch(zoneNbr) {
		case "fertile":
			$scope.rightPicture = "region1";
			$scope.rightText = $scope.dictionary[$scope.lang]["placement_fertile_lands"];
			break;
		case "mountain":
			$scope.rightPicture = "region2";
			$scope.rightText = $scope.dictionary[$scope.lang]["placement_desert"];
			break;
		case "desert":
			$scope.rightPicture = "region3";
			$scope.rightText = $scope.dictionary[$scope.lang]["placement_mountains"];
			break;
		}
	};

	// exit the game (map and in-game)
	$scope.exitGame = function() {
		switch($scope.page) {
		case "map":
			$scope.changeView("mainMenu");
			break;
		}
	};

	// exit the game (main menu)
	$scope.exitGameMenu = function() {
		var success = function( data ) {
			$scope.changeView("login");
		};

		var fail = function( data ) {
			var w = window.open("", "_blank");
			w.document.write( JSON.stringify(data) );
		};

		query([{path: "login/disconnect", data: null}], success, fail);
	};


	// switch to the game page
	$scope.startGameZone = function() {

		var success = function( data ) {
			if(JSON.parse(data)[0] == "goToGame") {
				$scope.changeView("gameStart");
				$scope.$apply();

				// set max population

				$scope.$apply();

			}
			else
				alert($scope.dictionary[$scope.lang]["if_main_launch"]);
		};

		var fail = function(data) {
			w = window.open("", "_blank");
			w.document.write(JSON.stringify(data));
		};

		query([{path: "game/launch", data: null}], success, fail);
	};

	// show up a popup, after clickung on a button on the placement of the city
	$scope.launcheZoneGame = function(zone) {

		$scope.showPopup("yesNo");
		$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_placement_validation"];
		//$scope.
		
//		var success = function( data ) {
//		if(JSON.parse(data)[0] == "goToGame") {
//		$scope.changeView("yesNo");
//		$scope.$apply();

//		// set max population

//		$scope.$apply();

//		}
//		else
//		alert($scope.dictionary[$scope.lang]["if_main_launch"]);
//		};

//		var fail = function(data) {
//		w = window.open("", "_blank");
//		w.document.write(JSON.stringify(data));
//		};

//		query([{path: "game/launch", data: null}], success, fail);
	};


});