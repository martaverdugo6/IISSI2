<?php
	session_start();

	require_once("gestionBD.php");
	require_once("gestionProductos.php");
	require_once("paginacion_consulta.php");

	if (isset($_SESSION["producto"])){
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
	}

	// ¿Venimos simplemente de cambiar página o de haber seleccionado un registro ?
	// ¿Hay una sesión activa?
	if(isset($_SESSION['paginacion'])){
		$paginacion = $_SESSION['paginacion'];/* Expresión para iniciar variable de sesión (si es que hay) */
	}


	if(isset($_GET['PAG_NUM'])){
		$pagina_seleccionada = $_GET['PAG_NUM'];
	}else if(isset($paginacion)){
		$pagina_seleccionada = $paginacion['PAG_NUM'];
	}else{
		$pagina_seleccionada = 1;		//Página por defecto si no se ha seleccionado ninguna
	}


	if(isset($_GET['PAG_TAM'])){
		$pag_tam = $_GET['PAG_TAM'];
	}else if(isset($paginacion)){
		$pag_tam = $paginacion['PAG_TAM'];
	}else{
		$pag_tam = 8;		//tamaño por defecto es 5
	}
			
	if ($pagina_seleccionada < 1) $pagina_seleccionada = 1;		//No se permine las paginas <0
	if ($pag_tam < 1) $pag_tam = 8;		//para tamaños de paginas <1, darle valor 5 por defecto
	
	// Borrar la variable de sesión respecto paginación
	unset($_SESSION['paginacion']);

	$conexion = crearConexionBD();

	// La consulta que ha de paginarse
	$query = "SELECT producto.oid_pro, producto.nombre_pro, producto.descripcion, producto.precio_pro FROM PRODUCTO ORDER BY categoria";

	// Se comprueba que el tamaño de página, página seleccionada y total de registros son conformes.
	// En caso de que no, se asume el tamaño de página propuesto, pero desde la página 1
	$total_registros = total_consulta($conexion,$query);

	$total_paginas = (int) ($total_registros / $pag_tam);
	
	if($total_registros % $pag_tam > 0){		//cuando el resto no es cero añadimos una pagina más
		$total_paginas++;
	}
	
	// Generamos los valores de sesión para página e intervalo para volver a ella después de una operación
	if($pagina_seleccionada > $total_paginas){
		$pagina_seleccionada = $total_paginas;
	}

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
	<title>Tienda de Alimentación: Productos</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
	
	<main>
		<div id="errorBorradoProd">
			<?php if(isset($_SESSION['errorBorrado'])){ ?>
				<p><?php echo $_SESSION['errorBorrado']; ?></p>
			<?php } $_SESSION['errorBorrado']=null; ?>
		</div>

		<nav id="mostrandoPaginacion">
			<form method="get" action="consulta_productos.php">
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
							<a href="consulta_productos.php?PAG_NUM=<?php echo $pagina; ?>&PAG_TAM=<?php echo $pag_tam; ?>"><?php echo $pagina; ?></a>
				<?php } ?>			
			</div>
		</nav>
		<table class="PrimeraLineaTablaProductos">
			
			<tr>
				<td>Nombre</td>
				<td>Descripción</td>
				<td>Precio</td>
			</tr>
		</table>

		<?php
			foreach($filas as $fila) {
		?>

		<article class="productos">
			<form method="post" action="controlador_producto.php">
				<div class="fila_prod">
					<table class="tablaProductos">	
					<tr class="datos_productos">
						<input id="OID_PRO" name="OID_PRO"
							type="hidden" value="<?php echo $fila["OID_PRO"]; ?>"/>


					<?php
					if (isset($producto) and ($producto["OID_PRO"] == $fila["OID_PRO"])) { ?>
						<!--Editando precio-->
						<td><div class="nombre_pro"><?php echo $fila["NOMBRE_PRO"]; ?></div></td>
						
						<td><div class="descripcion"><i><?php echo $fila["DESCRIPCION"]; ?></i></div></td>
						
						<td><input class="precio_pro" name="precio_pro" type="text" value="<?php echo $fila["PRECIO_PRO"]; ?>"/>€</td>
					
					<?php }	else { ?>
						<!-- mostrando precio-->

						<td><div class="nombre_pro"><?php echo $fila["NOMBRE_PRO"]; ?></div></td>
						
						<td><div class="descripcion"><i><?php echo $fila["DESCRIPCION"]; ?></i></div></td>	
						
						<td><div class="precio_pro"><?php echo $fila["PRECIO_PRO"]."€"; ?></div></td>

					<?php } ?>

					<?php if(isset($_SESSION["datosEmpleado"])){ ?>
						<div id="botones_fila">
						<?php if (isset($producto) and ($producto["OID_PRO"] == $fila["OID_PRO"])) { ?>
							<td><button id="guardar" name="guardar" type="submit" class="editar_fila">
								<img src="img/guardar.png" class="editar_fila" alt="Guardar modificación">
							</button></td>
						<?php } else {?>
							<td><button id="editar" name="editar" type="submit" class="editar_fila">
								<img src="img/editar.png" class="editar_fila" alt="Editar producto">
							</button></td>
						<?php } ?>
							<td><button id="borrar" name="borrar" type="submit" class="editar_fila">
								<img src="img/eliminar.png" class="editar_fila" alt="Borrar producto">
							</button></td>
						</div>
					<?php } ?>
					</tr>
					</table>
					<hr>
				
				</div>
			</form>
		</article>
		
		<?php } ?>
	</main>

<?php
	include_once("pie.php");
?>
</body>
</html>