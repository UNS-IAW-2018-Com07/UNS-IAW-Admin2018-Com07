function confirmarEliminarPropietario(id){

	document.getElementById('botonEliminarPropietario').setAttribute('data-id',id);

	$("#modalEliminarPropietario").modal();

}

function eliminarPropietario(elem){

	var id=elem.dataset.id;

	$.ajax({
	    url: '/eliminarPropietario/'+id,
	    method: "DELETE",
	    beforeSend: function(request) {
	      var token = $('meta[name="csrf-token"]').attr('content');
	      request.setRequestHeader('X-CSRF-TOKEN', token);
	    },
	    success: function(res) {
	    	console.log(res);
	    	//oculta los li de las viviendas que se eliminaron
	    	res.forEach(function (id_vivienda){
	    		document.getElementById(id_vivienda).style.display = "none";
	    	})
        	$("#modalOperacionExitosa").modal();
        	document.getElementById(id).style.display = "none";
        	
	    },
	    error: function(res,err) {
	    	console.log(res.responseText);
	      	$("#modalOperacionFallida").modal();
	    }
  });

}