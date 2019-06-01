<?php
	session_start();

		//Comprobar que hemos llegado aquí despues de rellenar los datos del producto
	if(isset($_SESSION['creandoOferta'])){

		$nuevaOferta['DESCUENTO'] = trim($_REQUEST['DESCUENTO']);
		$nuevaOferta['FECHA_INICIO'] = trim($_REQUEST['FECHA_INICIO']);
		$nuevaOferta['FECHA_FIN'] = trim($_REQUEST['FECHA_FIN']);
		$nuevaOferta['OID_PRO'] = trim($_REQUEST['OID_PRO']);
	
	}else{ // En caso contrario, vamos al formulario
		Header("Location: crear_oferta.php");
	}

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['nuevaOferta']=$nuevaOferta;

	// Validamos el formulario en servidor 
	$errores = validarDatosOferta($nuevaOferta);

	if(count($errores)>0){
		// Guardo en la sesión los mensajes de error
		$_SESSION['errores'] = $errores;
		// Redirigimos al usuario al formulario
		Header("Location:crear_oferta.php");
	}else{
		// Si NO se han detectado errores redirigimos al usuario a la página de éxito
		Header("Location:accion_crear_oferta.php");
	}

	function validarDatosOferta($nuevaOferta){
		
		// Validación del DESCUENTO			
		if($nuevaOferta["DESCUENTO"] == ""){
			$errores[] = "<p>El campo DESCUENTO debe ser rellenado</p>";
		}

		// Validación de la FECHA INICIO
		if($nuevaOferta['FECHA_INICIO'] == ""  ){
			$errores[] = "<p>El campo FECHA INICIO debe ser rellenado</p>";
		}

		// Validación de la FECHA FIN
		if($nuevaOferta['FECHA_FIN'] == ""  ){
			$errores[] = "<p>El campo FECHA FIN debe ser rellenado</p>";
		}
	
		// Validación del OID PRO
		if($nuevaOferta['OID_PRO'] == ""  ){
			$errores[] = "<p>El campo OID DEL PRODUCTO debe ser rellenado</p>";
		}

		return $errores;
		
	}
?>