function validateDescuento() {
	
	var error1 = validacionDescuento();

	return (error1.length==0);

}

function validacionDescuento(){

	var descuento = document.getElementById("idDescuento");
	var valorDescuento = descuento.value;
	var valido = true;
	valido = valido && (!isNaN(valorDescuento));
	valido = valido && (valorDescuento.length>0);
	if(!valido){
		var error = "El descuento es obligatorio y solo puede contener números";
	}else{
		var error = "";
	}
	descuento.setCustomValidity(error);
	return error;
}