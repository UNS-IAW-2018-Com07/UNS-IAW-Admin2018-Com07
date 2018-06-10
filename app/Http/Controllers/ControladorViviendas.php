<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use Illuminate\Http\Request;

class ControladorViviendas extends Controller{

    public function index(){
        $viviendas = Vivienda::orderBy('direccion', 'ASC')->get();
        $propietarios = Propietario::orderBy('cuit', 'ASC')->get(); 

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
        $propietarios = Propietario::orderBy('cuit', 'ASC')->get();

        return view('add-building', [
            'title' => 'Agregar Vivienda',
            'propietarios' => $propietarios
        ]);
    }

    public function store(Request $request){
        $name = $request->input('name');
    }
}
