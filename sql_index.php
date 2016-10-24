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
	<p> Como usar datos de una tabla SQL: </p>
	<table> 
		<tr> 
			<td> 
				Nombre: 
			</td>
			<td>
				<input type="text" ng-model="data.nombre"/>
			</td>
		</tr>
		<tr>
			<td> 
				Apellido:
			</td>
			<td>
				<input type="text" ng-model="data.apellido"/>
			</td>
		</tr>
		<tr>
			<td> 
				Equipo:
			</td>
			<td>
				<select ng-options="algo.id as algo.nombre for algo in opts" 
					ng-model="data.equipo"/>
			</td>
		</tr>
	</table>
	<p> Este es el objeto "data" que se manda a servidor por medio de la función "send": </p>
	{{data}}<br>
	<input type="button" value="Mandar datos" ng-click="send(data)"/><br>
	<p ng-bind-html="mensaje"></p>
</body>

<script>
var app = angular.module("myApp",["ngSanitize"]);
app.controller("myCtrl",function($scope,$http) {
	$scope.init = function() {
		var req = $http({
			url: "sql_post.php",
			method: "post",
			data: {} // Mando datos vacíos
		});
		req.then(function successCallback(response) {
			$scope.opts = response.data.equipos;
		}, function errorCallback(response) {
			$scope.mensaje = "Hubo un error al conectarse con el servidor.";
		});

	};
	$scope.send = function(obj) {
		var req = $http({
			url: "sql_post.php",
			method: "post",
			data: obj // Mando datos que se alimentaron a la funcion
		});
		req.then(function successCallback(response) {
			$scope.mensaje = response.data.mensaje;
		}, function errorCallback(response) {
			$scope.mensaje = "Hubo un error al conectarse con el servidor.";
		});

	};
	$scope.init(); // LLamo la funcion init() solamente al principio
});
</script>

</html>
