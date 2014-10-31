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
			function(data){ mapLanguage($scope, data); },
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
		$scope.popup = popupFormat;
	}

	$scope.popupButton = function(answer){

		$scope.popup = false;
		switch (answer){
		case "ok":
			$scope.showGame();
			break;
		case "abbort":
			break;
		case "continue" :
			break;
		}
	}

	// set game mode
	$scope.setMode = function(mode) {

		var success = function(data) {
			$scope.changeView("mainMenu");
			$scope.$apply();

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

	$scope.hoverGame = function (name){
		switch(name){
		case "king" : 
			$scope.rightPicture = "management4";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_king"];
			break;
		case "priest":
			$scope.rightPicture = "management5";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_priests"];
			break;
		case "craftsmen":
			$scope.rightPicture = "management6";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_craftsmen"];
			break;
		case "scribes":
			$scope.rightPicture = "management7";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_scribes"];
			break;
		case "soldier":
			$scope.rightPicture = "management8";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_soldiers"];
			break;
		case "peasants":
			$scope.rightPicture = "management9";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_peasants"];
			break;
		case "slaves":
			$scope.rightPicture = "management10";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_slaves"];
			break;
		case "caravans":
			$scope.rightPicture = "management11";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_priests"];
			break;
		case "writing":
			$scope.rightPicture = "management_writing";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_writing"];
			break;
		case "granary":
			$scope.rightPicture = "management_granary";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_granary"];
			break;
		case "pottery":
			$scope.rightPicture = "management_pottery";
			$scope.rightText = $scope.dictionary[$scope.lang]["management_pottery"];
			break;
		}
	}

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
	$scope.showGame = function(){
		$scope.page = "gameStart";
		$scope.title="City Builder";

		// ___________________________________________________________________--
		choosenZone = "mountain";
		
		// set total number of population
		switch (choosenZone){
		case "fertile":
			$scope.numberGameTotalPop = 1200;
			break;
		case "desert":
			$scope.numberGameTotalPop = 800;
			break;
		case "mountain":
			$scope.numberGameTotalPop = 1000
			break;
		}
		

		// get title text of the database
		$scope.textGameWriting = $scope.dictionary[$scope.lang]["if_management_writing"];
		$scope.textGameGranary = $scope.dictionary[$scope.lang]["if_management_granary"];
		$scope.textGamePottery = $scope.dictionary[$scope.lang]["if_management_pottery"];
		$scope.textGameDescriptionCitizen = $scope.dictionary[$scope.lang]["if_management_assignCitizens"] + '  \u2193';
		$scope.textGameDescriptionTechnologie = $scope.dictionary[$scope.lang]["if_management_chooseTech"] + '  \u2192';
		$scope.textGameTotalPop = $scope.dictionary[$scope.lang]["if_management_popTotal"];
		$scope.textGameAvailablePop = $scope.dictionary[$scope.lang]["if_management_popAvailable"];
		$scope.textGameKing = $scope.dictionary[$scope.lang]["if_management_king"];
		$scope.textGamePriest = $scope.dictionary[$scope.lang]["if_management_priest"];	
		$scope.textGameCraft = $scope.dictionary[$scope.lang]["if_management_craftsmen"];
		$scope.textGameScribes = $scope.dictionary[$scope.lang]["if_management_scribes"];
		$scope.textGameSoldiers = $scope.dictionary[$scope.lang]["if_management_soldiers"];
		$scope.textGamePeasants = $scope.dictionary[$scope.lang]["if_management_peasants"];
		$scope.textGameSlaves = $scope.dictionary[$scope.lang]["if_management_slaves"];
		$scope.textGameCaravans = $scope.dictionary[$scope.lang]["if_management_caravans"];
		$scope.textGameFood = $scope.dictionary[$scope.lang]["if_management_food"];
		$scope.textGameWealth = $scope.dictionary[$scope.lang]["if_management_wealth"];
	}

	// show up a popup, after clickung on a button on the placement of the city
	$scope.launcheZoneGame = function(zone) {

		$scope.showPopup("yesNo");
		$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_placement_validation"];
		$scope.title="City Builder";
	};


	// game buttons -> technologie -> set as set
	// _____________________________________________________________________ problem
	$scope.clickTechnologie = function (technologie){
		switch (technologie) {
		case "writing":
			$scope.buttonInactiveW = true;
			
			break;
		case "granary":
			$scope.buttonInactiveG = true;
			break;
		case "pottery":
			$scope.buttonInactiveP = true;
			break;
		default:
			break;
		}
	}


});