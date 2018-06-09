<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use Illuminate\Http\Request;

class ControladorViviendas extends Controller{

    public function index(){
    	$viviendas = Vivienda::all(); 
    	$propietarios = Propietario::all(); //ordenar por cuit o nombre?

	    return view('buildings-list', [
	    	'title' => 'Inicio', 
	    	'viviendas' => $viviendas,
	    	'propietarios' => $propietarios
	    ]);
    }

    public function destroy($id){
    	
    	$resp = Vivienda::destroy($id);

    	return Response::json($resp);

    }

}
