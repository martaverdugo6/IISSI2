<?php

	session_start();

	require_once("gestionBD.php");
	require_once("gestionOfertas.php");

	if (isset($_SESSION["nuevaOferta"])) {	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL 																			FORMULARIO YA VALIDADOS
		$nuevaOferta = $_SESSION["nuevaOferta"];
		$_SESSION["nuevaOferta"] = null;
		$_SESSION["errores"] = null;
	

	}else{
		Header("Location: crear_oferta.php");	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	}
	

	$conexion = crearConexionBD();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Exito en la creación de la oferta</title>
</head>
<body>

	<ul id="oferta_creada">
		<?php if(crear_oferta($conexion,$nuevaOferta)){	?>
			<h1>Se ha creado la siguiente oferta con exito:</h1>
			<li>
				<b>Descuento:</b> <?php echo $nuevaOferta['DESCUENTO']." %"; ?>
			</li>
			<li>
				<b>Fecha de inicio:</b> <?php echo $nuevaOferta['FECHA_INICIO']; ?>
			</li>
			<li>
				<b>Fecha de fin:</b> <?php echo $nuevaOferta['FECHA_FIN']; ?>
			</li>
			<li>
				<b>OID de producto:</b> <?php echo $nuevaOferta['OID_PRO']; ?>
			</li>
			<li>
				<a href="consulta_ofertas.php">Ir a la página principal de ofertas</a>
			</li>
		<?php }else{ ?>
			<h1>¡Vaya!</h1>
			<p>No se ha podido insertar con exito</p>
		
		<?php } ?>
	</ul>

</body>
</html>