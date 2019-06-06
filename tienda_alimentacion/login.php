<?php
	session_start();

  	include_once("gestionBD.php");
 	include_once("gestionUsuarios.php");

 	// SI HAY INFORMACIÓN EN $_POST ENTONCES ES QUE 
	// YA SE HA INTRODUCIDO PREVIAMENTE EMAIL Y PASS
	// ENTONCES:

	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$pass = $_POST['pass'];

		$_SESSION["login"] = $email;

		$conexion = crearConexionBD();

		$num_usuarios = consultarUsuario($conexion, $email, $pass);
		$num_empleados = consultarEmpleado($conexion, $email, $pass);


		if($num_usuarios ==0 && $num_empleados==0){		//Si no hay usuarios con ese email y pass, 																						error 
			$login="error";
		}else if($num_usuarios!=0){		//Si existe el usuario y el pass, vamos para dentro													
			$_SESSION["datosUsuario"] = datosUsuario($conexion, $email);
			Header("Location: cuenta_usuario.php");		//el login nos dirige al perfil del usuario
		}else{
			$_SESSION["datosEmpleado"] = datosEmpleado($conexion, $email);
			Header("Location: cuenta_empleado.php");
		}
		cerrarConexionBD($conexion);
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<script src="js/validacion_email_login.js" type="text/javascript"></script>
	<title>Tienda de Alimentación: Login</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
<main>    
	<?php if (isset($login)) {
		echo "<div class=\"error\">";
		echo "Contraseña o usuario no validos.";
		echo "</div>";
	}
	?>
	<form action = "login.php" id="inicioSesion" method = "POST" onsubmit="return validateEmailLogin()" >
		<p><i>Los campos marcados con asterisco ( <em>*</em> ) son obligatorios </i></p>
		
		<fieldset><legend><h2>Inicio de sesión</h2></legend>
		
			<div>
				<label for="email">Cuenta de acceso:<em>*</em></label>
				<input type="email" name="email" id="idCuentaAcceso"  oninput="validacionEmailLogin()" placeholder="Introducir email" size="50" required/>
			</div>
			
			<div>
				<label for="contraseña">Contraseña:<em>*</em></label>
				<input type="password" name="pass" id="idContraseñaAcceso" placeholder="Mínimo 8 caracteres" size="50" required/>
			</div>
			
			<div class="entrar">
				<input class="botonEntrar" type="submit" name="submit" value="Entrar"/>
			</div>
			<div class="noCuenta">
				<a href="alta_usuario.php">No tengo cuenta de acceso</a>
			</div>	
		</fieldset>
	</form>	
</main>
<?php
	include_once("pie.php");
?>
</body>
</html>