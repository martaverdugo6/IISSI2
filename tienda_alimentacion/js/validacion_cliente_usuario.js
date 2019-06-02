function validateForm() {
	
	var error1 = validacionNombre();
	var error2 = validacionApellidos();
	var error3 = validacionDni();
	var error4 = validacionEmail();
	var error5 = passwordValidation();
	var error6 = passwordConfirmation();
    
	return (error1.length==0) && (error2.length==0) && (error3.length==0) && (error4.length==0)&& (error5.length==0) && (error6.length==0);
}

function validacionNombre(){

	var nombre = document.getElementById("nombre");
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

function validacionApellidos(){

	var apellidos = document.getElementById("apellidos");
	var valorApellidos = apellidos.value;
	var valido = true;
	valido = valido && (valorApellidos.length>0);
	if(!valido){
		var error = "Introduzca unos apellidos válidos";
	}else{
		var error = "";
	}
	apellidos.setCustomValidity(error);
	return error;

}

function validacionDni(){

	var dni = document.getElementById("dni");
	var valorDni = dni.value;
	var valido = true;
	valido = valido && (valorDni.length==9);
	var letraMayuscula = /[A-Z]/;
	valido = valido && (letraMayuscula.test(valorDni));
	var numeroDni = dni.substr(0,dni.length-1);
	valido = valido && (!isNaN(numeroDni));
	if(!valido){
		var error = "Introduzca un dni con 8 números seguido de una letra mayúscula";
	}else{
		var error = "";
	}
	dni.setCustomValidity(error);
	return error;	

}

function validacionEmail(){

	var email = document.getElementById("email");
	var valorEmail = email.value;
	var valido = true;
	valido = valido && (valorEmail.length>0);
	var arroba = /[@]/;
	var punto = /[.]/;
	valido = valido && (arroba.test(valorEmail)) && (punto.test(valorEmail));
	if(!valido){
		var error = "Introduzca un email con formato usuario@dominio.extension";
	}else{
		var error = "";
	}
	email.setCustomValidity(error);
	return error;

}

function passwordValidation(){
	var contrasenya = document.getElementById("pass");
	var valorContrasenya = contrasenya.value;
	var valido = true;

	valido = valido && (valorContrasenya.length>=8);
	var numero = /\d/;
	var minuscula = /[a-z]/;
	var mayuscula = /[A-Z]/;
	valido = valido && (numero.test(valorContrasenya)) && (minuscula.test(valorContrasenya)) && (mayuscula.test(valorContrasenya));
	if(!valido){
		var error = "Introduzca una contraseña con más de 8 caracteres, una letra mayúscula y un número";
	}else{
		var error = "";
	}
	contrasenya.setCustomValidity(error);
	return error;
}

function passwordConfirmation(){

	var contrasenya = document.getElementById("pass");
	var confirmContrasenya = document.getElementById("confirmpass");
	var valorContrasenya = contrasenya.value;
	var valorConfirmContrasenya = confirmContrasenya.value;

	if(valorContrasenya != valorConfirmContrasenya){
		var error = "Las contraseñas deben coincidir";
	}else{
		var error = "";
	}
	confirmContrasenya.setCustomValidity(error);
	return error;
}


function passwordStrength(password){
		
	var letters = {};
	var length = password.length;
	for(x = 0, length; x < length; x++) {
		var l = password.charAt(x);
		letters[l] = (isNaN(letters[l])? 1 : letters[l] + 1);
    }
	return Object.keys(letters).length / length;
}

function passwordColor(){
	var passField = document.getElementById("pass");
	var strength = passwordStrength(passField.value);
	
	if(!isNaN(strength)){
		var type = "weakpass";
		if(passwordValidation()!=""){
			type = "weakpass";
		}else if(strength > 0.7){
			type = "strongpass";
		}else if(strength > 0.4){
			type = "middlepass";
		}
	}else{
		type = "nanpass";
	}
	passField.className = type;
	
	return type;
}