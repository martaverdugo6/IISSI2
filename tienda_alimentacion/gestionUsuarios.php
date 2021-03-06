<?php 

function alta_usuario($conexion, $usuario){	
	$fechaNacimiento = date('d/m/y', strtotime($usuario['fechaNacimiento']));	
	try{
		$consulta = "CALL INSERTAR_CLIENTE(:nom, :ape, :dni, :fec, :ema, :sex, :tel, :dir, :pass)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':nom', $usuario['nombre']);		//Lo que va detras de los dos puntos debe
															//tener siempre el mismo nombre
		$stmt -> bindParam(':ape', $usuario['apellidos']);
		$stmt -> bindParam(':dni', $usuario['dni']);
		$stmt -> bindParam(':fec', $fechaNacimiento);
		$stmt -> bindParam(':ema', $usuario['email']);
		$stmt -> bindParam(':sex', $usuario['sexo']);
		$stmt -> bindParam(':tel', $usuario['telefono']);
		$stmt -> bindParam(':dir', $usuario['direccion']);
		$stmt -> bindParam(':pass', $usuario['pass']);
		$stmt -> execute();
		return true;
	}catch(PDOException $oops){
		//TODO //Solo para depurar, después quitar
		//echo $oops -> getMessage();
		return false;
	}
}

function consultarUsuario($conexion,$email,$pass) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTE
		WHERE email_cli =:email AND pass_cli =:pass";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':email', $email);
	$stmt -> bindParam(':pass', $pass);
	$stmt -> execute();
	return $stmt->fetchColumn();
}

function usuarioRegistrado($conexion,$email) {			//Para saber si el email ya está registrado
	$consulta = "SELECT COUNT(*) AS TOTAL FROM CLIENTE
		WHERE email_cli =:email";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':email', $email);
	$stmt -> execute();
	return $stmt->fetchColumn();
}

function consultarEmpleado($conexion,$email,$pass) {		//Cuenta el número de empleados con ese email y pass
	$consulta = "SELECT COUNT(*) AS TOTAL FROM EMPLEADO
		WHERE email_emp =:email AND pass_emp =:pass";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':email', $email);
	$stmt -> bindParam(':pass', $pass);
	$stmt -> execute();
	return $stmt->fetchColumn();
}

function datosUsuario($conexion, $email){		//Para obtener los datos de un usuario logeado
	try{
		$consulta = "SELECT * FROM CLIENTE WHERE email_cli =: email";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
		return $stmt -> fetch(PDO:: FETCH_ASSOC);
	}catch(PDOException $oops){
		//TODO //Solo para depurar, después quitar
		//echo $oops -> getMessage();
		return false;
	}
}

function datosEmpleado($conexion, $email){		//Para obtener los datos de un empleado logeado
	try{
		$consulta = "SELECT * FROM EMPLEADO WHERE email_emp =: email";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':email', $email);
		$stmt -> execute();
		return $stmt -> fetch(PDO:: FETCH_ASSOC);
	}catch(PDOException $oops){
		//TODO //Solo para depurar, después quitar
		//echo $oops -> getMessage();
		return false;
	}
}
	
function modificar_usuarios($conexion,$usuario) {
	$fechaNacimiento = date('d/m/y', strtotime($usuario['fechaNacimiento']));
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_CLIENTE(:nom, :ape, :dni, :fec, :ema, :sex, :tel, :dir, :pass, :oid)');
		$stmt -> bindParam(':nom', $usuario['NOMBRE_CLI']);		//Lo que va detras de los dos puntos debe tener siempre el mismo nombre
		$stmt -> bindParam(':ape', $usuario['APELLIDOS_CLI']);
		$stmt -> bindParam(':dni', $usuario['DNI_CLI']);
		$stmt -> bindParam(':fec', $fechaNacimiento);
		$stmt -> bindParam(':ema', $usuario['EMAIL_CLI']);
		$stmt -> bindParam(':sex', $usuario['SEXO_CLI']);
		$stmt -> bindParam(':tel', $usuario['TELEFONO_CLI']);
		$stmt -> bindParam(':dir', $usuario['DIRECCION_CLI']);
		$stmt -> bindParam(':pass', $usuario['PASS_CLI']);
		$stmt -> bindParam(':oid', $usuario['OID_CLI']);
		$stmt->execute();

		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_empleados($conexion,$usuario) {
	print_r($usuario);
	die();
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_EMPLEADO(:nom, :ape, :dni, :fec, :sal, :ema, :tel, :pass, :oid)');
		$stmt -> bindParam(':nom', $usuario['nombre']);		//Lo que va detras de los dos puntos debe tener siempre el mismo nombre
		$stmt -> bindParam(':ape', $usuario['apellidos']);
		$stmt -> bindParam(':dni', $usuario['dni']);
		$stmt -> bindParam(':fec', $fechaNacimiento);
		$stmt -> bindParam(':sal', $usuario['salario']);
		$stmt -> bindParam(':ema', $usuario['email']);
		$stmt -> bindParam(':tel', $usuario['telefono']);
		$stmt -> bindParam(':pass', $usuario['pass']);
		$stmt -> bindParam(':oid', $usuario['oid']);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
function consultarTodosUsuario($conexion) {
	$consulta = "SELECT * FROM CLIENTE ORDER BY APELLIDOS_CLI";
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}
?>