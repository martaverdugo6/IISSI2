<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php 

	session_start();
	
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
	<title>Tienda de Alimentación: crear producto</title>
</head>
<body>
	<i class="fas fa-angle-left"></i><a href="consulta_productos.php">Volver</a>
	
	<?php 
	// Mostrar los erroes de validación (Si los hay)
	if (isset($errores) && count($errores)>0) { 
    	echo "<div id=\"div_errores\" class=\"error\">";
		echo "<h4> Errores en el registro:</h4>";
		foreach($errores as $error) echo $error; 
		echo "</div>";
		}
	?>
<form id="crearProd" method="POST" action="validacion_crear_producto.php" novalidate>
	<ul>
		<li>
			<p>Nombre:</p>
			<input id="nombre" type="text" name="nombre" value="<?php echo $creandoProd['nombre'];?>" required/>
		</li>
		<li>
			<p>Descripción:</p>
			<input id="descripcion" type="text" name="descripcion" value="<?php echo $creandoProd['descripcion'];?>" required/>
		</li>
		<li>
			<p>Stock:</p>
			<input id="stock" type="text" name="stock" value="<?php echo $creandoProd['stock'];?>" required/>
		</li>
		<li>
			<p>Precio:</p>
			<input id="precio" type="text" name="precio" value="<?php echo $creandoProd['precio'];?>" required/>
		</li>
		<li>
			<p>Categoria:</p>
			<input name="categoria" type="radio" value="bebida" <?php if($creandoProd['categoria']=='Femenino') echo ' checked ';?>/>Bebida
			<input name="categoria" type="radio" value="alcohol" <?php if($creandoProd['categoria']=='Masculino') echo ' checked ';?>/>Alcohol
			<input name="categoria" type="radio" value="congelado" <?php if($creandoProd['categoria']=='Sin especificar') echo ' checked ';?>/>Congelado
			<input name="categoria" type="radio" value="confiteria" <?php if($creandoProd['categoria']=='Sin especificar') echo ' checked ';?>/>Confiteria
			<input name="categoria" type="radio" value="golosina" <?php if($creandoProd['categoria']=='Sin especificar') echo ' checked ';?>/>Golosina
		</li>
		<li>
			<input class="añadirProducto" type="submit" name="submit" value="Crear" />
		</li>
	</ul>
</form>
</body>
</html>