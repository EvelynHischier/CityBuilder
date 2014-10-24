

<!-- Responsive Design:  http://getbootstrap.com/2.3.2/scaffolding.html -->
<!-- IPad simulation: http://www.yourhelpcenter.com/ipad-browser-simulation/ -->
<!-- my Git test comment -->


<html>
<head>
<title>Serious game</title>


<link rel="stylesheet" type="text/css" href="grafic/style.css">

<script type="text/javascript"
	src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<!--  Import all scripts  -->

<script
	src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js"
	type="text/javascript"></script>
<script src="javaScripts/GlobalScript.js" type="text/javascript"></script>
<script src="javaScripts/DivRightActions.js" type="text/javascript"></script>
<script src="javaScripts/ViewController.js" type="text/javascript"></script>
<script src="javaScripts/GameModeButtons.js" type="text/javascript"></script>
<script src="javaScripts/MainMenuButtons.js" type="text/javascript"></script>
<script src="javaScripts/mapZone.js" type="text/javascript"></script>

<script type="text/javascript">
		var app = angular.module("app", []);
		var urlMehdi = "http://127.0.0.1/CityBuilder-ServerSide/fc.php";
		var urlEvi = "http://127.0.0.1:8080/Git/CityBuilder/ServerSide/fc.php";
		var url = "http://groupe1.informatiquegestion.ch/Old/CityBuilder/ServerSide/fc.php"; // check ? 
			
		var query = function(functions, callBackDone, callBackFail, callBackAlways) {
			$.ajax({
				url: urlEvi,
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
		};

		function mapLanguage($scope, dataStr ) {
			data = JSON.parse(dataStr);
			
			$.each(data[0].data, function(index, row) {
				
				if(typeof $scope.dictionary[row.language] !== "object") {
					$scope.dictionary[row.language] = [];
					$scope.lang = row.language;
				}
				
				$scope.dictionary[row.language][row.key] = row.text;
			});

			$scope.$apply();
		};

		// main controller
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

			$scope.launchGame = function() {
				
				var success = function( data ) {
					if(JSON.parse(data)[0] == "goToMap") {
						$scope.changeView("map");
						$scope.$apply();
						initializeMap();
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
			
			include_once 'view/DivRules.php';
			
			include_once 'view/DivGameModes.php';
			
			include_once 'view/DivScore.php';
			
			include_once 'view/DivLogin.php';
			
			include_once 'view/DivRegister.php';
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


</body>
</html>
