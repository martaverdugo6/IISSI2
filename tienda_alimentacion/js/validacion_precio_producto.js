function validatePrecio() {
	
	var error1 = validacionPrecio();

	return (error1.length==0);

}

/*function validacionPrecio(){

	var precio = document.getElementById("idPrecio");
	var valorPrecio = precio.value;
	var coma = /^\d*\,?\d*$/;
	var valido = true;
	valido = valido && (!isNaN(valorPrecio)) && (valorPrecio.length>0) && (coma.test(valorPrecio));
	if(!valido){
		var error = "El precio es obligatorio y solo puede contener números";
	}else{
		var error = "";
	}
	precio.setCustomValidity(error);
	return error;
}*/

function validacionPrecio(){

	var precio = document.getElementById("idPrecio");
	var valorPrecio = precio.value;
	var coma = /^\d*\,?\d*$/;
	var valido = true;
	valido = valido && (valorPrecio.length>0) && (coma.test(valorPrecio));
	if(!valido){
		var error = "El precio es obligatorio y solo puede contener números";
	}else{
		var error = "";
	}
	precio.setCustomValidity(error);
	return error;
}