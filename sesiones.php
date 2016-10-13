<?php 

session_start();



// Si mandaste un POST a esta pagina,
// checa si el usuario quiere salir y entrar
// Es buena practica checar que las entradas de los arreglos 
// $_POST, $GET y $_SESSION que vas a usar están definidos
$message = "";
if (isset($_POST["action"])) {
	// Si el usuario quiere entrar, checa usuario y password
	if ($_POST["action"] == "login") {
		if (isset($_POST["user"]) && isset($_POST["pass"])) {
			/*****************
			*** IMPORTANTE ***
			******************
		
			El siguiente paso es comparar usuario y contraseña
			con datos existentes.
	
			Normalmente en este paso se usa 
			una tabla de usuarios en una base de datos,
			pero lo haré con texto sencillo.
	
			Las contraseñas tampoco se deberían de guardar
			sin haber sido procesadas por un Hash con Sal,
			googlea las functiones PHP password_hash y password_verify.
			https://en.wikipedia.org/wiki/Hash_function
			http://php.net/manual/en/function.password-hash.php
			http://php.net/manual/en/function.password-verify.php

			LAS CONTRASEÑAS SIEMPRE DEBEN DE SER HASHEADAS ANTES 
			DE GAURDARSE EN UNA BASE DE DATOS

			Por otro lado, los POSTs que uno manda con contraseñas
			deben de ser mandados por una conexión encriptada,
			por ejemplo por protocolo HTTPS en lugar de HTTP,
			https://en.wikipedia.org/wiki/HTTPS
			Este usa encriptación TLS o SSL.
			Uno tiene que configurar su servidor para manejar
			estos protocolos, por ejemplo en Apache 2,
			https://httpd.apache.org/docs/2.4/ssl/ssl_howto.html
			https://www.digitalocean.com/community/tutorials/how-to-create-a-ssl-certificate-on-apache-for-ubuntu-14-04

			NUNCA MANDES DATOS SENSIBLES POR UN CANAL NO ENCRIPTADO
			
			Al final, tus contraseñas deben estar encriptadas 
			y tu conexión al servidor debe estar encriptada también.
			
			UN PASSWORD SEGURO NO VALE NADA SIN AL MENOS ESTOS
			DOS PASOS DE SEGURIDAD
			*/
			if ($_POST["user"]=="Pablo" && $_POST["pass"]=="1234") {
				/*******************************************************
				*** AL DECLARAR UNA ENTRADA DE _SESSION,             ***
				*** HE DECLARADO UNA VARIABLE DE SESION QUE PERSISTE ***
				*******************************************************/
				$_SESSION["user"] = $_POST["user"];
				$message = "Has creado una sesión.";
			} else {
				$message = "Usuario/Contraseña incorrectos.";	
			}
		}
	// Si el usuario quiere salir, destruye la sesion
	} elseif ($_POST["action"] == "logout") {
		session_destroy(); // Destruye el arreglo $_SESSION
		session_start(); // Creo el arreglo otra vez, pero esta vacío
		// Esto lo puse porque voy a seguir trabajando con este arreglo
		$message = "Has salido de la sesión.";
	// Si nos mandaron datos malos, le decimos al usuario
	} else {
		$message = "Has mandado datos incorrectos.";	
	}
}



$table  = "<table><tr>";
// Si el usuario tiene una sesion activa, 
// ensena su nombre y un boton para salir.
if (isset($_SESSION["user"])) {
	$table .= "<td>Usuario:</td><td>".$_SESSION["user"]."</td>"
		 ."</tr><tr>"
		 ."<td>"
		 ."<input type=\"text\" value=\"logout\" name=\"action\" style=\"display:none\"/>"
		 ."</td>" // Este campo es invisible, solo lo puse para especificar accion
		 ."<td><input type=\"submit\" value=\"Salir\"/><td>";
// Si el usuario no ha iniciado sesion,
// ensena una forma de usuario + password.
} else {
	$table .= "<td>Usuario:</td>"
		 ."<td><input type=\"text\" name=\"user\"/></td>"
		 ."</tr><tr>"
		 ."<td>Contraseña:</td>"
		 ."<td><input type=\"text\" name=\"pass\"/></td>"
		 ."</tr><tr>"
		 ."<td>"
		 ."<input type=\"text\" value=\"login\" name=\"action\" style=\"display:none\"/>"
		 ."</td>" // Este campo es invisible, solo lo puse para especificar accion
		 ."<td><input type=\"submit\" value=\"Entrar\"/><td>";
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
	<form action="sesiones.php" method="post">
		<p><a href="sesiones_prueba.php">Haz click aquí para probar tu sesión.</a></p>
		<?php echo $table;?>
		<p><?php echo $message;?></p>
	</form>
</body>



</html>
