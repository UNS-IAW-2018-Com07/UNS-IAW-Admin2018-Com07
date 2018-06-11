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
	direccion = direccionCorrecta(direccion); 

	var piso = null;
	var nroDpto = null;  

	if(tipoViv==='Departamento'){
		piso = document.getElementById("piso").value; 
		nroDpto = document.getElementById("nroDpto").value; 
		if(!piso){
			showError("piso"); 
			var modalBody = document.getElementById("modal-agregarViv");
			var texto = "- El campo <b>Piso</b> no debe ser vacío. <br>"; 
			modalBody.innerHTML = modalBody.innerHTML + texto;  
			direccion = null; 
		}
		if(!nroDpto){
			showError("nroDpto"); 
			var modalBody = document.getElementById("modal-agregarViv");
			var texto = "- El campo <b>Nº dpto</b> no debe ser vacío. <br>"; 
			modalBody.innerHTML = modalBody.innerHTML + texto;  
			direccion = null; 
		}
	}

	var ambientes = document.getElementById("amb").value; 
	ambientes = esEnteroPositivo('amb',ambientes); 
	var cocheras = document.getElementById("coch").value; 
	cocheras = esEntero('coch',cocheras);
	var dormitorios = document.getElementById("dorm").value; 
	dormitorios = esEnteroPositivo('dorm',dormitorios);
	var banios = document.getElementById("ban").value; 
	banios = esEnteroPositivo('ban',banios);
	var aConstruccion = document.getElementById("construccion").value; 
	construccion = esEnteroPositivo('construccion',aConstruccion);
	var precio = document.getElementById("precio").value; 
	precio = esEnteroPositivo('precio',precio);
	var metCuadr = document.getElementById("metCuad").value; 
	metCuadr = esEnteroPositivo('metCuad',metCuadr);
	var descripcion = document.getElementById("descripcion").value; 

	if(!ambientes | cocheras==null | !dormitorios | !banios | !construccion | !precio | !metCuadr | !direccion){
		console.log(ambientes+'-'+cocheras+'-'+dormitorios+'-'+banios+'-'+construccion+'-'+precio+'-'+metCuadr+'-'+direccion);
		$("#modalErrorAgregarVivienda").modal();
	}
	else {
		$.ajax({
			url: '/agregarVivienda',
			method: "POST",
			data: {
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
				propietario: id_prop,
				piso: piso,
				numeroDepto: nroDpto,
				imagenes: ["images/noImage.gif"]
			}, 
			beforeSend: function(request) {
			    var token = $('meta[name="csrf-token"]').attr('content');
				request.setRequestHeader('X-CSRF-TOKEN', token);
			},
			success: function(input) {
		      	$("#modalOperacionExitosa").modal();
			},
			error: function(err) {
			   	$("#modalOperacionFallida").modal();
			}
		 });
	}
}

function esEnteroPositivo(id, val){
	if($.isNumeric(val) && Number.isInteger(parseFloat(val)) && parseInt(val)>0){
		return parseInt(val); 
	}
	else {
		notifyModalPositiveInteger(id); 
		showError(id); 
		return null; 
	}
}

function notifyModalPositiveInteger(id){
	var modalBody = document.getElementById("modal-agregarViv"); 
	var nombre = document.getElementById(id+"label").innerHTML; 

	var texto = "- El campo <b>"+nombre+"</b> debe ser un número mayor a cero. <br>"; 
	modalBody.innerHTML = modalBody.innerHTML + texto; 
}

function esEntero(id, val){
	if($.isNumeric(val) && Number.isInteger(parseFloat(val)) && parseInt(val)>=0){
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
	var nombre = document.getElementById(id+"label").innerHTML; 

	var texto = "- El campo <b>"+nombre+"</b> debe ser un número mayor o igual a cero. <br>"; 
	modalBody.innerHTML = modalBody.innerHTML + texto; 
}

function showError(id){
	var input = document.getElementById(id);
	var label = document.getElementById(id+"label");
	var form = document.getElementById(id+"form");

	$(form).addClass("has-error has-feedback"); 
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
	$(form).removeClass("has-error has-feedback"); 
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
		showError("direccion"); 
		notifyModalDireccion(); 
	}
	return direccion; 
}

function notifyModalDireccion(){
	var modalBody = document.getElementById("modal-agregarViv");
	var texto = "- La <b> Dirección </b> debe ser de Bahía Blanca. <br>"; 
	modalBody.innerHTML = modalBody.innerHTML + texto;  
}