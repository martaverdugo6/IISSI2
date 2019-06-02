<?php 
	session_start();
	
	$excepcion = $_SESSION["excepcion"];
	unset($_SESSION["excepcion"]);
	
	if (isset ($_SESSION["destino"])) {
		$destino = $_SESSION["destino"];
		unset($_SESSION["destino"]);	
	} else 
		$destino = "";
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<link rel="shortcut icon" href="img/logoVentana.png" />
	<link rel="stylesheet" type="text/css" href="css/estilo.css" />
	<title>Ha ocurrido un error</title>
</head>
<body>
	<script>
		window.setInterval (BlinkIt, 500);
		var color = "red";
		function BlinkIt () {
		var blink = document.getElementById ("vaya");
		color = (color == "#ffffff")? "red" : "#ffffff";
		blink.style.color = color;
		blink.style.fontSize='36px';}
	</script>

<?php	
	include_once("cabecera.php"); 
?>
	<div class= text_except>
		<div id="vaya"><h2>¡Vaya!</h2></div>
		<?php if ($destino<>"") { ?>
		<p>Ocurrió un problema durante el procesado de los datos. Pulse <a href="<?php echo $destino ?>">aquí</a> para volver a la página de la que procede.</p>
		<?php } else { ?>
		<p>Ocurrió un problema al intentar acceder a la base de datos. </p>
		<?php } ?>
	</div>
		
	<div class='excepcion'>	
		<?php echo "Información relativa al problema: $excepcion;" ?>
	</div>
	<img id="img_robot" src="img/robot.png">

</body>
</html>