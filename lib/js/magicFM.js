angular.module('HolojamsTV', [])
    .controller('HolojamsTransmitter', function ($scope, $http) {
    	
    	$http.get('/skeleton/~/holojams.json').success(function(data) {
    		$scope.holojams = data;
    		console.log($scope.holojams);
    	})

    	$scope.orderScene = 'date';
     
    })