<?php

	session_start();

	require_once("gestionBD.php");
	require_once("gestionUsuarios.php");

	if(isset($_SESSION["datosEmpleado"])){
		$datosEmpleado = $_SESSION["datosEmpleado"];
	}else{
		Header("Location: login.php");			// EN OTRO CASO HAY QUE DERIVAR AL FORMULARIO
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
	<title>Tienda Alimentación: Mi cuenta</title>
</head>
<body>
<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>

<main>		
	<div id="MiPerfilMiCuenta">
		<h1>MI PERFIL</h1>
	</div>

	<form method="post" action="controlador_empleado.php">

		<div>
			<?php if(isset($_SESSION['empleado'])){ ?>
				<button id="editarDatosMiCuenta" name="guardar" type="submit" class="guardar_datos">
					Guardar datos
				</button>
			<?php }else{ ?>
				<button id="editarDatosMiCuenta" name="editar" type="submit" class="editar_datos">
					Editar datos personales
				</button>
			<?php } ?>
		</div>
	
		<div id="datosMiCuenta">
			<input id="OID_EMP" name="OID_EMP" type="hidden" value="<?php echo $datosEmpleado['OID_EMP']; ?>"/>
			<input id="OID_EMP" name="OID_EMP" type="hidden" value="<?php echo $datosEmpleado['OID_EMP']; ?>"/>
			<?php if(isset($_SESSION['empleado'])){ ?>
			<ul>
			<!--EDITANDO DATOS EMPLEADOS-->	
				<li><b>Nombre: </b><input id="NOMBRE_EMP" name="NOMBRE_EMP" type="text" value="<?php echo $datosEmpleado['NOMBRE_EMP']; ?>"/></li>
				<li><b>Apellidos: </b><input id="APELLIDOS_EMP" name="APELLIDOS_EMP" type="text" value="<?php echo $datosEmpleado['APELLIDOS_EMP']; ?>"/></li>
				<li><b>DNI: </b><input id="DNI_EMP" name="DNI_EMP" type="text" value="<?php echo $datosEmpleado['DNI_EMP']; ?>"/></li>
				<li><b>E-mail: </b><input id="EMAIL_EMP" name="EMAIL_EMP" type="text" value="<?php echo $datosEmpleado['EMAIL_EMP']; ?>"/></li>
				<li><b>Fecha de Nacimiento: </b><input id="FECHA_NACIMIENDO_EMP" name="FECHA_NACIMIENTO_EMP" type="text" value="<?php echo getFechaFormateada($datosEmpleado['FECHA_NACIMIENTO_EMP']); ?>"/></li>
				<li><b>Teléfono: </b><input id="TELEFONO_EMP" name="TELEFONO_EMP" type="text" value="<?php echo $datosEmpleado['TELEFONO_EMP']; ?>"/></li>
				<li><b>Contraseña: </b><input id="PASS_EMP" name="PASS_EMP" type="password" value="<?php echo $datosEmpleado['PASS_EMP']; ?>"/></li>
				<li><b>Confirmar contraseña: </b><input id="CONF_PASS_EMP" name="CONF_PASS_EMP" type="password" value="<?php echo $datosEmpleado['PASS_EMP']; ?>"/></li>
			</ul>
			
			<?php }else{ ?>
			
			<ul>
			<!--MOSTRANDO DATOS EMPLEADOS-->
				<li><b>Nombre: </b><?php echo $datosEmpleado['NOMBRE_EMP']; ?></li>
				<li><b>Apellidos: </b><?php echo $datosEmpleado['APELLIDOS_EMP']; ?></li>	
				<li><b>DNI: </b><?php echo $datosEmpleado['DNI_EMP']; ?></li>
				<li><b>E-mail: </b><?php echo $datosEmpleado['EMAIL_EMP']; ?></li>
				<li>
					<b>Fecha de Nacimiento: </b><?php echo getFechaFormateada($datosEmpleado['FECHA_NACIMIENTO_EMP']);?>
				</li>
				<li><b>Teléfono: </b><?php echo $datosEmpleado['TELEFONO_EMP']; ?></li>
			
			</ul>
			<?php } ?>
		</div>

	</form>		
</main>
<?php
	include_once("pie.php");
?>
</body>
</html>
<?php
	cerrarConexionBD($conexion);			// DESCONECTAR LA BASE DE DATOS
?>
