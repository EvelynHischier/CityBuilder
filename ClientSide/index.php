

<!-- Responsive Design:  http://getbootstrap.com/2.3.2/scaffolding.html -->
<!-- IPad simulation: http://www.yourhelpcenter.com/ipad-browser-simulation/ -->
<!-- my Git test comment -->


<html>
<head>
<title>Serious game</title>

<!-- Responsive Design -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="grafic/style.css">

<script type="text/javascript"
	src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<!--  Import all scripts  -->

<script
	src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"
	type="text/javascript"></script>
<script type="text/javascript">
		var app = angular.module("app", []);

		var query = function(functions, callBackDone, callBackFail, callBackAlways) {
			$.ajax({
				url: "http://127.0.0.1/CityBuilder-ServerSide/fc.php",
				type: "POST",
				data:    {
					request: {
						"functions": functions 
					}
				}
			})
			.done(function( data ){
				callBackDone(data);
			})
			.fail(function( data ){
				if(typeof callBackFail !== "undefined")
					callBackFail(data);
			})
			.always(function( data ){
				if(typeof callBackAlways !== "undefined")
					callBackAlways(data);
			});
		}

		// main controller
		app.controller("ViewController", function($scope) {
			// variables to be changed to control the views
			$scope.page = "mainMenu";
			$scope.title="City Builder";
			$scope.pageRight = false;

			// update it with database
			$scope.admin = true;

			// prepare a table for language
			$scope.lang= "fr";
			$scope.dictionnary = [];
			$scope.dictionnary["en"] = [];
			$scope.dictionnary["en"]["mainMenuTitle"] = "City Builder";
			$scope.dictionnary["en"]["mainMenuLaunchButton"] = "Launch game";
			$scope.dictionnary["en"]["mainMenuRulesButton"] = "Rules";
			$scope.dictionnary["en"]["mainMenuGameModesButton"] = "Game modes";
			$scope.dictionnary["en"]["mainMenuExitButton"] = "Exit game";
			
			$scope.dictionnary["en"]["gameModesTitle"] = "Game mode";
			$scope.dictionnary["en"]["gameModesBlock"] = "Block game";
			$scope.dictionnary["en"]["gameModesPlacement"] = "Placement only";
			$scope.dictionnary["en"]["gameModes5turns"] = "5 turns mode";
			$scope.dictionnary["en"]["gameModesInfinite"] = "Infinite turns mode";

			$scope.dictionnary["en"]["rulesTitle"] = "Rules";
			$scope.dictionnary["en"]["rulesDescription"] = "Rules";

			$scope.dictionnary["fr"] = [];
			$scope.dictionnary["fr"]["mainMenuTitle"] = "City Builder";
			$scope.dictionnary["fr"]["mainMenuLaunchButton"] = "Lancer le jeu";
			$scope.dictionnary["fr"]["mainMenuRulesButton"] = "Règles";
			$scope.dictionnary["fr"]["mainMenuGameModesButton"] = "Modes de jeu";
			$scope.dictionnary["fr"]["mainMenuExitButton"] = "Sortir";
			
			$scope.dictionnary["fr"]["gameModesTitle"] = "Mode de jeu";
			$scope.dictionnary["fr"]["gameModesBlock"] = "Bloquer le jeu";
			$scope.dictionnary["fr"]["gameModesPlacement"] = "Seulement le placement";
			$scope.dictionnary["fr"]["gameModes5turns"] = "5 tours";
			$scope.dictionnary["fr"]["gameModesInfinite"] = "Tours infinis";

			$scope.dictionnary["fr"]["rulesTitle"] = "Rules";
			$scope.dictionnary["fr"]["rulesDescription"] = "Rules";

			// change the view
			$scope.changeView = function(pageName) {
				$scope.page = pageName;
				$scope.title = $scope.dictionnary[$scope.lang][pageName+"Title"];
				
				switch(pageName) {
				case "gameStart":
					 $scope.pageRight = true;
					 break;
				default: $scope.pageRight = false;
				}
			};

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
		});
	</script>

</head>

<body data-ng-app="app" data-ng-controller="ViewController">

	<div id="content">

		<div id="title">
			<h1 id="titleTag" data-ng-bind="title"></h1>
		</div>

		<!-- ---------------     Main Div   ---------------    -->
		<div id="mainDiv">
			
			
			<?php
			include_once 'view/DivMenu.php';
			
			include_once 'view/DivMap.php';

			include_once 'view/DivGame.php';
			
			include_once 'view/DivRules.php'; // --> scrollbar for ipad
			
			include_once 'view/DivGameModes.php';
			
			include_once 'view/DivScore.php';
			?>
			
		</div>


		<!-- ---------------     Div on the right  - text / image / ingame buttons   ---------------    -->
		<div id="divHoverRight">
		<?php
		// include interface on the right
		include_once 'view/DivRight.php';
		include_once 'view/DivRulesButton.php';
		?>
		
		</div>
	</div>
	<script src="javaScripts/GlobalScript.js" type="text/javascript"></script>
	<script src="javaScripts/DivRightActions.js" type="text/javascript"></script>
	<script src="javaScripts/ViewController.js" type="text/javascript"></script>
	<script src="javaScripts/GameModeButtons.js" type="text/javascript"></script>
	<script src="javaScripts/MainMenuButtons.js" type="text/javascript"></script>
	<script src="javaScripts/mapZones.js" type="text/javascript"></script>


</body>
</html>
