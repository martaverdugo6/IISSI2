function validateForm() {
	// Comprobar que la longitud de la contraseña es >=8, que contiene letras mayúsculas y minúsculas y números
	var error1 = passwordValidation();
    
	var error2 = passwordConfirmation();
    
	return (error1.length==0) && (error2.length==0);
}

// EJERCICIO 3.1: Comprobar la restricciones del password y aplicar clases CSS mediante JQuery
function passwordValidation(){
	var password = document.getElementById("pass");
	var pwd = password.value;
	var valid = true;

	// Comprobamos la longitud de la contraseña
	valid = valid && (pwd.length>=8);
	
	// Comprobamos si contiene letras mayúsculas, minúsculas y números
	var hasNumber = /\d/;
	var hasUpperCases = /[A-Z]/;
	var hasLowerCases = /[a-z]/;
	valid = valid && (hasNumber.test(pwd)) && (hasUpperCases.test(pwd)) && (hasLowerCases.test(pwd));
	
	// Si no cumple las restricciones, devolvemos un error
	if(!valid){
		var error = "Please enter a valid password! Length >= 8, (upper and lower case) letters and digits";
	}else{
		var error = "";
	}
        password.setCustomValidity(error);
	return error;
}

// EJERCICIO 3.2: Campos de contraseña y confirmación de contraseña iguales
function passwordConfirmation(){
	// Obtenemos el campo de password y su valor
    var password = document.getElementById("pass");
	var pwd = password.value;
	// Obtenemos el campo de confirmación de password y su valor
	var passconfirm = document.getElementById("confirmpass");
	var confirmation = passconfirm.value;

	// Los comparamos
	if (pwd != confirmation) {
		var error = "Please enter matching passwords!";
	}else{
		var error = "";
	}

	passconfirm.setCustomValidity(error);

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