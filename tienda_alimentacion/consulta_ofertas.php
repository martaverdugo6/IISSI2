<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionOfertas.php");
	require_once("paginacion_consulta.php");

	if (isset($_SESSION["oferta"])){
		$oferta = $_SESSION["oferta"];
		unset($_SESSION["oferta"]);
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if (isset($_SESSION["paginacion"])) $paginacion = $_SESSION["paginacion"]; 
	$pagina_seleccionada = isset($_GET["PAG_NUM"])? (int)$_GET["PAG_NUM"]:
												(isset($paginacion)? (int)$paginacion["PAG_NUM"]: 1);
	$pag_tam = isset($_GET["PAG_TAM"])? (int)$_GET["PAG_TAM"]:
										(isset($paginacion)? (int)$paginacion["PAG_TAM"]: 5);
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;
	if ($pag_tam < 1) $pag_tam = 5;

	unset($_SESSION["paginacion"]);

	$conexion = crearConexionBD();

	$query = "SELECT * FROM OFERTA ORDER BY fecha_fin";

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion,$query);
	$total_paginas = (int) ($total_registros / $pag_tam);
	if ($total_registros % $pag_tam > 0) $total_paginas++; 
	if ($pagina_seleccionada > $total_paginas) $pagina_seleccionada = $total_paginas;

	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	$paginacion["PAG_NUM"] = $pagina_seleccionada;
	$paginacion["PAG_TAM"] = $pag_tam;
	$_SESSION["paginacion"] = $paginacion;
	
	$filas = consulta_paginada($conexion,$query,$pagina_seleccionada,$pag_tam);
	
	cerrarConexionBD($conexion);

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Tienda de Alimentación: Ofertas</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	<main>
		<nav id="mostrandoPaginacion">
			<form method="get" action="consulta_ofertas.php">
				<input id="PAG_NUM" name="PAG_NUM" type="hidden" value="<?php echo $pagina_seleccionada?>"/>
				Mostrando 
				<input id="PAG_TAM" name="PAG_TAM" type="number" 
					min="1" max="<?php echo $total_registros;?>" 
					value="<?php echo $pag_tam?>" autofocus="autofocus" /> 
					entradas de <?php echo $total_registros?>
				<input class="cambiarPagina" type="submit" value="Cambiar">
			</form>
			<div id="enlaces">
				<?php
					for( $pagina = 1; $pagina <= $total_paginas; $pagina++ ) 
						if ( $pagina == $pagina_seleccionada) { 	?>
							<span class="current"><?php echo $pagina; ?></span>
				<?php }	else { ?>			
							<a href="consulta_ofertas.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
				<?php } ?>			
			</div>
		</nav>
		<table class="PrimeraLineaTablaOferta">
			<tr>
				<td>Nombre</td>
				<td>Descuento</td>
				<td>Fecha Inicio</td>
				<td>Fecha Fin</td>
			</tr>
		</table>

		<?php
			foreach($filas as $fila) {
				$conexionP = crearConexionBD();
				$query2 = "SELECT producto.nombre_pro FROM producto WHERE producto.oid_pro = ".$fila["OID_PRO"];
				$stmt = $conexionP -> prepare($query2);
				$stmt->execute();
				$nombreProducto = $stmt -> fetch(PDO:: FETCH_ASSOC);
		?>
		<article class="oferta">
			<form method="post" action="controlador_oferta.php">
				<div class="fila_ofert">
					<table class="tablaOfertas">
					<tr class="datos_ofertas">
						<input id="OID_OFE" name="OID_OFE"
							type="hidden" value="<?php echo $fila["OID_OFE"]; ?>"/>

					<?php
						if (isset($oferta) and ($oferta["OID_OFE"] == $fila["OID_OFE"])) { ?>
						<!--Editando descuento-->

						<td><div class="nombrePro"><?php echo $nombreProducto["NOMBRE_PRO"]; ?></div></td>
						<td><input class="DESCUENTO" name="DESCUENTO" type="text" value="<?php echo $fila["DESCUENTO"]; ?>"/>%</td>
						<td><div class="fechaInicio"><?php echo $fila["FECHA_INICIO"]; ?></div></td>
						<td><div class="fechaFin"><?php echo $fila["FECHA_FIN"]; ?></div>

					<?php }	else { ?>
						<!-- mostrando descuento-->

						<td><div class="nombrePro"><?php echo $nombreProducto["NOMBRE_PRO"]; ?></div></td>
						<td><div class="descuento"><?php echo $fila["DESCUENTO"]."%"; ?></div></td>
						<td><div class="fechaInicio"><?php echo $fila["FECHA_INICIO"]; ?></div></td>
						<td><div class="fechaFin"><?php echo $fila["FECHA_FIN"]; ?></div>
					
					<?php } ?>

					<?php if(isset($_SESSION["datosEmpleado"])){ ?>
						<div id="botones_fila">
							<?php if (isset($oferta) and ($oferta["OID_OFE"] == $fila["OID_OFE"])) { ?>
							<td><button title="Guardar edición" id="guardar" name="guardar" type="submit" class="editar_fila">
								<img src="img/guardar.png" class="editar_fila" alt="Guardar modificación">
							</button></td>
						<?php } else {?>
							<td><button title="Editar oferta" id="editar" name="editar" type="submit" class="editar_fila">
								<img src="img/editar.png" class="editar_fila" alt="Editar oferta">
							</button></td>
						<?php } ?>
							<td><button title="Eliminar oferta" id="borrar" name="borrar" type="submit" class="editar_fila">
								<img src="img/eliminar.png" class="editar_fila" alt="Borrar oferta">
							</button></td>
						</div>
					<?php } ?>
					</tr>
					</table>					
					<hr>
				
				</div>
			</form>
		</article>
		<?php cerrarConexionBD($conexionP);} ?>

	</main>
<?php
	include_once("pie.php");
?>
</body>
</html>