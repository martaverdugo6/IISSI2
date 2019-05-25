<?php	
	session_start();

	if (isset($_REQUEST["OID_CLI"])){
		$usuario["NOMBRE_CLI"] = $_REQUEST["NOMBRE_CLI"];
		$usuario["APELLIDOS_CLI"] = $_REQUEST["APELLIDOS_CLI"];
		$usuario["DNI_CLI"] = $_REQUEST["DNI_CLI"];
		$usuario["FECHA_NACIMIENTO_CLI"]= $_REQUEST["FECHA_NACIMIENTO_CLI"];
		$usuario["EMAIL_CLI"]= $_REQUEST["EMAIL_CLI"];
		$usuario["SEXO_CLI"]= $_REQUEST["SEXO_CLI"];
		$usuario["TELEFONO_CLI"]= $_REQUEST["TELEFONO_CLI"];
		$usuario["DIRECCION_CLI"]= $_REQUEST["DIRECCION_CLI"];
		$usuario["PASS_CLI"]= $_REQUEST["PASS_CLI"];
		$usuario["OID_CLI"]= $_REQUEST["OID_CLI"];

		$_SESSION["usuario"] = $usuario;		//en $_SESSION['usuario'] está guardado el OID del usuario
			
		
		if (isset($_REQUEST["editar"])) Header("Location: cuenta_usuario.php");
		if (isset($_REQUEST["guardar"])) Header("Location: accion_modificar_usuario.php");
		if (isset($_REQUEST["cancelar"])){
			unset($_SESSION['usuario']);
			Header("Location: cuenta_usuario.php");
		}
	}
	else 
		Header("Location: cuenta_usuario.php");

?>