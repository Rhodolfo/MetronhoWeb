<?php

// Recogiendo datos
$ANGULAR = json_decode(file_get_contents('php://input'),true);
$response = array();

// Si no se han mandado datos
if (!isset($ANGULAR['type'])) { // Si no hay datos
	$response[0] = array('id'=>'0','label'=>'Agua');
	$response[1] = array('id'=>'1','label'=>'Fuego');
	$response[2] = array('id'=>'2','label'=>'Pasto');
} else { // Si hay datos
	$type = intval($ANGULAR['type']);
	if ($type==0) { // Agua 
		$response[0] = array('id'=>'0','label'=>'Squirtle');
		$response[1] = array('id'=>'1','label'=>'Horsea');
		$response[2] = array('id'=>'2','label'=>'Tentacool');
	} elseif ($type==1) { // Fuego
		$response[0] = array('id'=>'0','label'=>'Charmander');
		$response[1] = array('id'=>'1','label'=>'Growlithe');
		$response[2] = array('id'=>'2','label'=>'Vulpix');
	} elseif ($type==2) { // Pasto
		$response[0] = array('id'=>'0','label'=>'Bulbasaur');
		$response[1] = array('id'=>'1','label'=>'Oddish');
		$response[2] = array('id'=>'2','label'=>'Paras');
	}
}

echo json_encode($response);

?>
