var app = angular.module("app", []);
//var turn = 0;
//var choosenZone;

//main controller
app.controller("ViewController", function($scope) {

	// *****************************************
	//              variables
	// *****************************************

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

	$scope.nbrTurn = 0;
	$scope.choosenZone = "";
	$scope.popupName = "";
	
	// buildings
	$scope.palace = 0;
	$scope.monument = 0;
	$scope.temple = 0;
	$scope.rampart = 0;
	
	// technolgie
	$scope.techWriting = 0;
	$scope.techGranary = 0;
	$scope.techPottery = 0;
	
	$scope.gameTableValues = new Object();

	query( [{path: "dictionary/initialize", data: null }],
			function(data){ mapLanguage($scope, data); },
			function(data){ alert(JSON.stringify(data)); }
	);

	// *****************************************
	//            change the view 
	// *****************************************
	$scope.changeView = function(pageName) {
		// sets the view to the the given name
		$scope.page = pageName;

		// depending on the site
		// show different titles
		// and display the divRight (image, text, endOfTurn button, exit game button)
		switch(pageName) {
		case "showRules":
			$scope.title = $scope.dictionary[$scope.lang]['if_main_rules'];
			break;
		case "gameModes":
			$scope.title = $scope.dictionary[$scope.lang]['title_if_gamemodes'];
			break;
		case "map" :
			$scope.title = $scope.dictionary[$scope.lang]['title_if_placement'];
		case "gameStart":
			// display interface right
			$scope.pageRight = true;
			break;
		default: 
			// hide the divRight 
			$scope.pageRight = false;
		// no special title for the page
		$scope.title="City Builder";
		}
	};

	// ***************************************************************************************************
	//            display the popups with text and image 
	//***************************************************************************************************
	$scope.showPopup = function(name, zone) {

		// display a popup with
		//  --> continue  --> Popup with one button called 'continue' 
		//  --> yesNo     --> Popup with two buttons calles 'yes' and 'no'

		$scope.popupName = "";

		// type of popup
		// title
		// picture
		switch (name) {
		case 'zone':
			// safe the choosen zone in a variable
			$scope.choosenZone = zone;

			$scope.popup = 'yesNo';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_placement_validation"];
			$scope.popupPicture = "popup_cityValidation";
			$scope.popupName = zone;
			break;
//			case 'caravan':
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_caravan"]; 
//			$scope.popupPicture = "popup_caravan";
//			break;
//			case 'endOfTurn':
//			$scope.popup = 'yesNo';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_end_of_turn_validation"]; 
//			$scope.popupPicture = "popup_endOfTurn";
//			break;
//			case 'exitGameInGame':  
//			$scope.popup = 'yesNo';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_exit_during_game"]; // <<<<___________________ & text on buttons
//			$scope.popupPicture = "popup_ExitGameInGame";
//			break;
//			case 'exitGame': 
//			$scope.popup = 'yesNo';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_exit_validation"]; 
//			$scope.popupPicture = "popup_exitGame";
//			break;
//			case 'goodEnding': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_good_ending"]; 
//			$scope.popupPicture = "popup_goodEnding";
//			break;
		case 'granary': 
			$scope.popup = 'continue';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_granary"]; 
			$scope.popupPicture = "popup_granary";
			break;
//			case 'badEnding': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_bad_ending"]; 
//			$scope.popupPicture = "popup_badEnding";
//			break;
//			case 'invasion': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_invasion"]; 
//			$scope.popupPicture = "popup_invasion";
//			break;
//			case 'monument': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_monument"]; 
//			$scope.popupPicture = "popup_monument";
//			break;
//			case 'palace': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_palace"]; 
//			$scope.popupPicture = "popup_palace";
//			break;
		case 'pottery': 
			$scope.popup = 'continue';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_pottery"];
			$scope.popupPicture = "popup_pottery";
			break;			
//			case 'rampart': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_ramparts"]; 
//			$scope.popupPicture = "popup_rampart";
//			break;			
		case 'desert': 
			$scope.popup = 'continue';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_result_placement_desert"]; 
			$scope.popupPicture = "region2";
			$scope.popupName = "pyramid";
			break;			
		case 'fertile': 
			$scope.popup = 'continue';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_result_placement_fertile_lands"];
			$scope.popupPicture = "region1";
			$scope.popupName = "pyramid";
			break;
		case 'mountain': 
			$scope.popup = 'continue';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_result_placement_mountains"];
			$scope.popupPicture = "region3";
			$scope.popupName = "pyramid";
			break;
//			case 'temple': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_temple"]; 
//			$scope.popupPicture = "popup_temple";
//			break;
//			case 'unhappy': 
//			$scope.popup = 'continue';
//			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_unhappiness"];
//			$scope.popupPicture = "popup_unhappy";
//			break;
		case 'writing': 
			$scope.popup = 'continue';
			$scope.popupYesNo_Text = $scope.dictionary[$scope.lang]["popup_writing"]; 
			$scope.popupPicture = "popup_writing";
			break;
		default:
			break;
		}
	};


	// *****************************************
	//            Action of the popups
	// *****************************************
	$scope.popupButton = function(answer){  

		// hide the popup
		$scope.popup = false;

		switch (answer){
		case "ok":
			if ($scope.popupName != "")
				$scope.showPopup($scope.popupName, "");

			// change view to the game
			$scope.showGame();
			break;
		case "abbort":
			break;
		case "continue" :
			if($scope.popupName== "pyramid")
				updatePyramid();
			break;
		}
	};

	// ***************************************************************************
	//            Set the mode of the game (save into the database)
	// ***************************************************************************
	$scope.setMode = function(mode) {

		// if insert into the database was possible
		// ---> change the view back to the menu
		var success = function(data) {
			$scope.changeView("mainMenu");
			$scope.$apply();

		};

		// if it fails
		// open a new window to show the error 
		var fail = function(data) {
			w = window.open("", "_blank");
			w.document.write(JSON.stringify(data));
		};

		query([{path: "game/setMode", data: mode}], success, fail);
	};

	// ************************************************************************************
	//            display the map with buttons on the different zones
	// ************************************************************************************
	$scope.launchGame = function() {

		var success = function( data ) {
			// if the mode is '5 turns' or infinite 
			// the server returns 'goToMap'
			if(JSON.parse(data)[0] == "goToMap") {
				// display the map
				$scope.changeView("map");
				$scope.$apply();

				// draw on the map buttons 
				// --> the position of the buttons are dynamic in a specific zone
				var map = new Map();
				var coordsOne = map.getZoneOne();
				var coordsTwo = map.getZoneTwo();
				var coordsThree = map.getZoneThree();

				// place the buttons on the correct position
				// the position is randomly choosen in the file javaScripts/mapZone.js
				$scope.zoneOneStyle = {"margin-left": coordsOne[0] + "px", "top": coordsOne[1] + "px"};
				$scope.zoneTwoStyle = {"margin-left": coordsTwo[0] + "px", "top": coordsTwo[1] + "px"};
				$scope.zoneThreeStyle = {"margin-left": coordsThree[0] + "px", "top": coordsThree[1] + "px"};

				$scope.$apply();

				//initializeMap();
			}
			else
				alert($scope.dictionary[$scope.lang]["if_main_launch"]);
		};

		// if there was a problem in the frontcontroller
		// --> it shows the error in a sperated window
		var fail = function(data) {
			w = window.open("", "_blank");
			w.document.write(JSON.stringify(data));
		};

		query([{path: "game/launch", data: null}], success, fail);
	};

	// ************************************************************************************
	//            Display text and images by hovering over a zone
	// ************************************************************************************
	$scope.hoverZone = function(zoneNbr) {

		// sets the text and picture depending on the zone
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

	// ************************************************************************************
	//            Display text and images by hovering over a social class or technologie
	// ************************************************************************************
	$scope.hoverGame = function (name){

		// sets the text and picture depending on the social class
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
			$scope.rightText = $scope.dictionary[$scope.lang]["management_caravans"];
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

	// ************************************************************************************
	//            Exit game (on the map or in the game)
	// ************************************************************************************
	$scope.exitGame = function() {
		switch($scope.page) {
		case "map":
			// go back to menu
			$scope.changeView("mainMenu");
			break;
		case "game":
			// display score  //__________________________________________________________________________________________
			break;
		}
	};

	// ************************************************************************************
	//            Exit game (on the main menu)
	// ************************************************************************************
	// exit the game (main menu)
	$scope.exitGameMenu = function() {

		var success = function( data ) {
			// go back to the login screen
			$scope.changeView("login");
		};

		var fail = function( data ) {
			var w = window.open("", "_blank");
			w.document.write( JSON.stringify(data) );
		};

		// close the session
		query([{path: "login/disconnect", data: null}], success, fail);
	};


	// ************************************************************************************
	//            Display the game
	// ************************************************************************************
	$scope.showGame = function(){
		// set title and switch the page
		$scope.page = "gameStart";
		$scope.title="City Builder";

		// depending on the zone 
		// --> the population varies 
		// set total number of population
		switch ($scope.choosenZone){
		case "fertile":
			$scope.numberGameTotalPop = 2000;
			break;
		case "desert":
			$scope.numberGameTotalPop = 1500;
			break;
		case "mountain":
			$scope.numberGameTotalPop = 1200
			break;
		}

		// calculatinc of food and wealth
		// display the result on the corresponding field
		$scope.numberGameFood = $scope.numberGameTotalPop *0.02;
		$scope.numberGameWealth = 0;

		// get the text for title of the database 
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

	// ************************************************************************************
	//            Technologie buttons -> technologies to explore
	// ************************************************************************************
	// _______________________________________________________________________________ problem  --> set choosen, pro round 1 technologie
	$scope.clickTechnologie = function (technologie){

		switch (technologie) {
		case 'writing':
//			$scope.buttonInactiveW = true;
//			$.scope.enableButton = true;

			$scope.showPopup("writing", "") ; // <<---------------------------------- has to be displayed after end of turn
			break;
		case "granary":
//			$scope.buttonInactiveG = true;
			$scope.showPopup("granary", "");  // <<---------------------------------- has to be displayed after end of turn
			break;
		case "pottery":
//			$scope.buttonInactiveP = true;
			$scope.showPopup("pottery", "");   // <<---------------------------------- has to be displayed after end of turn
			break; 
		default:
			break;
		}
	}

	// ************************************************************************************
	//            Calculate new population, happiness, welth,... --> when turn ends
	// ************************************************************************************
	// click on end of turn 
	// calculation of new food ...
	$scope.endOfTurnCalculation = function (){

		// prepare array for the calculations
		           
		$scope.gameTableValues["Turn"] = $scope.nbrTurn;
		$scope.gameTableValues['nbrKings']  ;
		$scope.gameTableValues['nbrPriests'];
		$scope.gameTableValues['nbrScribes'];
		$scope.gameTableValues['nbrSoldiers'] ;
		$scope.gameTableValues['nbrSlaves'] ;
		$scope.gameTableValues['nbrPeasants'];
		$scope.gameTableValues['nbrCraftsmen'];
		$scope.gameTableValues['Population'] = 		$scope.numberGameTotalPop; 
		$scope.gameTableValues['Wealth'] = 			$scope.numberGameWealth; 
		$scope.gameTableValues['Food'] = 			$scope.numberGameFood; 
		$scope.gameTableValues['PotteryResearched'] = $scope.techPottery; 
		$scope.gameTableValues['GranaryResearched'] = $scope.techGranary; 
		$scope.gameTableValues['WritingResearched'] = $scope.techWriting; 
		$scope.gameTableValues['nbrCaravans'] ;
		$scope.gameTableValues['RampartBuilt'] = 	$scope.rampart;
		$scope.gameTableValues['TempleBuilt'] = 	$scope.temple;
		$scope.gameTableValues['PalaceBuilt'] = 	$scope.palace;
		$scope.gameTableValues['MonumentBuilt'] = 	$scope.monument;
		
		if (!isset($scope.gameTableValues['nbrCaravans']))
			$scope.gameTableValues['nbrCaravans'] = 0;
		
		for(key in $scope.gameTableValues) {
			 $scope.gameTableValues[key] = 1;
		}
		
		if ($scope.nbrTurn < 5){
			
			query( [{"path": "game/endOfTurn", "data": $scope.gameTableValues } ],
					function(data){ var w = window.open("", "_blank"); w.document.write(JSON.stringify(data)); },
					function(data){ alert(JSON.stringify(data)); }
			);

			$scope.nbrTurn ++;
		}
	}

	// ************************************************************************************
	//            Display the score
	// ************************************************************************************
	$scope.displayTheScore = function (){

		// set title, change the view to DivScore.php
		$scope.page = "score";
		$scope.title =  $scope.dictionary[$scope.lang]["if_management_score"]; 

		// set titles of the table columns
		$scope.scoreTechnologyTxt =  $scope.dictionary[$scope.lang]["score_technology"]; 
		$scope.scoreWealthTxt =  $scope.dictionary[$scope.lang]["if_management_wealth"]; 
		$scope.scoreBuildingsTxt =  $scope.dictionary[$scope.lang]["score_buildings"]; 
		$scope.scorePopulationTxt =  $scope.dictionary[$scope.lang]["score_population"]; 
		$scope.scoreHappinessTxt =  $scope.dictionary[$scope.lang]["score_happiness"]; 
		$scope.scoreTotalTxt =  $scope.dictionary[$scope.lang]["score_scoreTotal"]; 


		$scope.scoreTxt =  $scope.dictionary[$scope.lang]["if_management_score"]; 


		query( [{path: "turn/scoreValues", data: null }],
				// success
				function(data){ 

						data = JSON.parse(data);
						$.each(data[0].data, function(index, row) {
						$scope.scoreValues[row.Key] = row.Text;
						});

			$scope.$apply();
		},
		// error
		function(data){ alert(JSON.stringify(data)); }
		);


		// set numbers
		$scope.scoreTechnology = 0; // <<------ number
		$scope.scoreWealth = 0; // <<------ number
		$scope.scoreBuildings = 0; // <<------ number
		$scope.scorePopulation = 0; // <<------ number
		$scope.scoreHappyness = 0; // <<------ number
		$scope.scoreTotal = 0; // <<------ number


	}

});
