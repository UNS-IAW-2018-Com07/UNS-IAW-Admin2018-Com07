function mostrarPropietarios() {
    document.getElementById("botonAdministrarViviendas").disabled = false;
    document.getElementById("botonAdministrarPropietarios").disabled = true;

    document.getElementById("barraPropietarios").style.display = "block";
    document.getElementById("barraListado").style.display = "none";
}

function ocultarPropietarios() {
    document.getElementById("botonAdministrarPropietarios").disabled = false;
    document.getElementById("botonAdministrarViviendas").disabled = true;

    document.getElementById("barraListado").style.display = "block";
    document.getElementById("barraPropietarios").style.display = "none";
}