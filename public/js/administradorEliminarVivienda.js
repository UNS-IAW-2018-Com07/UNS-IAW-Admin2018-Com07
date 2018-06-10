function confirmarEliminarVivienda(id){

	document.getElementById('botonEliminarVivienda').setAttribute('data-id',id);

	$("#modalEliminarVivienda").modal();

}

function eliminarVivienda(elem){

	var id=elem.dataset.id;

		$.ajax({
		    url: '/eliminarVivienda/'+id,
		    method: "DELETE",
		    beforeSend: function(request) {
		      var token = $('meta[name="csrf-token"]').attr('content');
		      request.setRequestHeader('X-CSRF-TOKEN', token);
		    },
		    success: function(res,err) {
	        	$("#modalOperacionExitosa").modal();
	        	document.getElementById(id).style.display = "none";
		    },
		    error: function(res,err) {
		    	console.log(res.responseJSON.message);
		      	$("#modalOperacionFallida").modal();
		    }
	  });
	

}



