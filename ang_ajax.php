<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>Javascript</title>
</head>

<script src="js/angular.min.js"></script>
<script src="js/angular-sanitize.min.js"></script>

<body>

<div ng-app="myApp" ng-controller="myCtrl">
	<p> Este es un ejemplo de AJAX en Angular.js </p>
	<input type="text" ng-model="name"/>
	<input type="button" ng-click="postit()" value="Manda"/>
	<br>
	<p ng-bind-html="message"></p>
</body>



<script>
var app = angular.module("myApp",["ngSanitize"]);
app.controller("myCtrl",function($scope,$http) {
	$scope.nombre = "Pon tu nombre aqui";
	$scope.postit = function() {
		var jsn = {"datos":$scope.name};
		$http({
			url: "ang_ajax_post.php",
			method: "POST",
			cache: false,
			data: jsn
		}).then(
			function successCallback(response) {
				$scope.message = response.data;
			}, function errorCallback(response) {
				$scope.message = "Hubo un error con el servidor";
			}
		);
	};
});
</script>

</html>
