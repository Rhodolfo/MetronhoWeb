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
	<p> Algunos elementos vienen de servidor.</p>
	<p> Usa las herramientas de desarrollador o firebug para ver los paquetes mandados y recibidos. </p>
	<select ng-model="data.sel1" ng-change="postit(data.sel1)">
		<option value="1">Uno</option>
		<option value="2">Dos</option>
	</select>
	<br>
	<div style="{{disp}}">
		<select ng-model="data.sel2" ng-options="entry.id as entry.label for entry in opts">
		</select>
	</div>
	<br>
	<p ng-bind-html="message"></p>
</body>



<script>
var app = angular.module("myApp",["ngSanitize"]);
app.controller("myCtrl",function($scope,$http) {
	$scope.data = {};
	$scope.disp = "display:none";
	$scope.nombre = "Pon tu nombre aqui";
	$scope.postit = function(dat) {
		var jsn = {datos:dat};
		$http({
			url: "scrap_post.php",
			method: "POST",
			cache: false,
			data: jsn
		}).then(
			function successCallback(response) {
				$scope.opts = response.data;
				$scope.disp = "";
			}, function errorCallback(response) {
				$scope.message = "Hubo un error con el servidor";
			}
		);
	};
});
</script>

</html>
