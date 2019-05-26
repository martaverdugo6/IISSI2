<?php 

	session_start();
	
	if (!isset($_SESSION['formulario'])) {
		$formulario['nombre'] = "";
		$formulario['apellidos'] = "";
		$formulario['dni'] = "";
		$formulario['fechaNacimiento'] = "";
		$formulario['email'] = "";
		$formulario['sexo'] = "sinEspecificar";
		$formulario['telefono'] = "";
		$formulario['direccion'] = "";
		$formulario['pass'] = "";
	
		$_SESSION['formulario'] = $formulario;
	}
	// Si ya existían valores, los cogemos para inicializar el formulario
	else{
		$formulario = $_SESSION['formulario'];
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
	<title>Tienda de Alimentación: alta usuario</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>

	<?php 
		// Mostrar los erroes de validación (Si los hay)
		if (isset($errores) && count($errores)>0) { 
	    	echo "<div id=\"div_errores\" class=\"error\">";
			echo "<h4> Errores en el registro:</h4>";
    		foreach($errores as $error) echo $error; 
    		echo "</div>";
  		}
	?>
	<form id="altaUsuario" method="get" action="validacion_alta_usuario.php" novalidate>
			<p><i>Los campos marcados con asterisco ( <em>*</em> ) son obligatorios </i></p>		
			<fieldset>
				<legend><h2>Nuevo usuario</h2></legend>

				<ul class=datosUsuario>
					<div>
					<label for="nombre">Nombre:<em>*</em></label>
					<input id="nombre" name="nombre" type="text" size="40" value="<?php echo $formulario['nombre'];?>" required/>
					</div>

					<div>
					<label for="apellidos">Apellidos:<em>*</em></label>
					<input id="apellidos" name="apellidos" type="text" size="50" value="<?php echo $formulario['apellidos'];?>" required/>
					</div>

					<div>
					<label for="dni">DNI:<em>*</em></label>
					<input id="dni" name="dni" type="text" placeholder="12345678Z" pattern="^[0-9]{8}[A-Z]" 	title="Ocho dígitos seguidos de una letra mayúscula" value="<?php echo $formulario['dni'];	?>" required>
					</div>

					<div>
					<label for="fechaNacimiento">Fecha de nacimiento:</label>
					<input type="date" name="fechaNacimiento" id="fechaNacimiento" value="<?php echo $formulario['fechaNacimiento'];?>" required/>
					</div>

					<div>
					<label for="email">Email:<em>*</em></label>
					<input id="email" name="email"  type="email" placeholder="usuario@dominio.extension" 
										size="40" value="<?php echo $formulario['email'];?>" required/>
					</div>

					<div class="sexo">
					<label>Sexo:</label>
					<label><input name="sexo" type="radio" value="Femenino" <?php if($formulario['sexo']=='Femenino') echo ' checked ';?>/>Femenino</label>
					<label><input name="sexo" type="radio" value="Masculino" <?php if($formulario['sexo']=='Masculino') echo ' checked ';?>/>Masculino</label>
					<label><input name="sexo" type="radio" value="Sin especificar" <?php if($formulario['sexo']=='Sin especificar') echo ' checked ';?>/>Sin especificar</label>
					</div>

					<div>
					<label for="telefono">Teléfono:</label>
					<input id="telefono" name="telefono" type="text" size="40" value="<?php echo $formulario['telefono'];?>" required/>
					</div>
	
					<div>
					<label for="direccion">Dirección:</label>
					<input id="direccion" name="direccion" type="text" size="40" value="<?php echo $formulario['direccion'];?>" required/>
					</div>

					<div>
					<label for="pass">Contraseña:<em>*</em></label>
					<input id="pass" name="pass" type="password" size="50" placeholder="Mínimo 8 caracteres entre mayúsculas, minusculas y dígitos" required />
					</div>

					<div>
					<label for="confirmpass">Confirmar contraseña: </label>
					<input id="confirmpass" name="confirmpass" type="password" size="40"
									placeholder="Confirmación de contraseña" required />
					</div>

				</ul>
				<input class="registrarse" type="submit" name="submit" value="Enviar" />

			</fieldset>

	</form>

<?php
	include_once("pie.php");
?>
</body>
</html>