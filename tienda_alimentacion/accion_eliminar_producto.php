<?php	
	session_start();	
	
	if (isset($_SESSION["producto"])) {
		$producto = $_SESSION["producto"];
		unset($_SESSION["producto"]);

		require_once("gestionBD.php");
		require_once("gestionProductos.php");
		
		$conexion = crearConexionBD();	
		
		$prodEnOferta = contarProdEnOferta($conexion,$producto["OID_PRO"]);

		if($prodEnOferta ==0){
			$excepcion = eliminar_producto($conexion,$producto["OID_PRO"]);
		}else{
			$_SESSION['errorBorrado'] = "No se puede borrar este producto porque pertenece a una oferta, se debe borrar antes la oferta";
			Header("Location: consulta_productos.php");
		}

		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_productos.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_productos.php");
	
	}
	else Header("Location: consulta_productos.php"); // Se ha tratado de acceder directamente a este PHP
	
?>