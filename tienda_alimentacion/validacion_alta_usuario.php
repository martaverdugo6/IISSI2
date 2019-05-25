<?php
	session_start();

	//Comprobar que hemos llegado aquí despues de rellenar el formulario
	if(isset($_SESSION['formulario'])){

		$nuevoUsuario['nombre'] = $_REQUEST['nombre'];
		$nuevoUsuario['apellidos'] = $_REQUEST['apellidos'];
		$nuevoUsuario['dni'] = $_REQUEST['dni'];
		$nuevoUsuario['fechaNacimiento'] = $_REQUEST['fechaNacimiento'];
		$nuevoUsuario['email'] = $_REQUEST['email'];
		$nuevoUsuario['sexo'] = $_REQUEST['sexo'];
		$nuevoUsuario['telefono'] = $_REQUEST['telefono'];
		$nuevoUsuario['direccion'] = $_REQUEST['direccion'];
		$nuevoUsuario['pass'] = $_REQUEST['pass'];
		$nuevoUsuario['confirmpass'] = $_REQUEST['confirmpass'];
	
	}else{ // En caso contrario, vamos al formulario
		Header("Location: alta_usuario.php");
	}
	
	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['formulario']=$nuevoUsuario;

	// Validamos el formulario en servidor 
	$errores = validarDatosUsuario($nuevoUsuario);

	if(count($errores)>0){
		// Guardo en la sesión los mensajes de error
		$_SESSION['errores'] = $errores;
		// Redirigimos al usuario al formulario
		Header("Location:alta_usuario.php");
	}else{
		// Si NO se han detectado errores redirigimos al usuario a la página de éxito
		Header("Location:accion_alta_usuario.php");
	}

	// Formatear la fecha
	function getFechaFormateada($fecha){
		$fechaNacimiento = date('d/m/Y', strtotime($fecha));
		
		return $fechaNacimiento;
	}

	
	// Validación en servidor del formulario de alta de usuario

	function validarDatosUsuario($nuevoUsuario){
		
		// Validación del Nombre			
		if($nuevoUsuario["nombre"] == ""){
			$errores[] = "<p>El campo NOMBRE debe ser rellenado</p>";
		}

		// Validación de los apellidos
		if($nuevoUsuario['apellidos'] == ""  ){
			$errores[] = "<p>El campo APELLIDOS debe ser rellenado</p>";
		}
	
		// Validación del DNI
		if($nuevoUsuario['dni'] == ""){
			$errores[] = "</p>El campo DNI debe ser rellenado</p>";
		}else if(!preg_match("/^[0-9]{8}[A-Z]$/", $nuevoUsuario["dni"])){
		$errores[] = "<p>El DNI debe contener 8 números y una letra mayúscula: " . $nuevoUsuario["dni"]. "</p>";
		}
		
		// Validación del email
		if($nuevoUsuario['email'] == ""){
			$errores[] = "<p>El campo EMAIL debe ser rellenado</p>";
		}else if(!filter_var($nuevoUsuario['email'], FILTER_VALIDATE_EMAIL)){
			$errores[] = "<p>El formato del EMAIL no es valido: " . $nuevoUsuario['email']. "</p>";
		}

		// Validación de la contraseña
		if(!isset($nuevoUsuario['pass']) || strlen($nuevoUsuario['pass'])<8){
			$errores [] = "<p>CONTRASEÑA no válida: debe tener al menos 8 caracteres</p>";
		}else if(!preg_match("/[a-z]+/", $nuevoUsuario['pass']) || 
						!preg_match("/[A-Z]+/", $nuevoUsuario['pass']) || 
								!preg_match("/[0-9]+/", $nuevoUsuario['pass'])){

			$errores[] = "<p>CONTRASEÑA no válida: debe contener letras mayúsculas y minúsculas y 																					dígitos</p>";
		}else if($nuevoUsuario['pass'] != $nuevoUsuario['confirmpass']){
			$errores[] = "<p>La confirmación de contraseña no coincide con la contraseña</p>";
		}
	
		return $errores;
		
	}

?>