<?php	
	session_start();	
	
	if (isset($_SESSION["oferta"])) {
		$oferta = $_SESSION["oferta"];
		unset($_SESSION["oferta"]);
		
		require_once("gestionBD.php");
		require_once("gestionOfertas.php");
		
		$conexion = crearConexionBD();		
		$excepcion = eliminar_oferta($conexion,$oferta["OID_OFE"]);
		cerrarConexionBD($conexion);
			
		if ($excepcion<>"") {
			$_SESSION["excepcion"] = $excepcion;
			$_SESSION["destino"] = "consulta_ofertas.php";
			Header("Location: excepcion.php");
		}
		else Header("Location: consulta_ofertas.php");
	}
	else Header("Location: consulta_ofertas.php"); // Se ha tratado de acceder directamente a este PHP
?>