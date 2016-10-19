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
	<p> Aquí hay maneras de desplegar variables del $scope: </p>
	<input type="text" ng-model="ejemplo"/> <br>
	<table> 
		<tr><td>Con una expresión:</td><td>{{ejemplo}}<td></tr>
		<tr><td>Compilando html:</td><td><p ng-bind-html="ejemplo"></p></tr>
	</table>
	<select ng-options='entry.id as entry.label for entry in pokemon' ng-model='ejemplo2'>
	</select>
	<table> 
		<tr><td>Con una expresión:</td><td>{{ejemplo2}}<td></tr>
		<tr><td>Compilando html:</td><td><p ng-bind-html="ejemplo2"></p></tr>
	</table>
	<input type="button" ng-click="limpia()" value="Limpiar campos"/>
</body>



<script>
var app = angular.module("myApp",["ngSanitize"]);
app.controller("myCtrl",function($scope,$http) {
	$scope.ejemplo = "Escribe en el texto.";
	$scope.pokemon = {
		'opt1':{'id':'Pikachu','label':'Eléctrico'},
		'opt2':{'id':'Machamp','label':'Pelea'},
		'opt3':{'id':'Pidgeot','label':'Volador'}
	};
	$scope.limpia = function() {
		$scope.ejemplo  = "";
		$scope.ejemplo2 = "";
	};
});
</script>

</html>
