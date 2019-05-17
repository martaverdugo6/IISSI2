<?php

	session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title> Tienda de Alimentación</title>
</head>
<body>
<?php
	include_once("cabecera.php");
	include_once("menu.php");
?>
<main>
	<div class="imagenIndex">
		<img src="img/alimentos.jpg" />	
	</div>
</main>	
<?php
	include_once("pie.php");
?>
</body>

</html>