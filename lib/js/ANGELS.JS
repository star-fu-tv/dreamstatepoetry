// ---[ setup angular app ]--- //
var app = angular.module('buttonUpApp', []);
 
// ---[ Init image stream controller ]--- //
app.controller('ImagesController', function($scope, $http) {
 	getImgStream();
	 
	// -* Load all images, order by date , recent first *- //
	function getImgStream(){
		// $http.get("lib/getImgStream.php").success(function(data){
		// 	$scope.imgs = data;
	 // 	});
		$scope.imgs = [{"id":"1","name":"Name Last Name","route":"upload","email":"niadzi@yahoo.co.uk","user_id":"0","username":"","country":"United Kingdom","comment":"khkjd","thumbnail":"thumb_exp1_shockwave_large-5132271246.gif","hi_res":"exp1_shockwave_large-5132271246.gif","status":"selected","subscribe":"off","created_at":"2014-07-30 18:01:48","updated_at":"0000-00-00 00:00:00"}, {"id":"2","name":"Fname Lname","route":"upload","email":"ssss@oooo.cm","user_id":"0","username":"","country":"ddd","comment":"dd","thumbnail":"thumb_exp1_shockwave_large-5132271246.gif","hi_res":"exp1_shockwave_large-5132271246.gif","status":"new","subscribe":"off","created_at":"2014-07-30 18:04:50","updated_at":"0000-00-00 00:00:00"}, {"id":"3","name":"Golden Being","route":"upload","email":"true@true.com","user_id":"0","username":"","country":"","comment":"","thumbnail":"thumb_buttonup-8030533334.gif","hi_res":"buttonup-8030533334.gif","status":"new","subscribe":"off","created_at":"2014-07-30 18:06:59","updated_at":"0000-00-00 00:00:00"}, {"id":"4","name":"Spandeau Ballet","route":"upload","email":"bababababa@ba.cm","user_id":"0","username":"","country":"kmndsm ","comment":"sdfmn","thumbnail":"thumb_buttonup-6978336018.gif","hi_res":"buttonup-6978336018.gif","status":"new","subscribe":"off","created_at":"2014-07-30 23:44:16","updated_at":"0000-00-00 00:00:00"}, {"id":"5","name":"Tree Leaf","route":"upload","email":"niadzi@yahoo.co.uk","user_id":"0","username":"","country":"United Kingdom","comment":"sss","thumbnail":"thumb_buttonup-7272762418.png","hi_res":"buttonup-7272762418.png","status":"new","subscribe":"off","created_at":"2014-07-31 08:22:23","updated_at":"0000-00-00 00:00:00"}, {"id":"6","name":"Henry Hippo","route":"upload","email":"niadzi@yahoo.co.uk","user_id":"0","username":"","country":"United Kingdom","comment":"hi hi hi","thumbnail":"thumb_buttonup-3551761284.png","hi_res":"buttonup-3551761284.png","status":"new","subscribe":"off","created_at":"2014-07-31 08:30:46","updated_at":"0000-00-00 00:00:00"}, {"id":"7","name":"rich","route":"upload","email":"mogstar@gmail.com","user_id":"0","username":"","country":"United Kingdom","comment":"sdfsdfsdf","thumbnail":"thumb_buttonup-8189820507.jpg","hi_res":"buttonup-8189820507.jpg","status":"new","subscribe":"off","created_at":"2014-07-31 18:24:54","updated_at":"0000-00-00 00:00:00"}, {"id":"8","name":"Nia","route":"upload","email":"niadzi@yahoo.co.uk","user_id":"0","username":"","country":"United Kingdom","comment":"","thumbnail":"thumb_buttonup-902830236.png","hi_res":"buttonup-902830236.png","status":"new","subscribe":"off","created_at":"2014-07-31 18:46:20","updated_at":"0000-00-00 00:00:00"}];
	};
 
	// $scope. = function (task) {
	// $http.get("ajax/addTask.php?task="+task).success(function(data){
	// getTask();
	//  $scope.taskInput = "";
	//  });
	// };

	//  $scope.deleteTask = function (task) {
	//  if(confirm("Are you sure to delete this line?")){
	//  $http.get("ajax/deleteTask.php?taskID="+task).success(function(data){
	//  getTask();
	//  });
	//  }
	//  };
 
	// $scope.toggleStatus = function(item, status, task) {
	//  if(status=='2'){status='0';}else{status='2';}
	//  $http.get("ajax/updateTask.php?taskID="+item+"&status="+status).success(function(data){
	//  getTask();
	//  });
	//  };
	 
});

// ---[ Init mods' img controller ]--- //
/* : sets init button status : */
/* : updates DB with new button status : */
app.controller('ModImgController', function($scope) {

	// ---[ Initial setup of buttons/view ]--- //	
	if($scope.img.status == 'new') {
		$scope.isNew = true;
	}
	if($scope.img.status == 'selected') {
		$scope.isSelected = true;
	}
	if($scope.img.status == 'featured') {
		$scope.isFeatured = true;
	}
	if($scope.img.status == 'seen') {
		$scope.isSeen = true;
	}			
})

app.controller('ViewController', ['$scope', function($scope) {
$scope.view = 'new';
}]);
