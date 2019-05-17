<?php	
	session_start();
	
	if (isset($_REQUEST["OID_OFE"])){
		$oferta["OID_OFE"] = $_REQUEST["OID_OFE"];	
		$oferta["DESCUENTO"] = $_REQUEST["DESCUENTO"];	
		$oferta["FECHA_INICIO"] = $_REQUEST["FECHA_INICIO"];
		$oferta["FECHA_FIN"] = $_REQUEST["FECHA_FIN"];
		$_SESSION["oferta"] = $oferta;
			
		if (isset($_REQUEST["editar"])) Header("Location: consulta_ofertas.php"); 
		if (isset($_REQUEST["guardar"])) Header("Location: accion_modificar_oferta.php");
		if (isset($_REQUEST["borrar"])) Header("Location: accion_eliminar_oferta.php"); 
	}
	else 
		Header("Location: consulta_ofertas.php");

?>