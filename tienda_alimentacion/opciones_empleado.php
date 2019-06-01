<?php 
	session_start();

	if(!isset($_SESSION["datosEmpleado"])){		//Solo podemos entrar aquí si se ha iniciado sesión como empleado
		header("Location: login.php");
	}


?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Tienda de Alimentación: Opciones empleado</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
<main>
	<ul>
		<li><a href="crear_producto.php">Crear un producto</a></li>
		<li><a href="crear_oferta.php">Crear una oferta</a></li>
		<li><a href="consulta_usuarios.php">Consultar los usuarios registrados</a></li>
	</ul>

</main>
</body>
<?php
	include_once("pie.php");
?>
</html>