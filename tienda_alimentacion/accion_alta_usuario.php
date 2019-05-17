<?php

	session_start();

	require_once("gestionBD.php");
	require_once("gestionUsuarios.php");

	if (isset($_SESSION["formulario"])) {	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL 																			FORMULARIO YA VALIDADOS
		$nuevoUsuario = $_SESSION["formulario"];
		$_SESSION["formulario"] = null;
		$_SESSION["errores"] = null;
	
	}else{
		Header("Location: alta_usuario.php");	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	}

	function getFechaFormateada($fecha){
		$fechaNacimiento = date('d/m/Y', strtotime($fecha));
		return $fechaNacimiento;
	}	

	$conexion = crearConexionBD();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Exito en el alta de usuario</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
	?>

	<main>
		<ul class=accion_reg>
			<?php if(alta_usuario($conexion, $nuevoUsuario)){	// AQUÍ SE INVOCA A LA FUNCIÓN DE ALTA DE USUARIO
			$_SESSION['login'] = $nuevoUsuario['email'];
							
				// EN EL CONTEXTO DE UNA SENTENCIA IF
			?>
				<h1>Bienvenido/a <?php echo $nuevoUsuario['nombre']; ?>, gracias por registrarse</h1>		<!-- MENSAJE DE BIENVENIDO AL USUARIO -->
				<div>
					<p>Pulsa <a href = "login.php"> aquí</a> para iniciar sesión.</p>
				</div>
			<?php } else { ?>
				<h1>¡Ya existe un usuario con ese email!</h1>	<!-- MENSAJE DE QUE USUARIO YA EXISTE -->
				<div>
					<p>Pulsa <a href="alta_usuario.php"> aquí</a> para volver al formulario.</p>
				</div>
			<?php } ?>
		</ul>
</body>
</html>
<?php
	cerrarConexionBD($conexion);			// DESCONECTAR LA BASE DE DATOS
?>