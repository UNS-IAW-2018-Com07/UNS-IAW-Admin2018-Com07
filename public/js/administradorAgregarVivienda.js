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

function agregarVivienda(){ 
	var modalBody = document.getElementById("modal-agregarViv"); 
	modalBody.innerHTML = ""; 
	camposError = document.querySelectorAll('.has-error'); 
	console.log(camposError); 
	camposError.forEach(eliminarFormatoError); 

	var li = document.querySelectorAll('li.active')[0]; 
	var id_prop = li.children[0].text
	
	var tipoOp = document.getElementById("tipoOp").value;
	var tipoViv = document.getElementById("tipoViv").value;
	var comp = document.getElementById("comp").value;

	var direccion = document.getElementById("direccion").value; 

	if(tipoViv=='Departamento'){
		var piso = document.getElementById("piso").value; 
		var nroDpto = document.getElementById("nroDpto").value; 
	}

	var ambientes = document.getElementById("amb").value; 
	ambientes = esEntero('amb',ambientes); 
	var cocheras = document.getElementById("coch").value; 
	cocheras = esEntero('coch',cocheras);
	var dormitorios = document.getElementById("dorm").value; 
	dormitorios = esEntero('dorm',dormitorios);
	var banios = document.getElementById("ban").value; 
	banios = esEntero('ban',banios);
	var aConstruccion = document.getElementById("construccion").value; 
	construccion = esEntero('construccion',aConstruccion);
	var precio = document.getElementById("precio").value; 
	precio = esEntero('precio',precio);
	var metCuadr = document.getElementById("metCuad").value; 
	metCuadr = esEntero('metCuad',metCuadr);
	var descripcion = document.getElementById("descripcion").value; 


	// $.ajax({
	//     url: '/agregarVivienda/'+id,
	//     type: 'POST',
	//     success: function(result) {
	//         $("#modalOperacionExitosa").modal();
	//         document.getElementById(id).style.display = "none";
	//     }
	// });
}

function esEntero(id, val){
	if($.isNumeric(val) && Number.isInteger(parseFloat(val))){
		return parseInt(val); 
	}
	else {
		notifyModal(id); 
		showError(id); 
		return null; 
	}
}

function notifyModal(id){
	var modalBody = document.getElementById("modal-agregarViv"); 
	var input = document.getElementById(id);
	var nombre = input.previousSibling.innerHTML; 
	modalBody.innerHTML = modalBody.innerHTML + nombre; 
	console.log(modalBody.innerHTML); 
}

function showError(id){
	console.log(id); 
	var input = document.getElementById(id);
	var label = input.previousSibling; 
	var form = input.parentNode; 
	form.className = "form-group has-error has-feedback col-xs-6 col-sm-4 col-md-3 col-lg-3"; 
	label.className = "control-label"; 
	input.setAttribute("aria-describedby", "inputError2Status");

	var span1 = document.createElement("span"); 
	span1.className = "glyphicon glyphicon-remove form-control-feedback"; 
	span1.setAttribute("aria-hidden", "true");

    var span2 = document.createElement("span"); 
    span2.id = "inputError2Status"; 
	span2.className = "sr-only"; 
	$(span2).html("(error)");

	form.appendChild(span1); 
	form.appendChild(span2); 
}

function eliminarFormatoError(form){
	form.className = "form-group col-xs-6 col-sm-4 col-md-3 col-lg-3";

	var id = form.firstElementChild.getAttribute('for'); 
	var texto = form.firstElementChild.innerHTML; 
	var input = form.children[1]; 

	while (form.firstChild) {
	    form.removeChild(form.firstChild);
	}

	var label = document.createElement("label"); 
	label.setAttribute("for", id);
	var texto = document.createTextNode(texto);
    label.appendChild(texto);

	form.appendChild(label); 
	form.appendChild(input);
}

function direccionCorrecta(direccion){
	return true; 
}