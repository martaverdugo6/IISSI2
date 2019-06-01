<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php 

	session_start();

	if(!isset($_SESSION["datosEmpleado"])){		//Solo podemos entrar aquí si se ha iniciado sesión como empleado
		header("Location: login.php");
	}

	if (!isset($_SESSION['creandoOferta'])) {
		$creandoOferta['DESCUENTO'] = "";
		$creandoOferta['FECHA_INICIO'] = "";
		$creandoOferta['FECHA_FIN'] = "";
		$creandoOferta['OID_PRO'] = "";
	
		$_SESSION['creandoOferta'] = $creandoOferta;
	}
	// Si ya existían valores, los cogemos para inicializar el creandoOferta
	else{
		$creandoOferta = $_SESSION['creandoOferta'];
		
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
	<title>Tienda de Alimentación: Crear oferta</title>
</head>
<body>
	<div id="vueltaAtras">
		<i class="fas fa-angle-left"></i><a title="Volver atrás" href="opciones_empleado.php">Volver</a>
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
<form id="crearOferta" method="POST" action="validacion_crear_oferta.php" novalidate>
	<fieldset>
		<legend>Nueva Oferta</legend>
		<ul id="nuevaOferta">
			<li>
				<p>Descuento:</p>
				<input id="DESCUENTO" type="text" name="DESCUENTO" value="<?php echo $creandoOferta['DESCUENTO'];?>" required/>%
			</li>
			<li>
				<p>Fecha inicio:</p>
				<input id="FECHA_INICIO" type="date" name="FECHA_INICIO" value="<?php echo $creandoOferta['FECHA_INICIO'];?>" required/>
			</li>
			<li>
				<p>Fecha fin:</p>
				<input id="FECHA_FIN" type="date" name="FECHA_FIN" value="<?php echo $creandoOferta['FECHA_FIN'];?>" required/>
			</li>
			<li>
				<p>OID del producto:</p>
				<input id="OID_PRO" type="text" name="OID_PRO" value="<?php echo $creandoOferta['OID_PRO'];?>" required/>
			</li>
			<li>
				<input class="añadirOferta" type="submit" name="submit" value="Crear" />
			</li>
		</ul>
	</fieldset>
</form>
</body>
</html>