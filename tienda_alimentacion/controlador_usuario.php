<?php	
	session_start();
	
	if (isset($_REQUEST["OID_CLI"])){
		$usuario["OID_CLI"]= $_REQUEST["OID_CLI"];
		$_SESSION["usuario"] = $usuario;
			
		if (isset($_REQUEST["editar"])) Header("Location: cuenta_usuario.php");
		if (isset($_REQUEST["guardar"])) Header("Location: accion_modificar_usuario.php");
	
	}
	else 
		Header("Location: cuenta_usuario.php");

?>