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
	<table> 
		<tr> 
			<td> 
				<select ng-options="entry.id as entry.label for entry in optipo"
				ng-model="tipo" ng-change="doTipo(tipo)">
				</select>
			</td>
			<td>
				{{optipo[tipo].label}}
			</td>
		</tr>
		<tr>
			<td> 
				<select ng-options="entry.id as entry.label for entry in opespecie"
				ng-model="especie">
				</select>
			</td>
			<td>
				{{opespecie[especie].label}}
			</td>
		</tr>
	</table>
	<p ng-bind-html="mensaje"></p>
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
			url: "ang_ajax_post3.php",
			method: "POST",
			cache: false,
			data: {}
		});
		// Ahora a comunicarse con la pagina
		req.then(function successCallback(response) {
			$scope.optipo = response.data;
		}, function errorCallback(response) {
			$scope.mensaje = "Hubo un error con el servidor";
		});
	};
	// Una vez escogido un tipo, pedir una lista de especies
	$scope.doTipo = function(arg) {
		var obj = {'type':arg};
		var req = $http({
			url: "ang_ajax_post3.php",
			method: "POST",
			cache: false,
			data: obj // Datos que se mandan
		});
		// Ahora a comunicarse con la pagina
		req.then(function successCallback(response) {
			$scope.opespecie = response.data;
		}, function errorCallback(response) {
			$scope.mensaje = "Hubo un error con el servidor";
		});
	};
	// A ejecutar la función inicializadora
	$scope.init();
});
</script>

</html>
