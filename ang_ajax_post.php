<?php

// Read Angular AJAX request, it doesn't populate $_POST
$ANGULAR = json_decode(file_get_contents('php://input'),true);

if (isset($ANGULAR["datos"])) {
	$name = htmlspecialchars($ANGULAR["datos"]);
	echo "Que onda $name";
} else {
	die("Error");
}

?>
