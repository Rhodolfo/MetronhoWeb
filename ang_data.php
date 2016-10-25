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
	<p> Como llenar un objeto de propiedades con AngularJS: </p>
	<p> Por medio de "ng-model" se pueden añadir atributos a un objeto, 
		nótese que el último campo no es un atributo de "data" 
		(no tiene un formato "data.algo" en ng-model).</p>
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
				<select ng-options="algo.id as algo.etiqueta for algo in opts" 
					ng-model="data.equipo"/>
			</td>
		</tr>
		<tr>
			<td> 
				Extra:
			</td>
			<td>
				<input type="text" ng-model="extra"/>
			</td>
		</tr>
	</table>
	<p> Este es el objeto "data" que se manda a servidor por medio de la función "send": </p>
	<p>{{data}} </p>
	<input type="button" value="Mandar datos" ng-click="send(data)"/><br>
	<p ng-bind-html="mensaje"></p>
</body>

<script>
var app = angular.module("myApp",["ngSanitize"]);
app.controller("myCtrl",function($scope,$http) {
	$scope.opts = [
		{id:1,etiqueta:"Azul"},
		{id:2,etiqueta:"Amarillo"},
		{id:3,etiqueta:"Rojo"}
	];
	$scope.send = function(obj) {
		var req = $http({
			url: "ang_data_post.php",
			method: "post",
			data: obj // Mando datos que se alimentaron a la funcion
		});
		req.then(function successCallback(response) {
			$scope.mensaje = response.data;
		}, function errorCallback(response) {
			$scope.mensaje = "Hubo un error al conectarse con el servidor.";
		});

	};
});
</script>

</html>
