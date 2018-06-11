<?php

namespace App\Http\Controllers;

use App\Vivienda;
use App\Propietario;
use App\Http\Requests\AddBuildingRequest;

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
        return Vivienda::findOrFail($id)->destroy($id);
    }

    public function agregarVivienda(){
        $propietarios = Propietario::orderBy('cuit', 'ASC')->get();

        return view('add-building', [
            'title' => 'Agregar Vivienda',
            'propietarios' => $propietarios
        ]);
    }

    public function store(AddBuildingRequest $input){
        if(Vivienda::create(request(['tipoVivienda', 'compartido', 'operacion', 'direccion', 'precio', 'anioConstruccion', 'metrosCuadrados', 'cantAmbientes', 'cantBanios', 'cantCocheras', 'cantDormitorios', 'descripcion', 'propietario','piso','numeroDepto'])))
                return view('alert',[
                    'title' => 'Operación exitosa.',
                    'href' => '/agregarVivienda'
                ]);
        else
                return view('alert',[
                    'title' => 'Ocurrió un error inesperado.',
                    'href' => '/agregarVivienda'
                ]);
        
    }
}
