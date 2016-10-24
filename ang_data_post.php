<?php

// Recogiendo datos
$ANGULAR = json_decode(file_get_contents('php://input'),true);
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
	$mess .= "<p>Tu equipo es ".htmlspecialchars($ANGULAR['equipo']).".</p>";
} else {
	$mess .= "<p>No mandaste tu equipo.</p>";
}

echo $mess;


?>
