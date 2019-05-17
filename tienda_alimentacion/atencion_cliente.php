<?php

	session_start();

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Tienda de Alimentación: Atención al cliente</title>
</head>
<body>
	<?php
		include_once("cabecera.php");
		include_once("menu.php");
	?>
<main>
	<div class=preguntasFrecuentes>
		<h1>Preguntas más frecuentes</h1>
		<h3>¿Cuál es el horario de apertura?</h3>
		<p>Nuestro horario es:
			<li id="horario">Lunes a Viernes: 9:00h – 20:30h </br></li>
			<li id="horario">Sábados: 9:00h – 14:00h </br></li>
		</p>
		<h3>¿Cuál es el horario para realizar pedidos?</h3>
		<p>Es el mismo que el horario de apertura.</p>
		<h3>¿Dónde está ubicada la tienda?</h3>
		<p>Nuestra tienda está ubicada en la avenida Reina Mercedes, nº3. Acontinuación, se proporciona un mapa de como llegar.
			<div id="mapaLugar">
				<a href="https://www.google.es/maps/place/Escuela+T%C3%A9cnica+superior+de+Ingenier%C3%ADa+Inform%C3%A1tica,+ETSII/@37.3582148,-5.9892272,17z/data=!3m1!4b1!4m5!3m4!1s0xd126dd4a3055555:0x29c3f634f8a021b8!8m2!3d37.3582106!4d-5.9870385" target="_blank"><img id="fotoUbicacion" src="img/ubicacion.png"></a>
			</div>
		</p>
		<h3>¿Cada cuanto se renuevan las ofertas?</h3>
		<p>Todos los meses se añaden ofertas nuevas y duración mínima de estas es de un mes. Puedes ver las que temenos ahora <a href="consulta_ofertas.php">aqui.</a></p>
		<h3>¿Cuál es el pago mínimo que se puede realizar con tarjeta?</h3>
		<p>El pago mínimo es de 10 euros.</p>
		<h3>¿Cómo se realiza el pago de los pedidos?</h3>
		<p>Los pedidos serán pagados al repartidor en el momento de la entrega. Dichos pagos podrán realizarse tanto con tarjeta como en efectivo.</p>
		<h3>¿Es posible realizar un pedido sin estar registrado/a?</h3>
		<p>No, es necesario registrarse para ello. Puede registrarse <a href="alta_usuario.php">aqui.</a></p>
		
	</div>
	<div class=datosContacto>
		<h4>Para más información contacte con nosotros:</h4>
		<div class=contactoEmail>
			<p>Email: <a href="mailto:tiendaalimentacion1@gmail.com">tiendaalimentacion1@gmail</a></p>
		</div>
		<div class=contactoTelefono>
			<p>Telefono: +34 645492666</p>
		</div>
	</div>
</main>
<?php
	include_once("pie.php");
?>
</body>
</html>