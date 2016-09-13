<?php 

$nombre = $_GET["nombre"];
$equipo = $_GET["equipo"];
$tipo   = $_GET["tipo"];

?>

<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>GET</title>
</head>

<body>
	Nombre: <?php echo $nombre;?><br> 
	Equipo: <?php echo $equipo;?><br>
	Pokemón: <?php echo $tipo;?><br>
</body>



</html>
