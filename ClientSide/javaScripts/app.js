var app = angular.module("app", []);

		// main controller
		app.controller("ViewController", function($scope) {
			// variables to be changed to control the views
			$scope.page = "mainMenu";
			$scope.title="City Builder";
			$scope.pageRight = false;
			//$scope.popup = "yesNo";

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