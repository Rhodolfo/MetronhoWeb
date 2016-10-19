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
	<p>{{ejemplo1}}</p>
	<select ng-options="entry.id as entry.label for entry in opciones" ng-model="ejemplo2">
	</select>
	{{ejemplo2}}
	<br>
	<p ng-bind-html="message"></p>
</body>



<script>
var app = angular.module("myApp",["ngSanitize"]);
app.controller("myCtrl",function($scope,$http) {
	// Declaro una función que inicializa variables de acuerdo
	// a la respuesta de una página externa
	$scope.init = function() {
		// Este es el objeto que declara que datos mando a que página
		// En este caso, no mando datos
		var req = $http({
			url: "ang_ajax_post2.php",
			method: "POST",
			cache: false,
			data: {}
		});
		// Ahora a comunicarse con la pagina
		req.then(function successCallback(response) {
			$scope.ejemplo1 = response.data['unstring'];
			$scope.opciones = response.data['unarray'];
		}, function errorCallback(response) {
			$scope.ejemplo1 = "Hubo un error con el servidor";
		});
	};
	// A ejecutar la función
	$scope.init();
});
</script>

</html>
