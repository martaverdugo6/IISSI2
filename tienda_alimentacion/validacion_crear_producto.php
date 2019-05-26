<?php
	session_start();

		//Comprobar que hemos llegado aquí despues de rellenar los datos del producto
	if(isset($_SESSION['creandoProd'])){

		$nuevoProd['nombre'] = $_REQUEST['nombre'];
		$nuevoProd['descripcion'] = $_REQUEST['descripcion'];
		$nuevoProd['stock'] = $_REQUEST['stock'];
		$nuevoProd['precio'] = $_REQUEST['precio'];
		$nuevoProd['categoria'] = $_REQUEST['categoria'];
	
	}else{ // En caso contrario, vamos al formulario
		Header("Location: crear_producto.php");
	}

	// Guardar la variable local con los datos del formulario en la sesión.
	$_SESSION['nuevoProd']=$nuevoProd;

	// Validamos el formulario en servidor 
	$errores = validarDatosProducto($nuevoProd);

	if(count($errores)>0){
		// Guardo en la sesión los mensajes de error
		$_SESSION['errores'] = $errores;
		// Redirigimos al usuario al formulario
		Header("Location:crear_producto.php");
	}else{
		// Si NO se han detectado errores redirigimos al usuario a la página de éxito
		Header("Location:accion_crear_producto.php");
	}

	function validarDatosProducto($nuevoProd){
		
		// Validación del Nombre			
		if($nuevoProd["nombre"] == ""){
			$errores[] = "<p>El campo NOMBRE debe ser rellenado</p>";
		}

		// Validación de la descripción
		if($nuevoProd['descripcion'] == ""  ){
			$errores[] = "<p>El campo DESCRIPCIÓN debe ser rellenado</p>";
		}

		// Validación del stock
		if($nuevoProd['stock'] == ""  ){
			$errores[] = "<p>El campo STOCK debe ser rellenado</p>";
		}

		// Validación del precio
		if($nuevoProd['precio'] == ""  ){
			$errores[] = "<p>El campo PRECIO debe ser rellenado</p>";
		}
	
		// Validación de la categoria
		if($nuevoProd['categoria'] == ""  ){
			$errores[] = "<p>El campo CATEGORÍA debe ser rellenado</p>";
		}

		return $errores;
		
	}
?>