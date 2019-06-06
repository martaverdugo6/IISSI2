function validateProducto() {
	
	var error1 = validacionNombreProducto();
    
	return (error1.length==0);
}

function validacionNombreProducto(){

	var nombre = document.getElementById("nombreProd");
	var valorNombre = nombre.value;
	var valido = true;
	valido = valido && (valorNombre.length>0);
	if(!valido){
		var error = "Introduzca el nombre del producto";
	}else{
		var error = "";
	}
	nombre.setCustomValidity(error);
	return error;

}

function validacionStock(){

	var stock = document.getElementById("idStockProd");
	var valorStock = stock.value;
	var valido = true;
	valido = valido && (!isNaN(valorStock));
	valido = valido && (valorStock > 19);
	valido = valido && (valorStock.length > 0);
	if(!valido){
		var error = "El stock es obligatorio y debe ser al menos 20";
	}else{
		var error = "";
	}
	stock.setCustomValidity(error);
	return error;
	

}


function validacionPrecioProducto(){

	var precio = document.getElementById("idPrecioProd");
	var valorPrecio = precio.value;
	var valido = true;
	valido = valido && (!isNaN(valorPrecio));
	valido = valido && (valorPrecio.length>0);
	if(!valido){
		var error = "El precio es obligatorio y solo puede contener números";
	}else{
		var error = "";
	}
	precio.setCustomValidity(error);
	return error;
}

function validacionCategoriaProducto(){

	var categoria = document.getElementById("idCategoria");
	var valorCategoria = categoria.value;
	var valido = true;
	valido = valido && (valorCategoria.length>0);
	if(!valido){
		var error = "Introduzca la categoria del producto";
	}else{
		var error = "";
	}
	categoria.setCustomValidity(error);
	return error;

}