<?php

// Variables de entrada a la base de datos
$dbaddr = "localhost";
$dbuser = "ejemplos";
$dbpass = "ejemplos1234";
$dbname = "ejemplos";
$dbport = 1433;

// Conectarse a la base de datos
$con = new mysqli($dbaddr,$dbuser,$dbpass,$dbname,$dbport);
if ($con->connect_error) {
	die("Error al conectarse a la base de datos");
}
$con->set_charset("utf8");

// Recojo datos POST si existen
$ANGULAR = json_decode(file_get_contents('php://input'),true);
$check = isset($ANGULAR['nombre']) || isset($ANGULAR['apellido']) || isset($ANGULAR['equipo']);

// Primero vamos a definir que pasa cuando no se mandan datos a servidor
if (!$check) {

	// Formar la consulta, colo selecciono dos campos de la tabla equipos
	$str = "SELECT ID AS id,nombre AS nombre FROM equipos ORDER BY nombre";

	// Ejecutar consulta
	$res = $con->query($str);
	if (!$res) {
		die("Error al buscar valores");
	}

	// Una vez ejecutada la consulta, sacar resultados
	$teams = array();
	if ($res->num_rows) { // num_rows es false a menos que se hayan encontrado resultados
		while ($entry = $res->fetch_assoc()) { // Este loop saca cada fila de resultados por iteracion
			$teams[] = $entry; // Cada entrada de $teams es una fila
		}
	} else {
		die("No se encontraron resultados");
	}

	// Escupo los datos en forma de JSON
	$response = array();
	$response['equipos'] = $teams;
	die(json_encode($response));

// Si es que se mandan datos, contestamos acorde a ellos
} else {
	
	// Inicializando una variable
	$mess = "";

	// Si se manda el nombre, repetirlo, si no, avisar.
	if (isset($ANGULAR['nombre'])) {
		$mess .= "<p>Tu nombre es ".htmlspecialchars($ANGULAR['nombre']).".</p>";
	} else {
		$mess .= "<p>No mandaste tu nombre.</p>";
	}

	// Si se manda el apellido, repetirlo, si no, avisar.
	if (isset($ANGULAR['apellido'])) {
		$mess .= "<p>Tu apellido es ".htmlspecialchars($ANGULAR['apellido']).".</p>";
	} else {
		$mess .= "<p>No mandaste tu apellido.</p>";
	}

	// Si se manda el equipo, repetirlo, si no, avisar.
	if (isset($ANGULAR['equipo'])) {
		// La variable "equipo" es un ID en la tabla de equipos, debe ser entero
		$id    = intval($ANGULAR["equipo"]);
		// De cualquier manera, utilizamos esta variable para hacer una consulta
		$query = "SELECT color FROM equipos WHERE ID = ?;";
		$state = $con->prepare($query);
		$state->bind_param('i',$id);
		$state->execute();
		$state->bind_result($color);
		if (!$state->fetch()) {
			die("Error al recoger datos");
		}	
		$mess .= "<p>Tu equipo es ".$color.".</p>";
	} else {
		$mess .= "<p>No mandaste tu equipo.</p>";
	}
	
	$response = array();
	$response['mensaje'] = $mess;
	die(json_encode($response));
}

?>
