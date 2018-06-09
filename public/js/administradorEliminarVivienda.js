function confirmarEliminarVivienda(id){

	document.getElementById('botonEliminarVivienda').addEventListener('click',eliminarVivienda(id));

	$("#modalEliminarVivienda").modal();

}

function eliminarVivienda(id){

	console.log("entre a eliminar vivienda");

	$.ajax({
    url: '/eliminarVivienda/'+id,
    type: 'DELETE',
    success: function(result) {
        $("#modalOperacionExitosa").modal();
        document.getElementById(id).style.display = "none";
    }
	});
}



