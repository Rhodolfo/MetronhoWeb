<?php

// Vamos a regresar un mensaje
$mess = "Esta información vino de otra página";

// Añado elementos a un arreglo vacío
$opts = array();
$opts[] = array('id'=>'Pikachu','label'=>'Eléctrico');
$opts[] = array('id'=>'Machamp','label'=>'Pelea');
$opts[] = array('id'=>'Pidgeot','label'=>'Volador');

// Regreso
$response['unstring'] = $mess;
$response['unarray']  = $opts; 
echo json_encode($response);

?>
