<?php

	session_start();

	require_once("gestionBD.php");
	require_once("gestionUsuarios.php");

	if (isset($_SESSION["datosUsuario"])) {			//Comprobar que ha hecho login un usuario
		$datosUsuario = $_SESSION["datosUsuario"];	
	}else{
		Header("Location: login.php");			// EN OTRO CASO HAY QUE DERIVAR AL LOGIN
	}


	if(isset($_SESSION["usuario_mod"])){
		unset($datosUsuario);
		unset($_SESSION["datosUsuario"]);
		$datosUsuario = $_SESSION["usuario_mod"];
		$_SESSION["datosUsuario"] = $datosUsuario;
		unset($_SESSION["usuario_mod"]);
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
	<script src="js/validacion_cuenta_usuario.js" type="text/javascript"></script>
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

	<form method="post" action="controlador_usuario.php" onsubmit="return validateCuentaUsuario()">

		<!--<div>
			<?php if(isset($_SESSION['estoyEditandoUsuario'])){ ?>
				<button title="guardar datos" id="guardarDatosMiCuenta" name="guardar" type="submit" class="guardar_datos">
					Guardar datos
				</button>
				<button title="cancelar edición" id="cancelarDatosMiCuenta" name="cancelar" type="submit">Cancelar</button>
			<?php }else{ ?>
				<button title="editar datos" id="editarDatosMiCuenta" name="editar" type="submit" class="editar_datos">
					Editar datos personales
				</button>
			<?php } ?>
		</div>-->
	
		<div id="datosMiCuenta">
			<input id="OID_CLI" name="OID_CLI" type="hidden" value="<?php echo $datosUsuario['OID_CLI']; ?> "/>
			<input id="NOMBRE_CLI" name="NOMBRE_CLI" type="hidden" oninput="validacionNombreUsuario();" value="<?php echo $datosUsuario['NOMBRE_CLI'];?>"/>
			<input id="APELLIDOS_CLI" name="APELLIDOS_CLI" type="hidden" oninput="validacionApellidosUsuario();" value="<?php echo $datosUsuario['APELLIDOS_CLI']; ?> "/>
			<input id="DNI_CLI" name="DNI_CLI" type="hidden" value="<?php echo $datosUsuario['DNI_CLI'];?>"/>
			<input id="EMAIL_CLI" name="EMAIL_CLI" type="hidden" value="<?php echo $datosUsuario['EMAIL_CLI'];?>"/>
			<input id="SEXO_CLI" name="SEXO_CLI" type="hidden" value="<?php echo $datosUsuario['SEXO_CLI'];?>"/>
			<input id="FECHA_NACIMIENTO_CLI" name="FECHA_NACIMIENTO_CLI" type="hidden" value="<?php echo getFechaFormateada($datosUsuario['FECHA_NACIMIENTO_CLI']);?>"/>
			<input id="TELEFONO_CLI" name="TELEFONO_CLI" type="hidden" oninput="validacionTelefono()" value="<?php echo $datosUsuario['TELEFONO_CLI'];?>"/>
			<input id="DIRECCION_CLI" name="DIRECCION_CLI" type="hidden" value="<?php echo $datosUsuario['DIRECCION_CLI'];?>"/>
			<input id="PASS_CLI" name="PASS_CLI" type="hidden" value="<?php echo $datosUsuario['PASS_CLI'];?>"/>

			<?php if(isset($_SESSION['estoyEditandoUsuario'])){ ?>
			<ul>
			<!--EDITANDO DATOS USUARIOS-->	
				<li><b>Nombre: </b><input id="NOMBRE_CLI" name="NOMBRE_CLI" type="text" oninput="validacionNombreUsuario();" value="<?php echo $datosUsuario['NOMBRE_CLI'];?>"/></li>
				<li><b>Apellidos: </b><input id="APELLIDOS_CLI" name="APELLIDOS_CLI" type="text" oninput="validacionApellidosUsuario();" value="<?php echo $datosUsuario['APELLIDOS_CLI'];?>"/></li>
				<li><b>DNI: </b><?php echo $datosUsuario['DNI_CLI']; ?></li>
				<li><b>E-mail: </b><?php echo $datosUsuario['EMAIL_CLI']; ?></li>
				<li><b>Sexo: </b><?php echo $datosUsuario['SEXO_CLI']; ?></li>
				<li>
					<b>Fecha de Nacimiento: </b><?php echo getFechaFormateada($datosUsuario['FECHA_NACIMIENTO_CLI']);?>
				</li>
				<li><b>Teléfono: </b><input id="TELEFONO_CLI" name="TELEFONO_CLI" type="text" oninput="validacionTelefono()" value="<?php echo $datosUsuario['TELEFONO_CLI'];?>"/></li>
				<li><b>Dirección: </b><input id="DIRECCION_CLI" name="DIRECCION_CLI" type="text" value="<?php echo $datosUsuario['DIRECCION_CLI'];?>"/></li>
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
