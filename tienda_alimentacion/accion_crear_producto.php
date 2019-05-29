<?php

	session_start();

	require_once("gestionBD.php");
	require_once("gestionProductos.php");

	if (isset($_SESSION["nuevoProd"])) {	// COMPROBAR QUE EXISTE LA SESIÓN CON LOS DATOS DEL 																			FORMULARIO YA VALIDADOS
		$nuevoProd = $_SESSION["nuevoProd"];
		$_SESSION["nuevoProd"] = null;
		$_SESSION["errores"] = null;
	

	}else{
		Header("Location: crear_producto.php");	// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
	}
	

	$conexion = crearConexionBD();

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Exito en la creación del producto</title>
</head>
<body>

	<ul id="producto_creado">
		<?php if(crear_producto($conexion,$nuevoProd)){	?>
			<h1>Se ha creado el siguiente producto con exito:</h1>
			<li>
				<b>Nombre:</b> <?php echo $nuevoProd['nombre']; ?>
			</li>
			<li>
				<b>Descripción:</b> <?php echo $nuevoProd['descripcion']; ?>
			</li>
			<li>
				<b>Stock:</b> <?php echo $nuevoProd['stock']." uds"; ?>
			</li>
			<li>
				<b>Precio:</b> <?php echo $nuevoProd['precio']."€"; ?>
			</li>
			<li>
				<b>Categoria:</b> <?php echo $nuevoProd['categoria']; ?>
			</li>
			<li>
				<a href="consulta_productos.php">Ir a la página principal de productos</a>
			</li>
		<?php }else{ ?>
			<h1>¡Vaya!</h1>
			<p>No se ha podido insertar con exito</p>
		
		<?php } ?>
	</ul>

</body>
</html>