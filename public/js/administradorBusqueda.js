function busquedaPorPalabra() {
	var palabra = document.getElementById('form-control-busqueda').value;
	document.getElementById('form-control-busqueda').value = ""; 
	if(palabra){

		ocultar(); 

		palabra=palabra.toLowerCase();

		$.get("./api/busqueda", function (viviendas) {
			viviendas.forEach(function(vivienda) {
				if((vivienda.direccion).toLowerCase().includes(palabra)
				||(vivienda.descripcion).toLowerCase().includes(palabra)){
					if(document.getElementById(vivienda._id))
						//es porque puede que se actualice la base de datos pero como el listado se creo antes
						//no existe un li con esa id
						document.getElementById(vivienda._id).style.display = "block";
					//else podria agregarse un nuevo li pero eso requiere otra consulta a la db
				}
			}); 
		});
	}	
}

function ocultar(){
	//Ocultar los li
	$("#contenedorListado").children().css({"display": "none"});
}
