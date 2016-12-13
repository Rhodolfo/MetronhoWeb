<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>Javascript</title>
</head>

<script src="js/angular.min.js"></script>
<script src="js/angular-sanitize.min.js"></script>
<script src="js/angular-bind-html-compile.min.js"></script>

<body>
<div ng-app="myApp" ng-controller="myCtrl">
	<a href="" ng-click="pingit('spa_home.php')">Menú</a>
	<p>Con AJAX y un poco de ingenio puedes hacer mucho.</p>
	<div bind-html-compile="sub"></div>
	<br>
	Aquí hay un footer.
</div>
</body>



<script>
var app = angular.module("myApp",["ngSanitize","angular-bind-html-compile"]);
app.controller("myCtrl",function($scope,$http) {
	$scope.pingit = function(page) {
		var jsn = {};
		$http({
			url: page,
			method: "POST",
			cache: false,
			data: jsn
		}).then(
			function successCallback(response) {
				$scope.sub = response.data;
			}, function errorCallback(response) {
				$scope.message = "Hubo un error con el servidor";
			}
		);
	};
	$scope.pingit("spa_home.php");
});
app.controller("otherCtrl",function($scope) {
	$scope.numb = null;
	$scope.opts = [
		{id:0,str:'Cero'},
		{id:1,str:'Uno'},
		{id:2,str:'Uno'}
	];
});
</script>

</html>
