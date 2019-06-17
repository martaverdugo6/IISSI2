function validateDescuento() {
	
	var error1 = validacionDescuento();

	return (error1.length==0);

}
/*
function validacionDescuento(){

	var descuento = document.getElementById("idDescuento");
	var valorDescuento = descuento.value;
	var punto = /^\d*\.?\d*$/;
	var valido = true;
	valido = valido && (!isNaN(valorDescuento)) && (valorDescuento.length>0) && (punto.test(valorDescuento));
	if(!valido){
		var error = "El descuento es obligatorio y solo puede contener números";
	}else{
		var error = "";
	}
	descuento.setCustomValidity(error);
	return error;
}*/

function validacionDescuento(){

	var descuento = document.getElementById("idDescuento");
	var valorDescuento = descuento.value;
	var numeros = /[0-9]/;
	var punto = /^\d*\.?\d*$/;
	var valido = true;
	valido = valido && (valorDescuento.length>0) && (numeros.test(valorDescuento));
	if(!valido){
		var error = "El descuento es obligatorio y solo puede contener números";
	}else{
		var error = "";
	}
	descuento.setCustomValidity(error);
	return error;
}