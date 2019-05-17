<?php
	session_start();
    
    if(isset($_SESSION['login']))
        $_SESSION['login'] = null;

    if(isset($_SESSION['datosEmpleado']))
    	$_SESSION['datosEmpleado'] = null;

    if (isset($_SESSION['datosUsuario'])) {
    	$_SESSION['datosUsuario'] = null;
    }
    if (isset($_SESSION['usuario'])) {
    	$_SESSION['usuario'] = null;
    }
    if (isset($_SESSION['empleado'])) {
    	$_SESSION['empleado'] = null;
    }

    
    header("Location: index.php");
?>