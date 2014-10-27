function mapLanguage($scope, dataStr ) {
	data = JSON.parse(dataStr);

	$.each(data[0].data, function(index, row) {

		if(typeof $scope.dictionary[row.Language] !== "object") {
			$scope.dictionary[row.Language] = [];
			$scope.lang = row.Language;
		}

		$scope.dictionary[row.Language][row.Key] = row.Text;
	});

	$scope.$apply();
};
