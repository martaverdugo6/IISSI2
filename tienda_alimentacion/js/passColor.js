function passwordColor(){
	
	var passField = document.getElementById("contrasenya");
	var strength = passwordStrength(passField.value);
	if(!isNaN(strength)){
		var type = "weakpass";
		if(validacionContrasenya()!=""){
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