function validateCliente() {
	var rfc = document.querySelector('[name="rfc"]').value;
	var regex = new RegExp('^[A-Z]{4}([0-9]{2})(1[0-2]|0[1-9])([0-3][0-9])([ -]?)([A-Z0-9]{4})');
	if(rfc.match(regex)==null){
	    alert('Error en el RFC');
	    return false;
	}
	codigo_postal = document.querySelector('[name="codigo_postal"]').value;;
	if(!isInt(codigo_postal)){
		alert("¡Ingrese un valor númerico en codigo postal!");
		return false
	}
	return true;
}

function isInt(value) {
  return !isNaN(value) && (function(x) { return (x | 0) === x; })(parseFloat(value))
}