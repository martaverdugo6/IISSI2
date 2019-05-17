<?php

function consultarTodasOfertas($conexion) {
	$consulta = "SELECT * FROM OFERTA ORDER BY fecha_fin";
		
	try {
	    return $conexion->query($consulta);
	}catch(PDOException $e){
		$_SESSION['excepcion'] = $e->GetMessage();
		header("Location: excepcion.php");
	}	
}

function eliminar_oferta($conexion,$OID_ofe) {
	try {
		$stmt=$conexion->prepare('CALL ELIMINAR_OFERTA(:OID_ofe)');
		$stmt->bindParam(':OID_ofe',$OID_ofe);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function modificar_descuento($conexion, $OID_oferta, $descuento){
	try {
		$stmt=$conexion->prepare('CALL MODIFICAR_PRECIO_PRO(:OID_oferta, :descuento)');
		$stmt -> bindParam(':OID_producto', $OID_oferta);
		$stmt -> bindParam(':precio_pro', $descuento);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}
?>