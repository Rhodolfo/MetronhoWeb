<?php

// Read Angular AJAX request, it doesn't populate $_POST
$ANGULAR = json_decode(file_get_contents('php://input'),true);

if (isset($ANGULAR['datos'])) {
	$data = intval($ANGULAR['datos']);
}

// Form response
$response = array();
if ($data==1) {
	$response[] = array("id"=>11,"label"=>"Once");
	$response[] = array("id"=>12,"label"=>"Doce");
} else {
	$response[] = array("id"=>21,"label"=>"Veintinuo");
	$response[] = array("id"=>22,"label"=>"Veintidos");
}
echo json_encode($response);


?>
