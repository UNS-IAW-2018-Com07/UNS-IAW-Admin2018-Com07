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

    	// if(Vivienda::find("1")){
     //        Vivienda::destroy("1");
     //        return response("bien",200);
     //    }
     //    else
     //       return response("mal",404);  
        return Vivienda::findOrFail($id)->destroy($id);
    }

    public function agregarVivienda(){
        $propietarios = Propietario::all();

        return view('add-building', [
            'title' => 'Agregar Vivienda',
            'propietarios' => $propietarios
        ]);
    }

    public function store(Request $request){
        $input = $request->all();
        // Vivienda::save($input);
        return $input; 
    }
}
