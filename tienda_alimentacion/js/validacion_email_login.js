function validateEmailLogin() {
	
	var error1 = validacionEmailLogin();

	return (error1.length==0);
}

function validacionEmailLogin(){

	var email = document.getElementById("idCuentaAcceso");
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