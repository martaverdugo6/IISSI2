<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php 

	session_start();

	if(!isset($_SESSION["datosEmpleado"])){		//Solo podemos entrar aquí si se ha iniciado sesión como empleado
		header("Location: login.php");
	}
	
	if (!isset($_SESSION['creandoProd'])) {
		$creandoProd['nombre'] = "";
		$creandoProd['descripcion'] = "";
		$creandoProd['stock'] = "";
		$creandoProd['precio'] = "";
		$creandoProd['categoria'] = "";
	
		$_SESSION['creandoProd'] = $creandoProd;
	}
	// Si ya existían valores, los cogemos para inicializar el creandoProd
	else{
		$creandoProd = $_SESSION['creandoProd'];
	}
	// Si hay errores de validación, hay que mostrarlos y marcar los campos
	if (isset($_SESSION['errores'])){
		$errores = $_SESSION['errores'];
	}


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<script src="js/validacion_alta_producto.js" type="text/javascript"></script>
	<title>Tienda de Alimentación: Crear producto</title>
</head>
<body>
	<div id="vueltaAtras">
		<i class="fas fa-angle-left"></i><a title="Volver atrás" href="consulta_productos.php">Volver</a>
	</div>
	<?php 
	// Mostrar los erroes de validación (Si los hay)
	if (isset($errores) && count($errores)>0) { 
    	echo "<div id=\"div_errores\" class=\"error\">";
		echo "<h4> Errores en el registro:</h4>";
		foreach($errores as $error) echo $error; 
		echo "</div>";
		}
	?>
<form id="crearProd" method="POST" action="validacion_crear_producto.php" onsubmit="return validateProducto()">
	<fieldset>
		<legend>Nuevo producto</legend>
		<ul id="nuevoProducto">
			<li>
				<p>Nombre:</p>
				<input id="nombreProd" type="text" name="nombre" oninput="validacionNombreProducto();" value="<?php echo $creandoProd['nombre'];?>"/>
			</li>
			<li>
				<p>Descripción:</p>
				<input id="descripcionProd" type="text" name="descripcion" value="<?php echo $creandoProd['descripcion'];?>"/>
			</li>
			<li>
				<p>Stock:</p>
				<input id="idStockProd" type="text" name="stock"  oninput="validacionStock();" value="<?php echo $creandoProd['stock'];?>"/>
			</li>
			<li>
				<p>Precio:</p>
				<input id="idPrecioProd" type="text" name="precio" oninput="validacionPrecioProducto();" value="<?php echo $creandoProd['precio'];?>"/>
			</li>
			<li>
				<p>Categoria:</p>
				<label><input id="idBebida" name="categoria" type="radio" oninput="validacionCategoriaProducto();" value="bebida" <?php if($creandoProd['categoria']=='bebida') echo ' checked ';?>/>Bebida</label>
				<label><input id="idAlcohol" name="categoria" type="radio" oninput="validacionCategoriaProducto();" value="alcohol" <?php if($creandoProd['categoria']=='alcohol') echo ' checked ';?>/>Alcohol</label>
				<label><input id="idCongelado" name="categoria" type="radio" oninput="validacionCategoriaProducto();" value="congelado" <?php if($creandoProd['categoria']=='congelado') echo ' checked ';?>/>Congelado</label>
				<label><input id="idConfiteria" name="categoria" type="radio" oninput="validacionCategoriaProducto();" value="confiteria" <?php if($creandoProd['categoria']=='confiteria') echo ' checked ';?>/>Confiteria</label>
				<label><input id="idGolosina" name="categoria" type="radio" oninput="validacionCategoriaProducto();" value="golosina" <?php if($creandoProd['categoria']=='golosina') echo ' checked ';?>/>Golosina</label>
			</li>
			<li>
				<input class="añadirProducto" type="submit" name="submit" value="Crear" />
			</li>
		</ul>
	</fieldset>
</form>
</body>
</html>