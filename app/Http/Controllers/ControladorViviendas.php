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

    	return Vivienda::destroy($id);

    }

    public function agregarVivienda(){
        $propietarios = Propietario::all();

        return view('add-building', [
            'title' => 'Agregar Vivienda',
            'propietarios' => $propietarios
        ]);
    }

    public function store(Request $request){
        $name = $request->input('name');
    }
}
