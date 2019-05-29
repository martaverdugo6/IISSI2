<?php

	session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Tienda de Alimentación: Sobre nosotros</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
<main>
	<div id= "sobre_nosotros">
		<h1>Sobre nosotros</h1>
		
			<p>Situados en la <b>avenida Reina Mercedes nº3</b>,esta tienda de alimentación lleva más de 30 años ofreciendo productos de alimentación a sus clientes.Desde el principio hemos intentamos ofrecer a nuestros clientes productos de la más alta calidad al mejor.</p>
			<p>Se puede decir que somos la tienda de toda la vida, la que trata de ofrecer, además de los mejores productos, esa cercanía con sus clientes típica de este tipo de establecimientos.</p>
			<p>Siempre estamos abiertos a sugerencias y nuevas solicitudes que nos hagas llegar. Si no encuentras algo en nuestra tienda - ¡escríbanos! Lo buscaremos para ti.</p>
			<div id="imagenes_sobre_nosotros">
				<img id="img_establecimiento" src="img/establecimiento.jpg" />	
				<img id="img_cajera" src="img/cajeras.jpg" />
				<img id="img_carrito" src="img/carrito.jpg" />
			</div>
	</div>
</main>
	

<?php
	include_once("pie.php");
?>
</body>
</html>