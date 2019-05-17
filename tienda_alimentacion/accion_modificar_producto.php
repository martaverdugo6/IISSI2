<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);
		
		require_once("gestionBD.php");
		require_once("gestionProductos.php");
		
		$conexion = crearConexionBD();		
		$excepcion = modificar_precio($conexion,$producto["OID_PRO"],$producto["PRECIO_PRO"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_productos.php";
			Header("Location: excepcion.php");
		}
		else
			Header("Location: consulta_productos.php");
	} 
	else Header("Location: consulta_productos.php"); // Se ha tratado de acceder directamente a este PHP
?>