function validateCliente() {
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