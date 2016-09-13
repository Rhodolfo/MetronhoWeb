<?php 

// A checar si se han mandado los datos correctos
if (isset($_POST["nombre"]) && isset($_POST["equipo"]) && isset($_POST["tipo"])) {
	$valida = "OK";	
} else {
	die("No se han mandado los datos correctos");
}

// Asignemolos, en este paso se limpiarian los datos
$nombre = htmlspecialchars($_POST["nombre"]);
$equipo = htmlspecialchars($_POST["equipo"]);
$tipo   = htmlspecialchars($_POST["tipo"]);

$elbueno = "Instinct";
if ($equipo==$elbueno) {
	$mensaje = "Hombre";
	if ($nombre == "Araceli") {$mensaje = "Mujer";}
} else {
	$mensaje = "Payaso";
}


?>

<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>POST</title>
</head>

<body>
	<?php echo $mensaje.": ".$nombre;?><br> 
	Equipo: <?php echo $equipo;?><br>
	Pokemón: <?php echo $tipo;?><br>
</body>



</html>
