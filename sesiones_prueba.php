<?php 

session_start();

$table  = "<table><tr>";
// Si el usuario tiene una sesion activa, 
// ensena su nombre y un boton para salir.
if (isset($_SESSION["user"])) {
	$table  .= "<td>Usuario:</td><td>".$_SESSION["user"]."</td>";
	$message = "Tu ya tienes una sesión";
// Si el usuario no ha iniciado sesion,
// ensena una forma de usuario + password.
} else {
	$message = "No has iniciado sesión";
}
$table .= "</tr></table>";



?>

<!DOCTYPE html>
<html lang="en">



<head>
	<meta charset="utf-8">
	<title>Sesiones</title>
</head>



<!-- <br> Hace un espacio para abajo (break) !-->
<body>
		<p><a href="sesiones.php">Haz click aquí para regresar.</a></p>
		<?php echo $table;?>
		<p><?php echo $message;?></p>
	</form>
</body>



</html>
