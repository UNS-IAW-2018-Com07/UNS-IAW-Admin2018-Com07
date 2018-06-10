function modificarCamposDpto() {
	var value = document.getElementById("tipoViv").value;
	if(value=="Departamento"){
		document.getElementById("nroDpto").disabled = false;
		document.getElementById("piso").disabled = false;
	}
	else {
		document.getElementById("nroDpto").disabled = true;
		document.getElementById("piso").disabled = true;
	}
}