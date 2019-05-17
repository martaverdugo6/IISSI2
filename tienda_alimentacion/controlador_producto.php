<?php	
	session_start();
	
	if (isset($_REQUEST["OID_PRO"])){
		$producto["OID_PRO"] = $_REQUEST["OID_PRO"];
		$producto["NOMBRE_PRO"] = $_REQUEST["NOMBRE_PRO"];
		$producto["DESCRIPCION"] = $_REQUEST["DESCRIPCION"];
		$producto["PRECIO_PRO"] = $_REQUEST["PRECIO_PRO"];	
		$_SESSION["producto"] = $producto;
		

		if (isset($_REQUEST["editar"])) Header("Location: consulta_productos.php"); 
		if (isset($_REQUEST["guardar"])) Header("Location: accion_modificar_producto.php");
		if (isset($_REQUEST["borrar"])) Header("Location: accion_eliminar_producto.php"); 

	}else{
		Header("Location: consulta_productos.php");
	}
?>