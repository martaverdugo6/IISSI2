function validateCuentaUsuario() {
	
	var error1 = validacionNombreUsuario();
	var error2 = validacionApellidosUsuario();   
	var error3 = validacionTelefono(); 
	
	return (error1.length==0) && (error2.length==0) && (error3.length==0);
}

function validacionNombreUsuario(){

	var nombre = document.getElementById("NOMBRE_CLI");
	var valorNombre = nombre.value;
	var valido = true;
	valido = valido && (valorNombre.length>0);
	if(!valido){
		var error = "Introduzca un nombre";
	}else{
		var error = "";
	}
	nombre.setCustomValidity(error);
	return error;
	

}

function validacionApellidosUsuario(){

	var apellidos = document.getElementById("APELLIDOS_CLI");
	var valorApellidos = apellidos.value;
	var valido = true;
	valido = valido && (valorApellidos.length>0);
	if(!valido){
		var error = "Introduzca unos apellidos";
	}else{
		var error = "";
	}
	apellidos.setCustomValidity(error);
	return error;

}

function validacionTelefono(){

	var telefono = document.getElementById("TELEFONO_CLI");
	var valorTelefono = telefono.value;
	var valido = true;
	valido = valido && (!isNaN(valorTelefono));
	if(!valido){
		var error = "El teléfono solo puede contener números";
	}else{
		var error = "";
	}
	telefono.setCustomValidity(error);
	return error;
	

}