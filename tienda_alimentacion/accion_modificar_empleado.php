<?php	
	session_start();	

	if(isset($_SESSION["datosEmpleado"])){
		$datos = $_SESSION["datosEmpleado"];

		require_once("gestionBD.php");
		require_once("gestionUsuarios.php");

		$conexion = crearConexionBD();		
		$excepcion = modificar_empleados($conexion,$datos);

		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "cuenta_empleado.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: cuenta_empleado.php");

	}
?>