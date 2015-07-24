var dreamstateApp = angular.module('DreamStateGenerator', [ 'ngRoute', 'ngResource' ]);

// /* ~ : ~ ROUTE CONFIGURATION ~ : ~ */
// dreamstateApp.config( function ($routeProvider, $locationProvider) {
//     $routeProvider.
//         /* */
//         when('/channels', {                         
//             templateUrl : 'bones/nav-overlay.html',
//             controller  : 'NavController'
//         }). 
//         when('/on', {
//             templateUrl : 'bones/holojam-single.html',
//             controller  : 'RecentHolojamController'
//         }).                               
//         when('/:holojamURL', {
//             templateUrl : 'bones/holojam-single.html',
//             controller  : 'HolojamSingle'
//         }).        
//         otherwise({
//             redirectTo: '/on'
//         });
        
//        $locationProvider.html5Mode(false);        
// });

/* ~ : ~ SPINNERS ~ : ~ */
var xt_showSpinner = function() {
    document.getElementById('underpaper').style.opacity = 1;
    document.getElementById('underpaper').style.zIndex = '2900';       
    document.getElementById('atom-loading-spinner').style.opacity = 1;
    document.getElementById('atom-loading-spinner').style.zIndex = '3000';
}

var xt_hideSpinner = function() {
    document.getElementById('underpaper').style.opacity = 0;
    document.getElementById('underpaper').style.zIndex = '-30';  
    document.getElementById('atom-loading-spinner').style.zIndex = '-20';
    document.getElementById('atom-loading-spinner').style.opacity = 0;    
}


holojamsApp.controller('NavController', function ( $scope ) {
    
    var current_view = 'menu';
    //console.log('nav controller' + $scope.current_view);
    xt_hideSpinner();
    

    $scope.changeView = function(new_view) {
        
        $scope.current_view = new_view;
        console.log($scope.current_view);

        if(new_view == 'info') {
            $('#nav-popup-box').hide();
            $('#nav-info-box').show();   
            setTimeout(function() {
                $('#nav-popup-box').show();
                $('#nav-info-box').hide();  
            }, 2000);         
        }
    }    
});

/* Displays an individual holojam */
holojamsApp.controller('HolojamSingle', function ( $scope, $routeParams, $location, $http ) {

    var showSpinner = function() {
        //console.log('show me a fucking spinner');
       // document.getElementById('atom-loading-spinner').style.display = 'block';
        document.getElementById('underpaper').style.opacity = '1';
        document.getElementById('underpaper').style.zIndex = '12900';       
        document.getElementById('atom-loading-spinner').style.opacity = '1';
        document.getElementById('atom-loading-spinner').style.zIndex = '13000';
      //  location.reload();
    }

    var hideSpinner = function() {
        console.log('hide spinner');
        document.getElementById('underpaper').style.opacity = 0;
        document.getElementById('underpaper').style.zIndex = '-30';  
        document.getElementById('atom-loading-spinner').style.zIndex = '-20';
        document.getElementById('atom-loading-spinner').style.opacity = 0;    
    }     

    var showNav = function() {
        document.getElementById('nav-overlay').style.opacity = 1;
        document.getElementById('nav-overlay').style.zIndex = '31430';              
    }

    var hideNav = function() {
        document.getElementById('nav-overlay').style.opacity = 0;
        document.getElementById('nav-overlay').style.zIndex = '30';              
    } 

    showSpinner();

    // Build an angular JS service to spit out holojams pls
    /* Retrieves JSON list of HOLOJAMS */
    $http.get('~/holodex.json').success(function(data) {
        $scope.holojams     = data;                     // Get Holojams from JSON list
        $scope.holojamURL   = $routeParams.holojamURL;  // Get Holojam from url

        for(i = 0; i < $scope.holojams.length; i++) {
            if($scope.holojams[i].slug == $scope.holojamURL) {
                $scope.holojam      = $scope.holojams[i];
                $scope.next_holojam = $scope.holojams[(i+1) % $scope.holojams.length];
                $scope.prev_holojam = $scope.holojams[(i-1) % $scope.holojams.length];
            }
        }

        // ~ set startup function ~ //
        $scope.loadCanvas = function() {
            
            if($scope.holojam.type == 'p5') {
                // ~ P5 init ~ //
                var script = document.getElementById($scope.holojam.slug+"_script"); // get p5/js code
                var hook   = document.getElementById($scope.holojam.slug+"_hook");  // find canvas hook
                // ~ create canvas ~ //
                // TODO : check if canvas/p5 instance already exists //
                var canvas = document.createElement("canvas");
                canvas.id  = $scope.holojam.slug+"_canvas" ;
                var c      = angular.element(canvas);
                var h      = angular.element(hook);
                h.append(c); // add canvas to screen
                // ~ new p5 instance ~ //
                var p      = new Processing(canvas, script.text);
                p.externals.sketch.options.isTransparent = true;
                document.getElementById('single-holojam').style.opacity = '1';
            } else if($scope.holojam.type == '3') {
                // ~ 3 init ~ //
                document.getElementById('single-holojam').style.opacity = '1';
            }            
            hideSpinner();
        }

        // ~ redirect to next holojam ~ //
        $scope.nextHolojam = function() {
              document.getElementById('single-holojam').style.opacity = '0';
            showSpinner();
            $location.path( $scope.next_holojam.slug);
           //window.location.href = "#/"+$scope.next_holojam.slug; 
           window.location.reload();  

        }  

        // ~ redirect to next holojam ~ //
        $scope.prevHolojam = function() {
              document.getElementById('single-holojam').style.opacity = '0';
            showSpinner();
            $location.path( $scope.prev_holojam.slug);
           //window.location.href = "#/"+$scope.next_holojam.slug; 
           window.location.reload();  

        }  

        $scope.showNav = function() {
            document.getElementById('nav-overlay').style.opacity = 1;
            document.getElementById('nav-overlay').style.zIndex = '31430';
            setTimeout(function() {
                document.getElementById('nav-overlay').style.opacity = 0;
                document.getElementById('nav-overlay').style.zIndex = '-30';  
            }, 2000)              
        }

        $scope.hideNav = function() {
            document.getElementById('nav-overlay').style.opacity = 0;
            document.getElementById('nav-overlay').style.zIndex = '30';              
        } 
    });   

 });

/* Displays an individual holojam */
holojamsApp.controller('RecentHolojamController', function ( $scope, $location, $http ) {
        
    // Build an angular JS service to spit out holojams pls
    /* Retrieves JSON list of HOLOJAMS */
    $http.get('~/holodex.json').success(function(data) {
        $scope.holojams     = data;                     // Get Holojams from JSON list
        //$scope.holojamURL   = $routeParams.holojamURL;  // Get Holojam from url

        var recent = $scope.holojams.length;

        $scope.holojam = $scope.holojams[recent - 1];
        console.log(recent);
  //      $scope.next_holojam = $scope.holojams[(recent+1) % $scope.holojams.length];

        // ~ redirect to most recent holojam ~ //
        $location.path( $scope.holojam.slug);
           
    });    
 });

/* Displays an individual holojam */
holojamsApp.controller('RandomHolojamController', function ( $scope, $location, $http ) {
        
    console.log('HolojamSingleRandom init');
    // Build an angular JS service to spit out holojams pls
    /* Retrieves JSON list of HOLOJAMS */
    $http.get('~/holodex.json').success(function(data) {
        $scope.holojams     = data;                     // Get Holojams from JSON list
        //$scope.holojamURL   = $routeParams.holojamURL;  // Get Holojam from url

        var randNum = Math.floor((Math.random() * $scope.holojams.length) + 1);

        $scope.holojam = $scope.holojams[randNum];
        $scope.next_holojam = $scope.holojams[(randNum+1) % $scope.holojams.length];

        console.log($scope.holojam);

        // ~ redirect to most recent holojam ~ //
        $location.path( $scope.holojam.slug);

           
    });    
 });
