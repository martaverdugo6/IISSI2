<?php	
	session_start();	
	
	if (isset($_SESSION["datosUsuario"])) {
		$datos = $_SESSION["datosUsuario"];

		require_once("gestionBD.php");
		require_once("gestionUsuarios.php");

		$conexion = crearConexionBD();		
		$excepcion = modificar_usuarios($conexion,$datos);

		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "cuenta_usuario.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: cuenta_usuario.php");

	}
?>