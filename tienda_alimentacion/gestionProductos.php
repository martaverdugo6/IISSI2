<?php

function consultarTodosProductos($conexion) {
	$consulta = "SELECT * FROM PRODUCTO ORDER BY categoria";
		
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}

function eliminar_producto($conexion,$OID_pro) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_PRODUCTO(:OID_pro)');
		$stmt->bindParam(':OID_pro',$OID_pro);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function contarProdEnOferta($conexion,$OID_producto) {
	$consulta = "SELECT COUNT(*) AS TOTAL FROM OFERTA
		WHERE OID_pro =:OID_producto";
	$stmt = $conexion -> prepare($consulta);
	$stmt -> bindParam(':OID_producto', $OID_producto);
	$stmt -> execute();
	return $stmt->fetchColumn();
}

function modificar_precio($conexion, $OID_producto, $precio_pro){
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_PRECIO_PRO(:OID_producto, :precio_pro)');
		$stmt -> bindParam(':OID_producto', $OID_producto);
		$stmt -> bindParam(':precio_pro', $precio_pro);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function crear_producto($conexion, $producto){	
	try{
		$consulta = "CALL INSERTAR_PRODUCTO(:nom, :des, :stock, :pre, :cat)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':nom', $usuario['nombre']);		//Lo que va detras de los dos puntos debe
															//tener siempre el mismo nombre
		$stmt -> bindParam(':des', $usuario['apellidos']);
		$stmt -> bindParam(':stock', $usuario['dni']);
		$stmt -> bindParam(':pre', $usuario['email']);
		$stmt -> bindParam(':cat', $usuario['sexo']);
		$stmt -> execute();
		return true;
	}catch(PDOException $oops){
		//TODO //Solo para depurar, después quitar
		//echo $oops -> getMessage();
		return false;
	}
}

?>