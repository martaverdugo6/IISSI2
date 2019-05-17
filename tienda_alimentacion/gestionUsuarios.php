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

	function consultarEmpleado($conexion,$email,$pass) {
		$consulta = "SELECT COUNT(*) AS TOTAL FROM EMPLEADO
			WHERE email_emp =:email AND pass_emp =:pass";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':email', $email);
		$stmt -> bindParam(':pass', $pass);
		$stmt -> execute();
		return $stmt->fetchColumn();
	}

	function datosUsuario($conexion, $email){
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

	function datosEmpleado($conexion, $email){
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
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
 ?>