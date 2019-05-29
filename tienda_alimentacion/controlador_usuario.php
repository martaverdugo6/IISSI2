<?php	
	session_start();

	if (isset($_REQUEST["OID_CLI"])){
		$usuario_mod["NOMBRE_CLI"] = $_REQUEST["NOMBRE_CLI"];
		$usuario_mod["APELLIDOS_CLI"] = $_REQUEST["APELLIDOS_CLI"];
		$usuario_mod["DNI_CLI"] = trim($_REQUEST["DNI_CLI"]);			//trim para quitar el espacio del final del dni
		$usuario_mod["FECHA_NACIMIENTO_CLI"]= $_REQUEST["FECHA_NACIMIENTO_CLI"];
		$usuario_mod["EMAIL_CLI"]= $_REQUEST["EMAIL_CLI"];
		$usuario_mod["SEXO_CLI"]= $_REQUEST["SEXO_CLI"];
		$usuario_mod["TELEFONO_CLI"]= $_REQUEST["TELEFONO_CLI"];
		$usuario_mod["DIRECCION_CLI"]= $_REQUEST["DIRECCION_CLI"];
		$usuario_mod["PASS_CLI"]= $_REQUEST["PASS_CLI"];
		$usuario_mod["OID_CLI"]= $_REQUEST["OID_CLI"];

		
		$_SESSION["usuario_mod"] = $usuario_mod;		//en $_SESSION['usuario_mod'] se guardan los datos del empleado que vienen de cuenta_empleado.php

		if (isset($_REQUEST["editar"])){		//Se ha pulsado el boton editar datos usuario
			$_SESSION['estoyEditandoUsuario'] = true;	//Se crea la variable "estoyEditandoUsuario"
			Header("Location: cuenta_usuario.php");
		}
		if (isset($_REQUEST["guardar"])){		//Se quieren guardar los datos editados
			unset($_SESSION["estoyEditandoUsuario"]);
			Header("Location: accion_modificar_usuario.php");
		}
		if (isset($_REQUEST["cancelar"])){		//Se quiere cancelar la edición
			unset($_SESSION['estoyEditandoUsuario']);
			Header("Location: cuenta_usuario.php");
		}
	}
	else 
		Header("Location: cuenta_usuario.php");

?>