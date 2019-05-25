<?php

	session_start();

	require_once("gestionBD.php");
	require_once("gestionUsuarios.php");

	if (isset($_SESSION["datosUsuario"])) {			//Comprobar que se ha hecho login
		$datosUsuario = $_SESSION["datosUsuario"];	
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

	<form method="post" action="controlador_usuario.php">

		<div>
			<?php if(isset($_SESSION['usuario'])){ ?>
				<button id="editarDatosMiCuenta" name="guardar" type="submit" class="guardar_datos">
					Guardar datos
				</button>
				<button id="editarDatosMiCuenta" name="cancelar" type="submit">Cancelar</button>
			<?php }else{ ?>
				<button id="editarDatosMiCuenta" name="editar" type="submit" class="editar_datos">
					Editar datos personales
				</button>
			<?php } ?>
		</div>
	
		<div id="datosMiCuenta">
			<input id="OID_CLI" name="OID_CLI" type="hidden" value="<?php echo $datosUsuario['OID_CLI']; ?> "/>
			<?php if(isset($_SESSION['usuario'])){ ?>
			<ul>
			<!--EDITANDO DATOS USUARIOS-->	
				<li><b>Nombre: </b><input id="NOMBRE_CLI" name="NOMBRE_CLI" type="text" value="<?php echo $datosUsuario['NOMBRE_CLI']; ?>"/></li>
				<li><b>Apellidos: </b><input id="APELLIDOS_CLI" name="APELLIDOS_CLI" type="text" value="<?php echo $datosUsuario['APELLIDOS_CLI']; ?>"/></li>
				<li><b>DNI: </b><input id="DNI_CLI" name="DNI_CLI" type="text" value="<?php echo $datosUsuario['DNI_CLI']; ?>"/></li>
				<li><b>E-mail: </b><input id="EMAIL_CLI" name="EMAIL_CLI" type="text" value="<?php echo $datosUsuario['EMAIL_CLI']; ?>"/></li>
				<li><b>Sexo: </b></li>
				<div id="editar_sexo_usuario">
					<label><input name="SEXO_CLI" type="radio" value="Femenino" <?php if($datosUsuario['SEXO_CLI']=='Femenino') echo ' checked ';?>/>Femenino</label>
					<label><input name="SEXO_CLI" type="radio" value="Masculino" <?php if($datosUsuario['SEXO_CLI']=='Masculino') echo ' checked ';?>/>Masculino</label>
					<label><input name="SEXO_CLI" type="radio" value="Sin especificar" <?php if($datosUsuario['SEXO_CLI']=='Sin especificar') echo ' checked ';?>/>Sin especificar</label>
				</div>
				<li><b>Fecha de Nacimiento: </b><input id="FECHA_NACIMIENTO_CLI" name="FECHA_NACIMIENTO_CLI" type="date" value="<?php echo getFechaFormateada($datosUsuario['FECHA_NACIMIENTO_CLI']); ?>"/></li>
				<li><b>Teléfono: </b><input id="TELEFONO_CLI" name="TELEFONO_CLI" type="text" value="<?php echo $datosUsuario['TELEFONO_CLI']; ?>"/></li>
				<li><b>Dirección: </b><input id="DIRECCION_CLI" name="DIRECCION_CLI" type="text" value="<?php echo $datosUsuario['DIRECCION_CLI']; ?>"/></li>
				<li><b>Contraseña: </b><input id="PASS_CLI" name="PASS_CLI" type="password" value="<?php echo $datosUsuario['PASS_CLI']; ?>"/></li>
				<li><b>Confirmar contraseña: </b><input id="CONF_PASS_EMP" name="CONF_PASS_CLI" type="password" value="<?php echo $datosUsuario['PASS_CLI']; ?>"/></li>
			</ul>
			
			<?php }else{ ?>
			<!--MOSTRANDO DATOS USUARIOS-->
			<ul>	
				<li><b>Nombre: </b><?php echo $datosUsuario['NOMBRE_CLI']; ?></li>
				<li><b>Apellidos: </b><?php echo $datosUsuario['APELLIDOS_CLI']; ?></li>	
				<li><b>DNI: </b><?php echo $datosUsuario['DNI_CLI']; ?></li>
				<li><b>E-mail: </b><?php echo $datosUsuario['EMAIL_CLI']; ?></li>
				<li><b>Sexo: </b><?php echo $datosUsuario['SEXO_CLI']; ?></li>
				<li>
					<b>Fecha de Nacimiento: </b><?php echo getFechaFormateada($datosUsuario['FECHA_NACIMIENTO_CLI']);?>
				</li>
				<li><b>Teléfono: </b><?php echo $datosUsuario['TELEFONO_CLI']; ?></li>
				<li><b>Dirección: </b><?php echo $datosUsuario['DIRECCION_CLI']; ?></li>
			
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
