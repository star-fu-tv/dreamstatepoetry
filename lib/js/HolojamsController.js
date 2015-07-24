(function() {

	var holojamsTV = angular.module('HolojamsTV', []);
	var holojams = [];
	// var gems = 'http://holojams.tv/~/';
	// var bang = 'http://holojams.tv/!/';
	var gems = 'http://localhost:8000/holojams/~/';
	var bang = 'http://localhost:8000/holojams/!/';	

	// HOLOJAM OBJECT //
	function Holojam(url,title,haiku,thumbnail) {
	    this.url = function() { return gems + url; };
	    this.title = title;
	    this.haiku = haiku;
	    this.thumbnail = function() { return bang + thumbnail; };
	}

	// HOLOJAMS //
	var TV = new Holojam('TV','I : heart : holojams.TV',
		'tv screens, scanlines, electric/current in vibes we ride.',
		'TV.png');
	var marble = new Holojam('marble-level','I : heart : holojams.TV',
		'ecstasy my rock. personality pressure, layers of marble. ',
		'marble-level.png');

	holojamsTV.controller('HolojamsController', function ($scope) {
	  $scope.holojams = 
	  	[ {'url' : gems + 'TV',
	  	  'title' : 'I : heart : holojams.TV',
	  	  'haiku' : 'tv screens, scanlines. electric/current. its the vibe to ride.',
	  	  'thumbnail' : bang + 'TV' + '.png'},
		  
		  {'url' : gems + 'marble-level',
	  	  'title' : 'I : heart : holojams.TV',
	  	  'haiku' : 'ecstasy my rock. personality pressure, layers of marble. ',
	  	  'thumbnail' : bang + 'marble-level' + '.png' },  	  
	  	  ]
	});

// 	// Create new HOLOJAM object
// $('.carousel').carousel({
//   interval: 1000
// })	

/***** GALLERY *****/
angular.module('galleryApp',[]).
    factory('DataSource', ['$http',function($http){
       return {
           get: function(fileName,callback){
                $http.get(fileName).
                success(function(data, status) {
                    callback(data);
                });
           }
       };
    }]);

var GalleryController = function($scope,DataSource) {
    var IMAGE_WIDTH = 405;
    $scope.IMAGE_LOCATION = "http://localhost:8000/holojams/!/";
    
    // Retrieve and set data 
    DataSource.get("images.json",function(data) {
        $scope.galleryData = data;
        $scope.selected = data[0];
    });
    
    // Scroll to appropriate position based on image index and width
    $scope.scrollTo = function(image,ind) {
        $scope.listposition = {left:(IMAGE_WIDTH * ind * -1) + "px"};
        $scope.selected = image;
    };
};

})();