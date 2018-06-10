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
	    success: function(hola) {
        	$("#modalOperacionExitosa").modal();
        	document.getElementById(id).style.display = "none";
        	console.log(hola);
	    },
	    error: function(err) {
	      	$("#modalOperacionFallida").modal();
	    }
  });

}