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
