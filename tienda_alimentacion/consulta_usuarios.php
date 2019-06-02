<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionUsuarios.php");

	$conexion = crearConexionBD();

		$filas = consultarTodosUsuario($conexion);

	cerrarConexionBD($conexion);
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Tienda de Alimentación: Usuarios</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<main>
		<table class="PrimeraLineaTablaUsuarios">
			
			<tr>
				<td>Apellidos</td>
				<td>Nombre</td>
				<td>DNI</td>
			</tr>
		</table>
		<?php
			foreach($filas as $fila) {
		?>
			<table class="tablaUsuarios">
				<td><div class="APELLIDOS_CLI"><?php echo $fila["APELLIDOS_CLI"]; ?></div></td>
				<td><div class="NOMBRE_CLI"><?php echo $fila["NOMBRE_CLI"]; ?></div></td>
				<td><div class="DNI_CLI"><?php echo $fila["DNI_CLI"]; ?></div></td>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</table>
			<hr>
		<?php } ?>
	</main>

<?php
	include_once("pie.php");
?>
</body>
</html>