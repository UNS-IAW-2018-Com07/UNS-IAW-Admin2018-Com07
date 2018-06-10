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
	camposError.forEach(eliminarFormatoError); 

	var li = document.querySelectorAll('li.active')[0]; 
	var id_prop = li.children[0].text
	
	var tipoOp = document.getElementById("tipoOp").value;
	var tipoViv = document.getElementById("tipoViv").value;
	var comp = (document.getElementById("comp").value) == 'Si'; 

	var direccion = document.getElementById("direccion").value; 
	direccion = direccionCorrecta(direccion, tipoViv); 

	if(tipoViv=='Departamento'){
		var piso = document.getElementById("piso").value; 
		var nroDpto = document.getElementById("nroDpto").value; 
		if(!piso | !nroDpto){
			var modalBody = document.getElementById("modal-agregarViv");
			var texto = "- Los campos <b>Piso</b> y <b>Nº dpto</b> no deben ser vacíos. <br>"; 
			modalBody.innerHTML = modalBody.innerHTML + texto;  
			direccion = null; 
		}
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

	if(!ambientes | !cocheras | !dormitorios | !banios | !construccion | !precio | !metCuadr | !direccion){
		$("#modalErrorAgregarVivienda").modal();
	}
	else {
		var json = {
			tipoVivienda: tipoViv, 
			compartido: comp, 
			operacion: tipoOp, 
			direccion: direccion,
			precio: precio, 
			anioConstruccion: construccion, 
			metrosCuadrados: metCuadr, 
			cantAmbientes: ambientes, 
			cantBanios: banios, 
			cantCocheras: cocheras, 
			cantDormitorios: dormitorios, 
			descripcion: descripcion, 
			propietario: id_prop
		};
		if(tipoViv=='Departamento'){
			json.piso = piso; 
			json.numeroDepto = nroDpto;
		}
		$.ajax({
			url: '/agregarNuevaVivienda',
			method: "POST",
			data: json, 
			beforeSend: function(request) {
			    var token = $('meta[name="csrf-token"]').attr('content');
				request.setRequestHeader('X-CSRF-TOKEN', token);
			},
			success: function(input) {
				console.log(input); 
		      	// $("#modalOperacionExitosa").modal();
		       // 	document.getElementById(id).style.display = "none";
			},
			error: function(err) {
			   	// $("#modalOperacionFallida").modal();
			}
		 });
	}
}

function esEntero(id, val){
	if($.isNumeric(val) && Number.isInteger(parseFloat(val))){
		return parseInt(val); 
	}
	else {
		notifyModalInteger(id); 
		showError(id); 
		return null; 
	}
}

function notifyModalInteger(id){
	var modalBody = document.getElementById("modal-agregarViv"); 
	var input = document.getElementById(id);
	var nombre = document.getElementById(id+"label").innerHTML; 

	var texto = "- El campo <b>"+nombre+"</b> debe ser un número entero. <br>"; 
	modalBody.innerHTML = modalBody.innerHTML + texto; 
}

function showError(id){
	var input = document.getElementById(id);
	var label = document.getElementById(id+"label");
	var form = document.getElementById(id+"form");

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
	var id = form.id.split("form")[0]; 

	var texto = document.getElementById(id+"label").innerHTML;
	var input = document.getElementById(id);

	while (form.firstChild) {
	    form.removeChild(form.firstChild);
	}

	var label = document.createElement("label"); 
	label.setAttribute("for", id);
	label.id = id+"label"; 
	var texto = document.createTextNode(texto);
    label.appendChild(texto);

	form.appendChild(label); 
	form.appendChild(input);
}

function direccionCorrecta(direccion){
	if(!direccion){
		notifyModalDireccion(); 
	}
	return direccion; 
}

function notifyModalDireccion(){
	var modalBody = document.getElementById("modal-agregarViv");
	var texto = "- La <b> Dirección </b> debe ser de Bahía Blanca. <br>"; 
	modalBody.innerHTML = modalBody.innerHTML + texto;  
}