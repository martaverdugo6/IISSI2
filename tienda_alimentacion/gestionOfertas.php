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
		$stmt=$conexion->prepare('CALL MODIFICAR_DESCUENTO_OFE(:OID_oferta, :descuento)');
		$stmt -> bindParam(':OID_oferta', $OID_oferta);
		$stmt -> bindParam(':descuento', $descuento);
		$stmt->execute();
		return "";
	} catch(PDOException $e) {
		return $e->getMessage();
    }
}

function crear_oferta($conexion, $oferta){
	$fechaI = date('d/m/y', strtotime($oferta['FECHA_INICIO']));
	$fechaF = date('d/m/y', strtotime($oferta['FECHA_FIN']));
	try{
		$consulta = "CALL INSERTAR_OFERTA(:des, :fechaI, :fechaF, :oid_pro)";
		$stmt = $conexion -> prepare($consulta);
		$stmt -> bindParam(':des', $oferta['descuento']);		//Lo que va detras de los dos puntos debe
																//tener siempre el mismo nombre
		$stmt -> bindParam(':fechaI', $fechaI);
		$stmt -> bindParam(':fechaF', $fechaF);
		$stmt -> bindParam(':oid_pro', $oferta['oid_pro']);
		$stmt -> execute();
		return true;
	}catch(PDOException $oops){
		//TODO //Solo para depurar, después quitar
		echo $oops -> getMessage();
		return false;
	}
}

/*function OID_pro_en_oferta($conexion, ){
	$query2 = "SELECT producto.nombre_pro FROM producto WHERE producto.oid_pro = ".$fila["OID_PRO"];
	$stmt = $conexion -> prepare($query2);
	$stmt->execute();
	$nombreProducto = $stmt -> fetch(PDO:: FETCH_ASSOC);
}*/
?>