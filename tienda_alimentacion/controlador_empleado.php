<?php	
	session_start();

	if(isset($_REQUEST["OID_EMP"])){
		$empleado["OID_EMP"]= $_REQUEST["OID_EMP"];
		$_SESSION["empleado"] = $empleado;

		if (isset($_REQUEST["editar"])) Header("Location: cuenta_empleado.php");
		if (isset($_REQUEST["guardar"])) Header("Location: accion_modificar_empleado.php");

	}else 
		Header("Location: cuenta_empleado.php");

?>