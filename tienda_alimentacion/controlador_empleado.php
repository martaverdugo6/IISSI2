<?php	
	session_start();

	if(isset($_REQUEST["OID_EMP"])){
		$empleado_mod["NOMBRE_EMP"] = $_REQUEST["NOMBRE_EMP"];
		$empleado_mod["APELLIDOS_EMP"] = $_REQUEST["APELLIDOS_EMP"];
		$empleado_mod["DNI_EMP"] = trim($_REQUEST["DNI_EMP"]);			//trim para quitar el espacio del final del dni
		$empleado_mod["FECHA_NACIMIENTO_EMP"]= $_REQUEST["FECHA_NACIMIENTO_EMP"];
		$empleado_mod["EMAIL_EMP"]= $_REQUEST["EMAIL_EMP"];
		$empleado_mod["TELEFONO_EMP"]= $_REQUEST["TELEFONO_EMP"];
		$empleado_mod["SALARIO"]= $_REQUEST["SALARIO"];
		$empleado_mod["PASS_EMP"]= $_REQUEST["PASS_EMP"];
		$empleado_mod["OID_EMP"]= $_REQUEST["OID_EMP"];

		$_SESSION["empleado_mod"] = $empleado_mod;		//en $_SESSION['empleado_mod'] se guardan los datos del usuario que vienen de cuenta_usuario.php

		if (isset($_REQUEST["editar"])){		//Se ha pulsado el boton editar datos empleado
			$_SESSION['estoyEditandoEmpleado'] = true;	//Se crea la variable "estoyEditandoEmpleado"
			Header("Location: Location: cuenta_empleado.php");
		}
		if (isset($_REQUEST["guardar"])){		//Se quieren guardar los datos editados
			unset($_SESSION["estoyEditandoEmpleado"]);
			Header("Location: accion_modificar_empleado.php");
		}
		if (isset($_REQUEST["cancelar"])){		//Se quiere cancelar la edición
			unset($_SESSION['estoyEditaestoyEditandoEmpleadondo']);
			Header("Location: cuenta_empleado.php");
		}
	}else 
		Header("Location: cuenta_empleado.php");

?>