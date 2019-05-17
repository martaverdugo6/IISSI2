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

?>