function validateAjuste() {
	var inputs = document.getElementsByName('ajuste[]');
	for (i = 0; i < inputs.length; i++) {
		if(inputs[i].value<0){
			alert("El ajuste no puede ser menor a 0");	
			return false
		}
	}
    return true;
	
    /*$(".ajuste").each(function( index ) {
  		if ( $(this).val() < 0 ) {
			alert("Ajuste no puede ser menor que 0");
      		return false;
  		}
	});
	*/
}

function validateCantidad() {
	var inputs = document.getElementsByName('cantidad[]');
	for (i = 0; i < inputs.length; i++) {
		if(inputs[i].value<0){
			alert("La cantidad no puede ser menor a 0");	
			return false
		}
	}
    return true;
}

function validateDescuento() {
	var inputs = document.getElementsByName('descuento[]');
	for (i = 0; i < inputs.length; i++) {
		if(inputs[i].value<0){
			alert("El descuento no puede ser menor a 0");	
			return false
		}
	}
    return true;
}

function validateCliente() {
	codigo_postal = document.querySelector('[name="codigo_postal"]').value;;
	limite_credito = document.querySelector('[name="limite_credito"]').value;;
	if(!isInt(codigo_postal)){
		alert("¡Ingrese un valor númerico en codigo postal!");
		return false
	}
	return true;
}

function isInt(value) {
  return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
}