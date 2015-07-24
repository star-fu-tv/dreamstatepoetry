var dreamstateApp = angular.module('DreamStateGenerator', [ 'ngRoute', 'ngResource' ]);


dreamstateApp.controller('SongsCtrl', function($scope, $http) {

    // -* Load all song titles as JSON *- //
    $scope.getSongs = function() {
        $http.get("lib/php/get-songs.php").success(
            function(data){
                $scope.songs = data;
            });
    }

    $scope.getSongs();

    // /* Add a song to the database */
    // function addSong() {

    // }

    /* View song */
})




dreamstateApp.controller('SongMainController', function($scope, $http, $location, $routeParams) {
    $scope.song_id   = $routeParams.song_id;
    
    // -* Load all song titles as JSON *- //
    $scope.getSongData = function() {
        $http.post( "lib/php/get-song-impressions.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.impressions = data;
                //console.log(data);
        });
        $http.post( "lib/php/get-song-title.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.song = data;
               // console.log($scope.song);
        });        
    }

    $scope.getSongData();    
});




dreamstateApp.controller('SongGeneralController', function($scope, $http, $location, $routeParams) {
    $scope.song_id   = $routeParams.song_id;
    
    // -* Load all song titles as JSON *- //
    $scope.getSongData = function() {
        $http.post( "lib/php/get-song-impressions.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.impressions = data;
                //console.log(data);
        });
        $http.post( "lib/php/get-song-title.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.song = data;
                //console.log($scope.song);
        });        
    }

    $scope.getSongData();    
});


dreamstateApp.controller('SongContentController', function($scope, $http, $location, $routeParams) {
    $scope.song_id   = $routeParams.song_id;
    
    // -* Load all song titles as JSON *- //
    $scope.getSongData = function() {
        $http.post( "lib/php/get-song-impressions.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.impressions = data;
                //console.log(data);
        });
        $http.post( "lib/php/get-song-title.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.song = data;
                //console.log($scope.song);
        });        
    }

    $scope.getSongData();    
});



dreamstateApp.controller('SongFragmentsController', function($scope, $http, $location, $routeParams) {
    $scope.song_id   = $routeParams.song_id;
    
    // -* Load all song titles as JSON *- //
    $scope.getSongData = function() {
        $http.post( "lib/php/get-song-impressions.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.impressions = data;
                //console.log(data);
        });
        $http.post( "lib/php/get-song-title.php", JSON.stringify({"song_id": $scope.song_id}) )
        .success(function(data){
                $scope.song = data;
                //console.log($scope.song);
        });        
    }

    $scope.getSongData(); 

    // -* Load all descriptor values *- //
    $scope.getDescriptors = function() {
        $http.get( "lib/php/get-descriptors.php")
        .success(function(data){
                $scope.descriptors_list = data;//angular.fromJson(data);
                //console.log("line 117 app/js");
                console.info($scope.descriptors_list);
        });     

       // $scope.content_descriptor_ids = ["1","2","3","4","5","6"];
    }

    $scope.getDescriptors();  

    // -* Insert new Impression - [song_id, fragmn] *- //
    $scope.addSongImpressions = function() {
        $http.post( "lib/php/add-song-impression.php", 
                    JSON.stringify({"song_id": $scope.song_id,
                                    "fragment_id": $scope.input_fragment_id,
                                    "descriptor_id": $scope._input_descriptor_id}) )
        .success(function(data){
                $scope.descriptors_list = data;//angular.fromJson(data);
                //console.log("line 117 app/js");
                console.info($scope.descriptors_list);
        });     

       // $scope.content_descriptor_ids = ["1","2","3","4","5","6"];
    }
    
    $scope.addSongImpressions();         


//     jQuery( document ).ready(function( $ ) {
//   // Code using $ as usual goes here.
// //        $('.new-fragment').css('display','none');
//       //  console.log('hello from jQuery');
//     });
    





});


/* ~ : ~ GET SONG DATA  ~ : ~ */
// use a service , factories
// call 'get song data in each controller. so they are all talking about the same song?'

/* ~ : ~ ROUTE CONFIGURATION ~ : ~ */
dreamstateApp.config( function ($routeProvider, $locationProvider) {
    $routeProvider.
        /* */
        when('/', {                         
            templateUrl : 'parts/view-songs.html',
            controller  : 'SongsCtrl'
        }). 
        // when('/on', {
        //     templateUrl : 'bones/holojam-single.html',
        //     controller  : 'RecentHolojamController'
        // }).                               
        when('/song/:song_id', {
            templateUrl : 'parts/view-song.html',
            controller  : 'SongMainController'
        }). 
        when('/song/:song_id/general', {
            templateUrl : 'parts/view-song-general.html'
            //controller  : 'SongGeneralController'
        }).
        when('/song/:song_id/fragments', {
            templateUrl : 'parts/view-song-fragments.html'
           // controller  : 'SongFragmentsController'
        }).        
        when('/song/:song_id/content', {
            templateUrl : 'parts/view-song-content.html'
            //controller  : 'SongContentController'
        }) 
        // otherwise({
        //     redirectTo: '/on'
        // });
        
       $locationProvider.html5Mode(false);        
});
