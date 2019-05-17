<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<nav>
	<ul class="menu" id="idMenu">
		<?php if(!isset($_SESSION['login'])){ ?>
		
			<li><a href="login.php"><i class="fa fa-fw fa-user"></i>Login</a></li>
		
		<?php } ?>
		
		<?php if(isset($_SESSION['login'])) { ?>
		
			<li><a href="logout.php"><i class="fas fa-power-off"></i>Cerrar sesión</a></li>
			
			<?php if(isset($_SESSION['datosUsuario'])){?>
				<li><a href="cuenta_usuario.php"><i class="far fa-user-circle"></i>Mi cuenta</a></li>
			<?php }else if(isset($_SESSION['datosEmpleado'])){ ?>
				<li><a href="cuenta_empleado.php"><i class="far fa-user-circle"></i>Mi cuenta</a></li>
			<?php } ?>
		<?php } ?>

		<li><a href="consulta_ofertas.php"><i class="fas fa-euro-sign"></i>Ofertas</a></li>
		<li><a href="consulta_productos.php"><i class="fas fa-shopping-cart"></i>Productos</a></li>
		<li><a href="index.php"><i class="fa fa-fw fa-home"></i>Inicio</a></li>
	</ul>
</nav>

